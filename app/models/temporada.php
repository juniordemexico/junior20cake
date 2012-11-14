<?php

//	tecve VARCHAR(16) DEFAULT '' NOT NULL

class Temporada extends AppModel 
{
	public $name = 'Temporada';
	public $table = 'temporadas';
	public $alias = 'Temporada';
	public $primaryKey = 'id';
	public $cache=true;

	public $hasMany=array(
		'Articulo'
		);


	public $validate = array(
	'tecve' => array(
		'isunique' => array(
			'rule' => array('isUnique'),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'La Clave YA Existe'
		),
		'between' => array(
			'rule' => array('between', 1, 24),
			'message' => 'La Clave debe contener entre 1 y 24 caracteres'
		),
	),
	);

}

?>