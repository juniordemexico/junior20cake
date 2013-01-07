<?php

//	vest CHAR(1) DEFAULT '' NOT NULL

class User extends AppModel 
{
	public $name = 'User';
	public $table = 'users';
	public $useTable = 'users';
	public $alias = 'User';
	public $cache=true;

	public $_schema=array(
		'username' => array(
			'type' => 'string', 
			'length' => 16
		),
		'password' => array(
			'type' => 'string', 
			'length' => 16
		),
	);

	public $validate = array(
		'username' => array(
			'usernameisunique' => array(
				'rule' => array(
					'isUnique'
			),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'Ese Nombre de Usuario YA esta registrado'
			),
			'usernamebetween' => array(
			'rule' => array('between', 2, 16),
			'message' => 'El Nombre de Usuario debe contener entre 2 y 16 caracteres'
			),
		),
		'email' => array(
			'email' => array('rule' => 'email',
			'message' => 'Proporcione un Correo Electronico valido'
		)),
		'st' => array(
			'inlist' => array(
			'rule' => array('inList', array('A', 'B', 'S') ),
			'message' => 'El Estatus debe ser (A)ctivo (B)aja (S)uspendido'
		)),
		'remoteaccess' => array(
			'boolean' => array(
			'rule' => array('boolean'),
			'message' => 'Acceso Remoto requiere un valor Verdadero(1) o Falso(0)'
		)),

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
//	public $hasMany = array(
//		'UsersVendedor'
//	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Group',
	);

	public $hasMany = array(
	);

/*
 * Static methods that can be used to retrieve the logged in user
 * from anywhere
 *
 * Copyright (c) 2008 Matt Curry
 * www.PseudoCoder.com
 * http://github.com/mcurry/cakephp/tree/master/snippets/static_user
 * http://www.pseudocoder.com/archives/2008/10/06/accessing-user-sessions-from-models-or-anywhere-in-cakephp-revealed/
 *
 * @author      Matt Curry <matt@pseudocoder.com>
 * @license     MIT
 *
 */

//in AppController::beforeFilter:
//App::import('Model', 'User');
//User::store($this->Auth->user());

public static function &getInstance($user=null) {
  static $instance = array();

  if ($user) {
    $instance[0] =& $user;
  }

  if (!$instance) {
    trigger_error(__("User not set.", true), E_USER_WARNING);
    return false;
  }

  return $instance[0];
}

public static function store($user) {
  if (empty($user)) {
    return false;
  }

  User::getInstance($user);
}

public static function get($path) {
  $_user =& User::getInstance();

  $path = str_replace('.', '/', $path);
  if (strpos($path, 'User') !== 0) {
    $path = sprintf('User/%s', $path);
  }

  if (strpos($path, '/') !== 0) {
    $path = sprintf('/%s', $path);
  }

  $value = Set::extract($path, $_user);

  if (!$value) {
    return false;
  }

  return $value[0];
}

public function getDefaultPrinter($type='Default') {
	
}


}

?>