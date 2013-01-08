<?php

class Invfisico extends AppModel 
{
	var $name = 'Invfisico';
	var $table = 'invfisicos';
	var $alias = 'Invfisico';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Almacen',
		);

	var $hasMany = array(
		'Invfisicodetail',
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
			'rule' => array('date','ymd'),
	            'message' => 'Escribe una fecha válida',
	            'required' => true,
	            'allowEmpty' => false
	        ),
		'finicio' => array(
            'rule' => array('date','ymd'),
		            'message' => 'Escribe una fecha válida',
		            'required' => false,
		            'allowEmpty' => true
	        ),
		'ftermino' => array(
            'rule' => array('date','ymd'),
		            'message' => 'Escribe una fecha válida',
		            'required' => false,
		            'allowEmpty' => true
	        ),
		'st' => array(
		            'rule' => array('inList', array('A', 'I', '1', '2', 'C', 'P')),
		            'message' => 'El estatus debe ser (A)ctivo, (I)nicializado, (1)er conteo, (2) conteo, (C)errado, (P)rocesado ',
		            'required' => false,
		            'allowEmpty' => false
	        ),
	);
	
}
