<?php

class Compradet extends AppModel 
{
	var $name = 'Compradet';
//	var $table = 'Compradets';
//	var $useTable='Compradets';
	var $alias = 'Compradet';
	var $cache = false;

	var $primaryKey = 'id';

/*
	public $_schema = array(
	);
*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Compra',
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
		'costo' => array(
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
		return( $this->findAllByCompra_id($master_id) );
	}
	
	public function getDetailTemp($entsal_id=null) {
		return( $this->findAllByCompra_id($master_id) );
	}
	
}
