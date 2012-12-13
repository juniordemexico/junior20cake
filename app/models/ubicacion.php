<?php

class Ubicacion extends AppModel 
{
	var $name = 'Ubicacion';
	var $table = 'ubicaciones';
	var $alias = 'Ubicacion';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Almacen',
		);

	var $hasMany = array(
//		'Invfisicodetail',
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
				'required' => false,
				'allowEmpty' => true,
				'rule' => array('between', 3, 7),
				'message' => 'La Clave debe contener entre 3 y 7 caracteres'
			),
		),
		'area' => array(
			'between' => array(
				'rule' => array('between', 1, 1),
				'message' => 'Area se compone de 1 caracter alfabetico (A...Z)',
				'required' => false,
				'allowEmpty' => true,
				),
		),
		'fila' => array(
			'between' => array(
				'rule' => array('between', 2, 2),
				'message' => 'Fila consta de 2 caracteres numericos (01, 02 ... 99)',
				'required' => false,
				'allowEmpty' => true,
				),
		),
		'espacio' => array(
			'between' => array(
				'rule' => array('between', 4, 4),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Espacio consta de 4 digitos (0001, 0002 ... 9999)',
				),
		),
		'descrip' => array(
			'between' => array(
				'rule' => array('between', 1, 32),
				'message' => 'La Descripcion debe contener entre 1 y 32 caracteres',
				'required' => false,
				'allowEmpty' => true,
			),
		),
	);
}
