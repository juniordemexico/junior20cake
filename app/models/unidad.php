<?php

//	cve VARCHAR(16) DEFAULT '' NOT NULL
//	nom VARCHAR(64) DEFAULT '' NOT NULL

class Unidad extends AppModel 
{
	public $name = 'Unidad';
	public $table = 'Unidades';
	public $alias = 'Unidad';
	public $cache=true;

	public $hasMany = array(
		'Articulo'
		);
		
	public $validate = array(
		'cve' => array(
			'isunique' => array(
				'rule' => array('isUnique'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			)
		),
	);

}

?>