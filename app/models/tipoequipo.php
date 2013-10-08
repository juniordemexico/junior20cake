<?php

//	cve VARCHAR(32) DEFAULT '' NOT NULL

class Tipoequipo extends AppModel 
{
	public $name = 'Tipoequipo';
	public $table = 'tipoequipos';
	public $alias = 'Tipoequipo';
//	public $cache=true;

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
			),
			'cvebetween' => array(
				'rule' => array('between', 1, 32),
				'message' => 'CLAVE debe contener entre 1 y 32 caracteres'
			)
		),
		'st' => array(
			'inlist' => array(
				'rule' => array('inList', array('A', 'B', 'S') ),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'ESTATUS debe ser Activo/Baja/Suspendido'
			)
		),
		'visible' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'VISIBLE debe tener un valor Verdadero(1) o Falso(0)'
			)
		)
	);

/*
	public $hasMany = array(
		'Equipo',
		'Equipodet',
	);
*/

}
