<?php
/**
 * Abstract DataSource class for key-value stores.
 * 
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 * Copyright (c) 2010 Takayuki Miwa <i@tkyk.name>
 * 
 * You should implement:
 * - connect ()
 * - get (&$model, $id, $query)
 * - set (&$model, $id, $data)
 * - del (&$model, $id)
 * - count (&$model, $id, $query)
 * 
 * You can also implement/override:
 * - close ()
 * - checkId ($id)
 * 
 * Notice:
 * You cannot use the value false as a regular value,
 * because false means 'not-found' or 'failed' in this class.
 * 
 */

class KeyValueSource extends DataSource
{
  /**
   * If you want to support these features,
   * turn them on explicitly.
   * 
   * @var array
   */
  var $_features = array('listSources' => false,
			 'describe'    => true);

  /**
   * @var array  default schema for the models using this DataSource.
   */
  var $_defaultSchema = array('id' => array('type' => 'string',
					    'length' => 255));

  /**
   * @var string
   */
  var $_looseSchemaBehavior = 'KeyValueLooseSchema';

  /**
   * @var array
   */
  var $_schemalessColumn = array('_schemaless_data' => array('type' => 'schemaless'));

  /**
   * Column definitions
   * 
   * @var array
   */
  var $columns = array('string' => array('name' => 'varchar', 'limit' => '255'),
		       'text' => array('name' => 'text'),
		       'integer' => array('name' => 'int', 'limit' => '11', 'formatter' => 'intval'),
		       'float' => array('name' => 'float', 'formatter' => 'floatval'),
		       'datetime' => array('name' => 'datetime', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
		       'timestamp' => array('name' => 'timestamp', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
		       'time' => array('name' => 'time', 'format' => 'H:i:s', 'formatter' => 'date'),
		       'date' => array('name' => 'date', 'format' => 'Y-m-d', 'formatter' => 'date'),
		       );

  /**
   * Constructor.
   *
   * @param array $config
   */
  function __construct($config=array())
  {
    $this->debug     = Configure::read('debug') > 0;
    $this->fullDebug = Configure::read('debug') > 1;

    // loaded as plugin in CakePHP 1.3
    if(strpos($config['datasource'], '.') !== false) {
      list($plugin, $_source) = explode('.', $config['datasource'], 2);
      $this->_looseSchemaBehavior = "{$plugin}.{$this->_looseSchemaBehavior}";
    }

    parent::__construct($config);
    $this->connect();
  }

  /**
   * [Abstract functions to-be-overridden in subclasses.]
   * 
   * Configurations passed from the database.php are
   * in the $this->config.
   * 
   * If an error occurs while connecting, call $this->cakeError().
   * Returned values are discarded.
   * 
   * @abstract
   */
  function connect(){}

  /**
   * [Abstract functions to-be-overridden in subclasses.]
   * 
   * Retrieves data associated with ID $id.
   * 
   * @abstract
   * @param object  Model
   * @param mixed   id
   * @param array   query-array passed from the Model::find
   * @return mixed or false
   */
  function get(&$model, $id, $query){}

  /**
   * [Abstract functions to-be-overridden in subclasses.]
   * 
   * Stores $data in whatever you want.
   * 
   * @abstract
   * @param object  Model
   * @param mixed   id
   * @param array   data-array passed from the Model::save
   * @return mixed or false
   */
  function set(&$model, $id, $data){}

  /**
   * [Abstract functions to-be-overridden in subclasses.]
   * 
   * Removes data associated with ID $id.
   * 
   * @abstract
   * @param object  Model
   * @param mixed   id
   * @return boolean
   */
  function del(&$model, $id){}

  /**
   * [Abstract functions to-be-overridden in subclasses.]
   *
   * Returns the number of items associated with ID $id.
   *
   * @param object $model
   * @param mixed  $id
   * @param array  $query
   * @return integer
   */
  function count(&$model, $id, $query){}

  /**
   * Checks if the $id is valid in this storage.
   * 
   * In default, integer and alpha-numeric string are allowed.
   * You can override this behavior.
   * 
   * @param mixed $id
   * @return boolean
   */
  function checkId($id)
  {
    return is_int($id) || (is_string($id) && preg_match('/^[0-9a-z]+$/i', $id));
  }

  /**
   * This method will be called in the __destruct
   * if and only if $connected is used.
   * 
   */
  function close(){}

  /**
   * @override
   */
  function isInterfaceSupported($interface)
  {
    switch(true) {
    case isset($this->_features[$interface]):
      return $this->_features[$interface];
    default:
      return parent::isInterfaceSupported($interface); 
    }
  }

  /**
   * describe
   * 
   * If the model has $looseSchema, $_looseSchemaBehavior is automatically attached.
   * 
   * @override
   */
  function describe(&$model)
  {
    if(isset($model->looseSchema)) {
      $this->_setLooseSchemaBehavior($model);
      $schema = is_array($model->looseSchema) ? $model->looseSchema : $this->_defaultSchema;
      return $schema + $this->_schemalessColumn;
    }
    return array();
  }

  function _setLooseSchemaBehavior(&$model)
  {
    if(empty($model->actsAs)) {
      $model->actsAs = array();
    }
    if(!isset($model->actsAs[$this->_looseSchemaBehavior]) &&
       !in_array($this->_looseSchemaBehavior, $model->actsAs)) {
      $model->actsAs[$this->_looseSchemaBehavior]
	= array('schemalessField' => key($this->_schemalessColumn));
    }
  }

  function _dataToSave(&$model, $fields=null, $values=null)
  {
    $data = ($values != null) ? array_combine($fields, $values) : $fields;
    return $model->Behaviors->enabled($this->_looseSchemaBehavior)
      ? $model->getSchemalessData($data) : $data;
  }

  function create(&$model, $fields=null, $values=null)
  {
    $data = $this->_dataToSave($model, $fields, $values);

    if(isset($data[$model->primaryKey])
       && $this->checkId($data[$model->primaryKey])
       && $this->set($model, $data[$model->primaryKey], $data)) {
      return true;
    } else {
      $model->onError();
      return false;
    }
  }

  function update(&$model, $fields = null, $values = null)
  {
    $data = $this->_dataToSave($model, $fields, $values);

    if($this->checkId($model->id) &&
       $this->set($model, $model->id, $data)) {
      return true;
    } else {
      $model->onError();
      return false;
    }
  }

  function read(&$model, $query = array(), $recursive = null)
  {
    $query = am(array('conditions' => array(),
		      'fields' => array()), $query);

    $idRef = $model->alias .".". $model->primaryKey;

    if(empty($query['conditions'][$idRef])) {
      trigger_error(__CLASS__ ."::read(): primary key is not specified.",
		    E_USER_ERROR);
      $model->onError();
      return false;
    }

    $id = $query['conditions'][$idRef];

    if(!$this->checkId($id)) {
      return false;
    }

    if (!empty($query['fields']['count'])) {
      return a(a(aa('count', $this->count($model, $id, $query))));
    }

    if($data = $this->get($model, $id, $query)) {
      return a(aa($model->alias, $data));
    }
    return null;
  }

  function calculate()
  {
    return array('count' => true);
  }

  function delete(&$model, $conditions=null)
  {
    return $this->del($model, $model->id);
  }

}
