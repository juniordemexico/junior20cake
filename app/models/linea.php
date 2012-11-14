<?php

//	licve VARCHAR(16) DEFAULT '' NOT NULL

class Linea extends AppModel 
{
	var $name = 'Linea';
	var $table = 'lineas';
	var $alias = 'Linea';
	var $primaryKey = 'id';
	var $cache=true;

	var $hasMany = array(
		'Articulo'
		);

	var $belongsTo= array(
		'Tipoarticulo'
		);

	var $validate = array(
		'licve' => array(
			'isunique' => array(
				'rule' => array('isUnique'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 4),
				'message' => 'La Clave debe contener entre 1 y 4 caracteres'
			),
		),
		'descrip' => array(
			'between' => array(
				'rule' => array('between', 1, 20),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'La Descripcion debe contener entre 1 y 32 caracteres'
			),
		),
	);
}

?>