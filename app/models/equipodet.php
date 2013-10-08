<?php

//	vest CHAR(1) DEFAULT '' NOT NULL
//	vecomis DECIMAL(10,2) NOT NULL
//	venom VARCHAR(64) DEFAULT '' NOT NULL
//	vecveven VARCHAR(16) DEFAULT NOT NULL
//	vt CHAR(1) DEFAULT '' NOT NULL

class Equipodet extends AppModel 
{
	var $name = 'Equipodet';
	var $table = 'equipodets';
//	var $useTable = 'equipodets';
	var $alias = 'Equipodet';


	var $validate = array(
		'descripbetween' => array(
				'rule' => array('between', 1, 32),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'CLAVE debe contener entre 1 y 32 caracteres'
			)
		),
		'st' => array(
			'inlist' => array(
				'rule' => array('inList', array('A', 'B', 'S') ),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'ESTATUS debe ser Activo/Baja/Suspendido'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Equipo',
//		'Tipoequipo',
	);

}
