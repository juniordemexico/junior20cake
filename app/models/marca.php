<?php

//	macve VARCHAR(16) DEFAULT '' NOT NULL

class Marca extends AppModel 
{
	var $name = 'Marca';
	var $table = 'marcas';
	var $alias = 'Marca';
	var $primaryKey= 'id';
	var $cache=true;
	
	var $hasMany=array(
		'Articulo'
		);

	var $validate = array(
	'macve' => array(
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
	'descrip' => array(
		'between' => array(
			'rule' => array('between', 1, 32),
			'required' => false,
			'allowEmpty' => true,
			'message' => 'El nomvre debe contener entre 1 y 32 caracteres'
		),
	),
	);

}

?>