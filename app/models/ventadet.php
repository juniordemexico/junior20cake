<?php

class Ventadet extends AppModel 
{
	var $name = 'Ventadet';
//	var $table = 'Ventadets';
//	var $useTable='Ventadets';
	var $alias = 'Ventadet';
	var $cache = false;

	var $primaryKey = 'id';

/*
	public $_schema = array(
	);
*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Venta',
		'Articulo',
		'Color',
		'Talla',
	);

	var $validate = array(
		'articulo_id' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Código del articulo'
			),
		),
		'color_id' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Color del articulo'
			),
		),
		'cant' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Especifica la Cantidad'
			),
			'inbetween' => array(
				'rule' => array('between', 0.01, 9999999.99),
				'message' => 'El valor máximo de cantidad es 9,999,999.99'
				),
		),
		'precio' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Especifica el Costo'
			),
			'inbetween' => array(
				'rule' => array('between', 0.0001, 9999999.99),
				'message' => 'El valor máximo del costo es 9,999,999.9999'
				),
		),
	);

	public function getDetail($master_id=null) {
		return( $this->findAllByVenta_id($master_id) );
	}
	
	public function getDetailTemp($entsal_id=null) {
		return( $this->findAllByVenta_id($master_id) );
	}
	
}
