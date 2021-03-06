<?php
/**
 * Firebird/Interbase layer for DBO
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       datasources
 * @subpackage    datasources.models.datasources.dbo
 * @since         CakePHP Datasources v 0.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::import('Datasource','DboSource');

/**
 * Firebird/Interbase Datasource
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model.dbo
 */

class DboFirebird extends DboSource {

/**
 * Datasource description
 *
 * @var string
 * @access public
 */
	var $description = "Firebird/Interbase DBO Driver";

/**
 * Saves the original table name
 *
 * @var array
 * @access public
 */
	var $modeltmp = array();

/**
 * Opening quote for quoted identifiers
 *
 * @var string
 */
	var $startQuote = '"';

/**
 * Closing quote for quoted identifiers
 *
 * @var string
 */
	var $endQuote = '"';

/**
 * Alias
 *
 * @var string
 * @access public
 */
//	var $alias = ' ';

/**
 * Goofy Limit
 *
 * @var boolean
 * @access public
 */
	var $goofyLimit = true;

/**
 * Creates a map between field aliases and numeric indexes.
 *
 * @var array
 * @access private
 */
	var $__fieldMappings = array();

/**
 * Base configuration settings for Firebird driver
 *
 * @var array
 * @access protected
 */
	var $_baseConfig = array(
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'SYSDBA',
		'password' => 'masterkey',
		'database' => '/Users/Shared/Develop/db.firebird/MODELBAKER.FDB',
		'port' => '3050',
		'connect' => 'ibase_connect'
	);

/**
 * Closing quote for quoted identifiers
 *
 * @var string
 */
	private static $lastInsertedId = '';

/**
 * Closing quote for quoted identifiers
 *
 * @var string
 */
	private static $affectedId = array();

/**
 * Firebird column definition
 *
 * @var array
 * @access public
 */

	var $columns = array(
		'primary_key' => array('name' => 'IDENTITY (1, 1) NOT NULL'),
		'string'	=> array('name'	 => 'varchar', 'limit' => '255'),
		'text'		=> array('name' => 'BLOB SUB_TYPE 1 SEGMENT SIZE 100 CHARACTER SET NONE'),
		'integer'	=> array('name' => 'integer'),
		'float'		=> array('name' => 'float', 'formatter' => 'floatval'),
		'datetime'	=> array('name' => 'timestamp', 'format'	=> 'd.m.Y H:i:s', 'formatter' => 'date'),
		'timestamp' => array('name'	=> 'timestamp', 'format'	 => 'd.m.Y H:i:s', 'formatter' => 'date'),
		'time'		=> array('name' => 'time', 'format'	   => 'H:i:s', 'formatter' => 'date'),
		'date'		=> array('name' => 'date', 'format'	   => 'd.m.Y', 'formatter' => 'date'),
		'binary'	=> array('name' => 'blob'),
		'boolean'	=> array('name' => 'smallint')
	);

/*
	var $columns = array(
		'primary_key' => array('name' => 'IDENTITY (1, 1) NOT NULL'),
		'string'	=> array('name'	 => 'varchar', 'limit' => '255'),
		'text'		=> array('name' => 'BLOB SUB_TYPE 1 SEGMENT SIZE 100 CHARACTER SET NONE'),
		'integer'	=> array('name' => 'integer'),
		'float'		=> array('name' => 'float', 'formatter' => 'floatval'),
		'datetime'	=> array('name' => 'timestamp', 'format'	=> 'Y-m-d H:i:s', 'formatter' => 'date'),
		'timestamp' => array('name'	=> 'timestamp', 'format'	 => 'Y-m-d H:i:s', 'formatter' => 'date'),
		'time'		=> array('name' => 'time', 'format'	   => 'H:i:s', 'formatter' => 'date'),
		'date'		=> array('name' => 'date', 'format'	   => 'Y-m-d', 'formatter' => 'date'),
		'binary'	=> array('name' => 'blob'),
		'boolean'	=> array('name' => 'smallint')
	);
*/
/**
 * Firebird Transaction commands.
 *
 * @var array
 * @access protected
 */
	var $_commands = array(
		'begin'	   => 'SET TRANSACTION',
		'commit'   => 'COMMIT',
		'rollback' => 'ROLLBACK'
	);

/**
 * Connects to the database using options in the given configuration array.
 *
 * @return boolean True if the database could be connected, else false
 * @access public
 */
	function connect() {
		$config = $this->config;
		$connect = $config['connect'];

		$this->connected = false;

		$this->connection = $connect($config['host'] . ':' . $config['database'], $config['login'], $config['password']);
		$this->connected = true;
	}

/**
 * Check that the interbase extension is loaded
 *
 * @return boolean
 * @access public
 */
	function enabled() {
		return extension_loaded('interbase');
	}
/**
 * Disconnects from database.
 *
 * @return boolean True if the database could be disconnected, else false
 * @access public
 */
	function disconnect() {
		$this->connected = false;
		return @ibase_close($this->connection);
	}

/**
 * Executes given SQL statement.
 *
 * @param string $sql SQL statement
 * @return resource Result resource identifier
 * @access protected
 */
	function _execute($sql) {
			return(@ibase_query($this->connection,	$sql));
	}

/**
 * Returns a row from given resultset as an array .
 *
 * @return array The fetched row as an array
 * @access public
 */
	function fetchRow() {
		if ($this->hasResult()) {
			$this->resultSet($this->_result);
			$resultRow = $this->fetchResult();
			return $resultRow;
		}
		return null;
	}

/**
 * Returns an array of sources (tables) in the database.
 *
 * @return array Array of tablenames in the database
 * @access public
 */
	function listSources() {
		$cache = parent::listSources();

		if ($cache != null) {
			return $cache;
		}
		$sql = "select RDB" . "$" . "RELATION_NAME as name
				FROM RDB" ."$" . "RELATIONS
				Where RDB" . "$" . "SYSTEM_FLAG =0";

		$result = @ibase_query($this->connection,$sql);
		$tables = array();
		while ($row = ibase_fetch_row ($result)) {
			$tables[] = strtolower(trim($row[0]));
		}
		parent::listSources($tables);
		return $tables;
	}

/**
 * Returns an array of the fields in given table name.
 *
 * @param Model $model Model object to describe
 * @return array Fields in table. Keys are name and type
 * @access public
 */
	function describe(&$model) {
		$this->modeltmp[$model->table] = $model->alias;
		$cache = parent::describe($model);

		if ($cache != null) {
			return $cache;
		}
		$fields = false;
		$sql = "SELECT * FROM " . $this->fullTableName($model, false). " ROWS 1";
		$rs = ibase_query($sql);
		$coln = ibase_num_fields($rs);
		$fields = false;
		for ($i = 0; $i < $coln; $i++) {
			$col_info = ibase_field_info($rs, $i);
			$fields[strtolower($col_info['name'])] = array(
					'type' => $this->column($col_info['type']),
					'null' => '',
					'length' => $this->_getFieldLength($col_info, $model)							
					);
		}
		
		$this->__cacheDescription($this->fullTableName($model, false), $fields);
		return $fields;
	}

	private function _getFieldLength(&$fieldMetadata, &$model) {
		// If the Model's property $_schema is set, then return it's value
		if( isset($model->_schema) &&
			isset($model->_schema[$fieldMetadata['name']]) &&
			isset($model->_schema[$fieldMetadata['name']]['length']) 
			) {
				return $model->_schema[$fieldMetadata['name']]['length'];
			}
	
		// When the Model does not define field's length. Then get the field's length from DB metadata
		switch (strtoupper($fieldMetadata['type'])) {
			case 'CHAR':
			case 'VARCHAR':
			case 'TEXT':
				$length=$fieldMetadata['length']; break;
			case 'DATE':
				$length=10; break;
			case 'TIMESTAMP':
			case 'DATETIME':
				$length=16; break;
			default:
				if(
					stristr($fieldMetadata['type'],'NUMERIC') ||
					stristr($fieldMetadata['type'],'DECIMAL') 
				) {
					$theLength=str_ireplace(array('NUMERIC','DECIMAL','(',')'),'',$fieldMetadata['type']);
					$theLength=explode(",", $theLength);
					if( $theLength && isset($theLength[0]) && is_numeric($theLength[0]) ) {
						$theIntegers=$theLength[0];
					}
					if( $theLength && isset($theLength[1]) && is_numeric($theLength[1]) ) {
						$theDecimals=$theLength[1];
					}
					$length=(int)$theIntegers+$theDecimals;
				}
				else {
					$length=$fieldMetadata['length'];
				}
		}
		return $length;
	}
/**
 * Returns a quoted name of $data for use in an SQL statement.
 *
 * @param string $data Name (table.field) to be prepared for use in an SQL statement
 * @return string Quoted for Firebird
 * @access public
 */
	function name($data) {
		if ($data == '*') {
				return '*';
		}
		$pos = strpos($data, '"');

		if ($pos === false) {
			if (!strpos($data, ".")) {
				$data = '"' . strtoupper($data) . '"';
//				$data = '"' . strtoupper($data) . '"';
			} else {
				$build = explode('.', $data);
	//			$data = '"' . strtoupper($build[0]) . '"."' . strtoupper($build[1]) . '"';
				$data = '"' . strtoupper($build[0]) . '"."' . strtoupper($build[1]) . '"';
			}
		}
		return $data;
	}

/**
 * Returns a quoted and escaped string of $data for use in an SQL statement.
 *
 * @param string $data String to be prepared for use in an SQL statement
 * @param string $column The column into which this data will be inserted
 * @param boolean $safe Whether or not numeric data should be handled automagically if no column data is provided
 * @return string Quoted and escaped data
 * @access public
 */
	function value($data, $column = null, $safe = false) {
		$parent = parent::value($data, $column, $safe);

		if ($parent != null) {
			return $parent;
		}
		if ($data === null || (is_array($data) && empty($data))) {
			return 'NULL';
		}
		if ($data === '') {
			return "''";
		}

		switch($column) {
			case 'boolean':
				$data = $this->boolean((bool)$data);
			break;
			default:
				if (get_magic_quotes_gpc()) {
					$data = stripslashes(str_replace("'", "''", $data));
				} else {
					$data = str_replace("'", "''", $data);
				}
			break;
		}
		return "'" . $data . "'";
	}

/**
 * Removes Identity (primary key) column from update data before returning to parent
 *
 * @param Model $model
 * @param array $fields
 * @param array $values
 * @return array
 * @access public
 */
	function update(&$model, $fields = array(), $values = array()) {
		foreach ($fields as $i => $field) {
			if ($field == $model->primaryKey) {
				unset ($fields[$i]);
				unset ($values[$i]);
				break;
			}
		}
		return parent::update($model, $fields, $values);
	}

/**
 * Returns a formatted error message from previous database operation.
 *
 * @return string Error message with error number
 * @access public
 */
	function lastError() {
		$error = ibase_errmsg();

		if ($error !== false) {
			return $error;
		}
		return null;
	}

/**
 * Returns number of affected rows in previous database operation. If no previous operation exists,
 * this returns false.
 *
 * @return integer Number of affected rows
 * @access public
 */
	function lastAffected() {
		if ($this->_result) {
			return ibase_affected_rows($this->connection);
		}
		return null;
	}

/**
 * Returns number of rows in previous resultset. If no previous resultset exists,
 * this returns false.
 *
 * @return integer Number of rows in resultset
 * @access public
 */
	function lastNumRows() {
		return $this->_result? /*ibase_affected_rows($this->_result)*/ 1: false;
	}

/**
 * Returns the ID generated from the previous INSERT operation.
 *
 * @param unknown_type $source
 * @return in
 * @access public
 */
	function lastInsertId($source = null, $field = 'id') {
//		return (lastInsertedId)
		$query = "SELECT RDB\$TRIGGER_SOURCE
		FROM RDB\$TRIGGERS WHERE RDB\$RELATION_NAME = '".  strtoupper($source) .  "' AND
		RDB\$SYSTEM_FLAG IS NULL AND  RDB\$TRIGGER_TYPE = 1 ";

		$result = @ibase_query($this->connection,$query);
		$generator = "";

		while ($row = ibase_fetch_row($result, IBASE_TEXT)) {
			if (strpos($row[0], "NEW." . strtoupper($field))) {
				$pos = strpos($row[0], "GEN_ID(");

				if ($pos > 0) {
					$pos2 = strpos($row[0],",",$pos + 7);

					if ($pos2 > 0) {
						$generator = substr($row[0], $pos +7, $pos2 - $pos- 7);
					}
				}
				break;
			}
		}

		if (!empty($generator)) {
			$sql = "SELECT GEN_ID(". $generator	 . ",0) AS maxi FROM RDB" . "$" . "DATABASE";
			$res = $this->rawQuery($sql);
			$data = $this->fetchRow($res);
			return $data['maxi'];
		}
		return false;
	}

/**
 * Returns a limit statement in the correct format for the particular database.
 *
 * @param integer $limit Limit of results returned
 * @param integer $offset Offset from which to start results
 * @return string SQL limit/offset statement
 * @access public
 */
	function limit($limit, $offset = null) {
		if ($limit) {
			$rt = '';

			if (!strpos(strtolower($limit), 'top') || strpos(strtolower($limit), 'top') === 0) {
				$rt = ' FIRST';
			}
			$rt .= ' ' . $limit;

			if (is_int($offset) && $offset > 0) {
				$rt .= ' SKIP ' . $offset;
			}
			return $rt;
		}
		return null;
	}

/**
 * Converts database-layer column types to basic types
 *
 * @param string $real Real database-layer column type (i.e. "varchar(255)")
 * @return string Abstract column type (i.e. "string")
 * @access public
 */
	function column($real) {
		if (is_array($real)) {
			$col = $real['name'];

			if (isset($real['limit'])) {
				$col .= '(' . $real['limit'] . ')';
			}
			return $col;
		}

		$col = str_replace(')', '', $real);
		$limit = null;
		if (strpos($col, '(') !== false) {
			list($col, $limit) = explode('(', $col);
		}

		if (in_array($col, array('DATE', 'TIME'))) {
			return strtolower($col);
		}
		if ($col == 'TIMESTAMP') {
			return 'datetime';
		}
		if ($col == 'SMALLINT') {
			return 'boolean';
		}
		if (strpos($col, 'int') !== false || $col == 'numeric' || $col == 'INTEGER') {
			return 'integer';
		}
		if (strpos($col, 'char') !== false) {
			return 'string';
		}
		if (strpos($col, 'text') !== false) {
			return 'text';
		}
		if (strpos($col, 'VARCHAR') !== false) {
			return 'string';
		}
		if (strpos($col, 'BLOB') !== false) {
			return 'text';
		}
		if (in_array($col, array('FLOAT', 'NUMERIC', 'DECIMAL'))) {
			return 'float';
		}
		return 'text';
	}

/**
 * Generate Result Set
 *
 * @param unknown_type $results
 * @access public
 */
	function resultSet(&$results) {
		$this->results =& $results;
		$this->map = array();
		$num_fields = ibase_num_fields($results);
		$index = 0;
		$j = 0;

		while ($j < $num_fields) {
			$column = ibase_field_info($results, $j);
			if (!empty($column[2]) ) {
// /* original line:*/		$this->map[$index++] = array(ucfirst(strtolower($this->modeltmp[strtolower($column[2])])), strtolower($column[1]));
				$this->map[$index++] = array(ucfirst(  isset($this->modeltmp[strtolower($column[2])])  ? $this->modeltmp[strtolower($column[2])]:null  ), strtolower($column[1]));
			} else {
				$this->map[$index++] = array(0, strtolower($column[1]));
			}
			$j++;
		}
	}
 
/**
 * Renders a final SQL statement by putting together the component parts in the correct order
 *
 * @param string $type type of query being run.  e.g select, create, update, delete, schema, alter.
 * @param array $data Array of data to insert into the query.
 * @return string Rendered SQL expression to be run.
 * @access public
 */
	function renderStatement($type, $data, $primaryKey='id') {

		extract($data);

		if (strtolower($type) == 'select') {
			if (preg_match('/offset\s+([0-9]+)/i', $limit, $offset)) {
				$limit = preg_replace('/\s*offset.*$/i', '', $limit);
				preg_match('/top\s+([0-9]+)/i', $limit, $limitVal);
				$offset = intval($offset[1]) + intval($limitVal[1]);
				$rOrder = $this->__switchSort($order);
				list($order2, $rOrder) = array($this->__mapFields($order), $this->__mapFields($rOrder));
				return "SELECT * FROM (SELECT {$limit} * FROM (SELECT TOP {$offset} {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$order}) AS Set1 {$rOrder}) AS Set2 {$order2}";
			}
			return "SELECT {$limit} {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$order}";
		}

//		return parent::renderStatement($type, $data);

		$aliases = null;

		switch (strtolower($type)) {
			case 'select':
				return "SELECT {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$group} {$order} {$limit}";
			break;
			case 'create':
				return "INSERT INTO {$table} ({$fields}) VALUES ({$values}) RETURNING {$primaryKey}";
			break;
			case 'update':
				if (!empty($alias)) {
					$aliases = "{$this->alias}{$alias} {$joins} ";
				}
				return "UPDATE {$table} {$aliases}SET {$fields} {$conditions}";
			break;
			case 'delete':
				if (!empty($alias)) {
					$aliases = "{$this->alias}{$alias} {$joins} ";
				}
				return "DELETE {$alias} FROM {$table} {$aliases}{$conditions}";
			break;
			case 'schema':
				foreach (array('columns', 'indexes', 'tableParameters') as $var) {
					if (is_array(${$var})) {
						${$var} = "\t" . join(",\n\t", array_filter(${$var}));
					} else {
						${$var} = '';
					}
				}
				if (trim($indexes) != '') {
					$columns .= ',';
				}
				return "CREATE TABLE {$table} (\n{$columns}{$indexes}){$tableParameters};";
			break;
			case 'alter':
			break;
		}
	}

/**
 * Builds final SQL statement
 *
 * @param string $type Query type
 * @param array $data Query data
 * @return string
 * @access public
 */
/*
	function renderStatement($type, $data) {
		extract($data);

		if (strtolower($type) == 'select') {
			if (preg_match('/offset\s+([0-9]+)/i', $limit, $offset)) {
				$limit = preg_replace('/\s*offset.*$/i', '', $limit);
				preg_match('/top\s+([0-9]+)/i', $limit, $limitVal);
				$offset = intval($offset[1]) + intval($limitVal[1]);
				$rOrder = $this->__switchSort($order);
				list($order2, $rOrder) = array($this->__mapFields($order), $this->__mapFields($rOrder));
				return "SELECT * FROM (SELECT {$limit} * FROM (SELECT TOP {$offset} {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$order}) AS Set1 {$rOrder}) AS Set2 {$order2}";
			}
			return "SELECT {$limit} {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$order}";
		}
		return parent::renderStatement($type, $data);
	}
*/

/**
 * Fetches the next row from the current result set
 *
 * @return unknown
 * @access public
 */
	function fetchResult() {
		if ($row = ibase_fetch_row($this->results, IBASE_TEXT)) {
			$resultRow = array();
			$i = 0;

			foreach ($row as $index => $field) {
				list($table, $column) = $this->map[$index];
				if (trim($table) == "") {
					$resultRow[0][$column] = $row[$index];
				} else {
					$resultRow[$table][$column] = $row[$index];
					$i++;
				}
			}
			return $resultRow;
		}
		return false;
	}


/**
 * Queries the database with given SQL statement, and obtains some metadata about the result
 * (rows affected, timing, any errors, number of rows in resultset). The query is also logged.
 * If Configure::read('debug') is set, the log is shown all the time, else it is only shown on errors.
 *
 * ### Options
 *
 * - stats - Collect meta data stats for this query. Stats include time take, rows affected,
 *   any errors, and number of rows returned. Defaults to `true`.
 * - log - Whether or not the query should be logged to the memory log.
 *
 * @param string $sql
 * @param array $options
 * @return mixed Resource or object representing the result set, or false on failure
 * @access public
 */
	function execute($sql, $options = array()) {
		$defaults = array('stats' => true, 'log' => $this->fullDebug);
		$options = array_merge($defaults, $options);

		$t = getMicrotime();
		$this->_result = $this->_execute($sql);
		if ($options['stats']) {
			$this->took = round((getMicrotime() - $t) * 1000, 0);
			$this->affected = $this->lastAffected();
			$this->error = $this->lastError();
			$this->numRows = $this->lastNumRows();
		}

		if ($options['log']) {
			$this->logQuery($sql);
		}

		if ($this->error) {
			$this->showQuery($sql);
			return false;
		}

		return $this->_result;
	}

	function create(&$model, $fields = null, $values = null) {
		$id = null;

		if ($fields == null) {
			unset($fields, $values);
			$fields = array_keys($model->data);
			$values = array_values($model->data);
		}
		$count = count($fields);

		for ($i = 0; $i < $count; $i++) {
			$valueInsert[] = $this->value($values[$i], $model->getColumnType($fields[$i]), false);
		}
		for ($i = 0; $i < $count; $i++) {
			$fieldInsert[] = $this->name($fields[$i]);
			if ($fields[$i] == $model->primaryKey) {
				$id = $values[$i];
			}
		}
		$query = array(
			'table' => $this->fullTableName($model),
			'fields' => implode(', ', $fieldInsert),
			'values' => implode(', ', $valueInsert)
		);

		if ($this->execute($this->renderStatement('create', $query, $model->primaryKey))) {
			if (empty($id)) {
					$first=$this->fetchRow();
						if(isset($first[$model->name][$model->primaryKey])) {
							$id=($first[$model->name][$model->primaryKey]);
						}
						else {
							$id = $this->lastInsertId($this->fullTableName($model, false), $model->primaryKey);							
						}
			}
			$model->setInsertID($id);
			$model->id = $id;
			return true;
		} else {
			$model->onError();
			return false;
		}
	}

}