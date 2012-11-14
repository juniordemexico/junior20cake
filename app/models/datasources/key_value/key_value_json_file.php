<?php
/*
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 * Copyright (c) 2010 Takayuki Miwa <i@tkyk.name>
 */

class KeyValueJsonFile extends KeyValueSource
{
  var $_baseConfig = array('root' => TMP,
			   'path' => '',
			   'dir_mode'  => 0777,
			   'file_mode' => 0666);
  var $_baseDir;

  function baseDir()
  {
    return $this->_baseDir ? $this->_baseDir
      : ($this->_baseDir = $this->config['root'] . $this->config['path']);
  }

  function connect()
  {
    $base = $this->baseDir();
    if(!is_dir($base) || !is_writable($base)) {
      $this->log($base ." is not a valid writable directory.");
      $this->cakeError('dirNotWritable', array('path' => $base));
      return false;
    }
  }

  function get(&$model, $id, $query)
  {
    if($this->count($model, $id, $query) > 0 &&
       $str = file_get_contents($this->_filePath($model, $id))) {

      if(!isset($query['decode'])) {
	$query['decode'] = 'array';
      }
      switch($query['decode']) {
      case false:
	return $str;
      case 'object':
	return json_decode($str, false);
      default:
	return json_decode($str, true);
      }
    }
    return false;
  }

  function set(&$model, $id, $data)
  {
    $path = $this->_filePath($model, $id);
    return $this->_makeDir($path) &&
      file_put_contents($path, json_encode($data)) &&
      chmod($path, $this->config['file_mode']);
  }

  function del(&$model, $id)
  {
    return unlink($this->_filePath($model, $id));
  }

  function count(&$model, $id, $query)
  {
    return file_exists($this->_filePath($model, $id)) ? 1 : 0;
  }

  function _filePath($model, $id)
  {
    return $this->baseDir() .DS. $model->alias .DS. $id;
  }

  function _makeDir($path)
  {
    $d = dirname($path);
    return is_dir($d) || mkdir($d, $this->config['dir_mode']);
  }
}

