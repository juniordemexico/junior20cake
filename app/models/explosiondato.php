<?php

class Explosiondato extends AppModel 
{
	var $name = 'Explosiondato';
	var $table = 'Explosiondatos';
	var $alias = 'Explosiondato';

	var $primaryKey = 'articulo_id';

	public $_schema = array(
		'molde' => array(
			'type' => 'string', 
			'length' => 32
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
/*
	var $belongsTo = array(
		'Articulo',
	);
*/
	var $validate = array(
		'articulo_id' => array(
			'isunique' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe Especificar el Producto Terminado'
			),
		),
	);


}
