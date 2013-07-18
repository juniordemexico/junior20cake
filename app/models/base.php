<?php

//	licve VARCHAR(16) DEFAULT '' NOT NULL

class Base extends AppModel 
{
	var $name = 'Base';
//	var $useTable = 'bases';
	var $alias = 'Base';
	var $primaryKey = 'id';
	var $cache=false;

	var $hasMany = array(
		'Articulo'
		);

	var $belongsTo= array(
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
				'rule' => array('between', 1, 16),
				'message' => 'La Clave debe contener de 1 a 16 caracteres'
			),
		),
		'descrip' => array(
			'between' => array(
				'rule' => array('between', 1, 255),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La DESCRIPCIÓN debe contener entre 1 a 255 caracteres'
			),
		),
		'st' => array(
			'inlist' => array(
				'rule' => array('inList', array('A', 'C', 'S') ),
				'allowEmpty' => false,
				'message' => 'ESTATUS debe ser Activo/Cancelado/Suspendido'
			),
		),
		'visible' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'required' => false,
				'allowEmpty' => true,
		'message' => 'Visible debe ser un valor Verdadero(1) o Falso(0)'
			),
		),
	);
}
