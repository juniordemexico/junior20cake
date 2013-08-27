<?php

//	licve VARCHAR(16) DEFAULT '' NOT NULL

class Familia extends AppModel 
{
	var $name = 'Familia';
//	var $useTable = 'familias';
	var $alias = 'Familia';
	var $cache=false;

	var $hasMany = array(
		'Articulo'
		);

	var $belongsTo= array(
		);

	var $validate = array(
		'cve' => array(
			'isunique' => array(
				'rule' => array('isUnique'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 16),
				'message' => 'La Clave debe contener de 1 a 16 caracteres'
			),
		),
		'descrip' => array(
			'between' => array(
				'rule' => array('between', 1, 255),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La DESCRIPCIÓN debe contener entre 1 a 64 caracteres'
			),
		),
		'st' => array(
			'inlist' => array(
				'rule' => array('inList', array('A', 'C', 'S') ),
				'allowEmpty' => false,
				'message' => 'ESTATUS debe ser Activo/Cancelado/Suspendido'
			)
		),
	);
}
