<?php

class Entsaldet extends AppModel 
{
	var $name = 'Entsaldet';
//	var $table = 'Entsaldet';
//	var $useTable='Entsaldet';
	var $alias = 'Entsaldet';
	var $cache = false;

	var $primaryKey = 'id';

/*
	public $_schema = array(
	);
*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Entsal',
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
		'esdt0' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Especifica la Cantidad'
			),
			'inbetween' => array(
				'rule' => array('between', 0.01, 9999999.99),
				'message' => 'El valor máximo de cantidad es 9,999,999.99'
				),
		),
		'esdt0' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Especifica la Cantidad'
			),
			'inbetween' => array(
				'rule' => array('between', 0.01, 9999999.99),
				'message' => 'El valor máximo de cantidad es 9,999,999.99'
				),
		),
		'esdt1' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Especifica la Cantidad'
			),
			'inbetween' => array(
				'rule' => array('between', 0.01, 9999999.99),
				'message' => 'El valor máximo de cantidad es 9,999,999.99'
				),
		),
	);

	public function getDetail($entsal_id=null) {
		return( $this->findAllByEntsal_id($entsal_id) );
	}
	
	public function getDetailTemp($entsal_id=null) {
		return( $this->findAllByEntsal_id($entsal_id) );
	}
	
}
