<?php

class Almacen extends AppModel 
{
	var $name = 'Almacen';
	var $table = 'almacenes';
	var $alias = 'Almacen';
	var $primaryKey = 'id';
	var $cache=false;

	var $hasMany = array(
		'Ubicacion',
		);

	var $validate = array(
		'alcve' => array(
			'isunique' => array(
				'rule' => array('isUnique'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 2),
				'message' => 'La Clave debe contener entre 1 y 2 caracteres'
			),
		),
		'aldescrip' => array(
			'between' => array(
				'rule' => array('between', 1, 32),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La Descripcion debe contener entre 1 y 32 caracteres'
			),
		),
	);
}
