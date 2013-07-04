<?php

//	cve VARCHAR(32) DEFAULT '' NOT NULL

class Formadepago extends AppModel 
{
	public $name = 'Formadepago';
//	public $useTable = 'Formadepagos';
	public $alias = 'Formadepago';

	public $recursive=-1;
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
		'Ventas',
	);


}
