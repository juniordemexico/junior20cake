<?php

//	vest CHAR(1) DEFAULT '' NOT NULL
//	vecomis DECIMAL(10,2) NOT NULL
//	venom VARCHAR(64) DEFAULT '' NOT NULL
//	vecveven VARCHAR(16) DEFAULT NOT NULL
//	vt CHAR(1) DEFAULT '' NOT NULL

class UserVendedor extends AppModel 
{
	public $name = 'UserVendedor';
	public $table = 'users_vendedores';
	public $useTable = 'users_vendedores';
	public $alias = 'UserVendedor';
	public $cache=true;


	public $validate = array(
		'vest' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'A',
						'S',
						'B'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Not in list, please enter an item within Vest list'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'User',
		'Vendedor'
	);


}

?>