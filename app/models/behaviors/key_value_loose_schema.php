<?php
/**
 * KeyValueLooseSchemaBehavior
 * 
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 * Copyright (c) 2010 Takayuki Miwa <i@tkyk.name>
 */

class KeyValueLooseSchemaBehavior extends ModelBehavior
{
  /**
   * @var string  column type of schemaless column.
   */
  var $_schemalessType = 'schemaless';

  /**
   * @var array
   */
  var $_defaultSettings = array('schemalessField' => '_schemaless_data');

  /**
   * setup callback
   */
  function setup(&$model, $settings=array())
  {
    $settings = array_merge($this->_defaultSettings,
			    $settings);

    $this->settings[$model->alias] = $settings;
  }

  /**
   * If the model has schemaless column, returns its name.
   * 
   * @param $model
   * @return string or null
   */
  function getSchemalessField(&$model)
  {
    if($model->getColumnType($this->settings[$model->alias]['schemalessField'])
       == $this->_schemalessType) {
      return $this->settings[$model->alias]['schemalessField'];
    }
    return null;
  }

  /**
   * beforeSave callback
   * 
   * Removes values which are undefined in the $_schema
   * and stores them into $data[$schemalessField].
   * $whiltelist can be used to determine which values are stored.
   * 
   * @param $model
   * @param $options array
   * @return boolean
   */
  function beforeSave(&$model, $options)
  {
    if(!($schemalessField = $model->getSchemalessField())) {
      return true;
    }

    $keys = array_diff(array_keys($model->data[$model->alias]),
		       array_keys($model->schema()));
    if(!empty($model->whitelist)) {
      if(!in_array($schemalessField, $model->whitelist)) {
	$model->whitelist[] = $schemalessField;
      }
      $keys = array_intersect($keys, $model->whitelist);
    }

    $schemaless = array();
    foreach($keys as $key) {
      $schemaless[$key] = $model->data[$model->alias][$key];
      unset($model->data[$model->alias][$key]);
    }
    $model->data[$model->alias][$schemalessField] = $schemaless;
    return true;
  }

  /**
   * This method is called from the DataSources.
   * 
   * Extracts values from $data[$schemalessField] and merges them with $data.
   * 
   * @param $model
   * @param $data array
   */
  function getSchemalessData(&$model, $data)
  {
    if(($schemalessField = $model->getSchemalessField()) &&
       isset($data[$schemalessField])) {
      $schemaless = $data[$schemalessField];
      unset($data[$schemalessField]);
      return $data + $schemaless;
    }
    return $data;
  }
}
