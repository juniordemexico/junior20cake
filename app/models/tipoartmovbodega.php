<?php

//	cve VARCHAR(32) DEFAULT '' NOT NULL

class Tipoartmovbodega extends AppModel 
{
	public $name = 'Tipoartmovbodega';
	public $table = 'Tipoartmovbodegas';
	public $alias = 'Tipoartmovbodega';
	public $cache = true;

	public $validate = array(
		'cve' => array(
			'isunique' => array(
				'rule' => array(
					'isUnique'
				),
				'required' => true,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Esa Clave YA Existe'
			)
		)
	);

	public $hasMany = array(
		'Artmovbodegadetail',
	);


}
