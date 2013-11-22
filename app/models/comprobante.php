<?php

class Comprobante extends AppModel 
{
	var $name = 'Comprobante';
	var $table = 'Comprobantes';
	var $alias = 'Comprobante';
	public $cache=false;
	var $primaryKey = 'id';

	public $_schema = array(
		'insumopropio' => array(
			'type' => 'string', 
			'length' => 1
		),
		't0' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't1' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't2' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't3' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't4' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't5' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't6' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't7' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't8' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't9' => array(
			'type' => 'boolean', 
			'length' => 1
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Factura' => array(
			'className'=>'Articulo',
			'foreignKey'=>'material_id',
			'conditions'=>'Material.tipoarticulo_id<>0',
			),
	);

/*
	public $hasOne = array(
		'Comprobantedato' => array(
			'className'=>'Comprobantedato',
			'foreignKey'=>'articulo_id',
			)	
	);
*/

	var $validate = array(
		'id' => array(
			'isunique' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe Especificar el ID del Documento correspondiente al Comprobante'
			),
		),
	);

	
}
