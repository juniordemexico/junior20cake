<?php
/*
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 * Copyright (c) 2010 Takayuki Miwa <i@tkyk.name>
 */

class KeyValueMemcache extends KeyValueSource
{
  var $_baseConfig = array('host' => 'localhost',
			   'port' => 11211,
			   'default_expire' => 3600,
			   'default_flag' => 0);

  function connect()
  {
    $con = new Memcache();
    if($con->connect($this->config['host'],
		     $this->config['port'])) {
      $this->connection = $con;
      $this->connected = true;
    } else {
      $this->cakeError('failedToConnectMemcached', $this->config);
    }
  }

  function _key($model, $id)
  {
    return md5($model->alias . $id);
  }

  function close()
  {
    $this->connection->close();
  }

  function get(&$model, $id, $query)
  {
    return $this->connection->get($this->_key($model, $id));
  }

  function set(&$model, $id, $data)
  {
    $flag   = isset($model->flag) ? $model->flag : $this->config['default_flag'];
    $expire = isset($model->expire) ? $model->expire : $this->config['default_expire'];
    return $this->connection->set($this->_key($model, $id), $data, $flag, $expire);
  }

  function del(&$model, $id)
  {
    return $this->connection->delete($this->_key($model, $id));
  }

  function count(&$model, $id, $query)
  {
    $key = $this->_key($model, $id);
    $arr = $this->connection->get(is_array($key) ? $key : array($key));
    return is_array($arr) ? count($arr) : 0;
  }
}

