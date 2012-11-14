<?php

//	vest CHAR(1) DEFAULT '' NOT NULL
//	vecomis DECIMAL(10,2) NOT NULL
//	venom VARCHAR(64) DEFAULT '' NOT NULL
//	vecveven VARCHAR(16) DEFAULT NOT NULL
//	vt CHAR(1) DEFAULT '' NOT NULL

class Vendedor extends AppModel 
{
	var $name = 'Vendedor';
	var $table = 'vendedores';
	var $useTable = 'vendedores';
	var $alias = 'Vendedor';


	var $validate = array(
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
		'vt' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'0',
						'1'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Not in list, please enter an item within Vt list'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Cliente',
		'Pedido'
		);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Pais',
		'Divisa',
		'Estado',
	);

}

?>