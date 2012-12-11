<?php

class Inventariofisico extends AppModel 
{
	var $name = 'Inventariofisico';
	var $table = 'inventariofisicos';
	var $alias = 'Inventariofisico';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Almacen',
		);

	var $hasMany = array(
		'Inventariofisicodetail',
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
				'rule' => array('between', 1, 32),
				'message' => 'La Clave debe contener entre 1 y 32 caracteres'
			),
		),
		'fecha' => array(
			'isunique' => array(
				'rule' => array('isDate'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 8),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
		'finicio' => array(
			'isunique' => array(
				'rule' => array('isData'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 10),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
		'finicio2' => array(
			'isunique' => array(
				'rule' => array('isData'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 10),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
		'ftermino' => array(
			'isunique' => array(
				'rule' => array('isData'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 10),
				'message' => 'Debe especificar la fecha correctamente'
			),
		),
	);
}
