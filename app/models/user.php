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

}

?>