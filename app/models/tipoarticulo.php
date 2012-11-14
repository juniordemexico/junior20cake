<?php

//	cve VARCHAR(32) DEFAULT '' NOT NULL

class Tipoarticulo extends AppModel 
{
	public $name = 'Tipoarticulo';
	public $table = 'Tipoarticulos';
	public $alias = 'Tipoarticulo';
	public $cache=true;

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
		'Articulo',
		'Color',
		'Linea',
	);


}

?>