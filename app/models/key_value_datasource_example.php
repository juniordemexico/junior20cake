<?php

// Schemaless Model
/*
class SchemalessUser extends AppModel {
  var $useDbConfig = 'json';
  var $looseSchema = true;
}

// Loose-Schema Model
class LooseUser extends AppModel {
  var $useDbConfig = 'memcache';
  var $primaryKey = 'key'
  var $looseSchema = array('key' => array('type' => 'string', 'length' => 255),
                           'name' => array('type' => 'string'),
                           'updated' => array('type' => 'datetime'));
}
*/
// Strict (regular) schema Model
class StrictUser extends AppModel {
  var $useDbConfig = 'json';
  var $_schema = array('id' => array('type' => 'string', 'length' => 255),
                       'name' => array('type' => 'string'),
                       'updated' => array('type' => 'datetime'));
}

?>