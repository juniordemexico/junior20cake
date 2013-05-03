<?php

class Entsal extends AppModel 
{
	var $name = 'Entsal';
//	var $table = 'Entsal';
//	var $useTable= 'Entsal';
	var $alias = 'Entsal';

	public $primaryKey = 'id';
	public $title = 'esrefer';
	public $longTitle = null;
	public $stField = 'esst';

	var $cache=false;


	public $_schema = array(
		'esrefer' => array(
			'type' => 'string', 
			'length' => 8
		),
		'esfecha' => array(
			'type' => 'date',
			'length' => 10
		),
		'esconcep' => array(
			'type' => 'string', 
			'length' => 64
		),
		'esobser' => array(
			'type' => 'string', 
			'length' => 255
		),
	);


	//The Associations below have been 	, those that are not needed can be removed
	var $belongsTo = array(
		'Tipoartmovbodega',
	);


	public $hasMany = array(
		'Entsaldet',
	);


	var $validate = array(
		'esrefer' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Folio de la transacción'
			),
			'isunique' => array(
				'rule' => array('isUnique'),
				'message' => 'El Folio especificado YA existe'
				),
			'inbetween' => array(
				'rule' => array('between', 2, 8),
				'message' => 'El Folio debe contener de 2 a 8 caracteres'
				),
		),
		'esfecha' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Especifica la Fecha de la transacción'
			),
			'isdate' => array(
				'rule' => 'date',
				'message' => 'Proporciona una Fecha válida'
			),
		),
		'esconcep' => array( 
			'inbetween' => array(
				'rule' => array('between', 1, 64),
				'required' => false,
				'allowEmpty' => false,
				'message' => 'El Concepto debe contener de 1 a 64 caracteres'
				),
		),
		'esobser' => array( 
			'inbetween' => array(
				'rule' => array('between', 0, 255),
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Las Observaciones deben contener hasta 255 caracteres'
				),
		),
		'artmovbodega_id' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Tipo de Movimiento'
			),
		),

	);

	public function getDetails($id=null) {
		if (!$id && $this->id>0) 
		$this->Entsaldet->recursive=0;
		return( $this->Entsaldet->findAllByEntsal_id($id) );
	}
	
}