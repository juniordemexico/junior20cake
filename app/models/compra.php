<?php

class Compra extends AppModel 
{
	var $name = 'Compra';
//	var $table = 'Compras';
//	var $useTable= 'Compras';
	var $alias = 'Compra';

	public $primaryKey = 'id';
	public $title = 'folio';
	public $longTitle = null;

	public $detailsModel='Compradet';

	var $cache=false;


	public $_schema = array(
		'folio' => array(
			'type' => 'string', 
			'length' => 8
		),
		'fecha' => array(
			'type' => 'date',
			'length' => 10
		),
		'obser' => array(
			'type' => 'string', 
			'length' => 255
		),
	);


	//The Associations below have been 	, those that are not needed can be removed
	var $belongsTo = array(
		'Proveedor',
		'Divisa',
	);


	public $hasMany = array(
		'Compradet',
	);


	var $validate = array(
		'folio' => array(
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
		'proveedor_refer' => array(
			'inbetween' => array(
				'rule' => array('between', 1, 16),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'El Folio debe contener de 1 a 16 caracteres'
				),
		),
		'fecha' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica la Fecha de la transacción'
			),
			'isdate' => array(
				'rule' => 'date',
				'message' => 'Proporciona una Fecha válida'
			),
		),
		'obser' => array( 
			'inbetween' => array(
				'rule' => array('between', 0, 255),
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Las Observaciones deben contener hasta 255 caracteres'
				),
		),

	);

	public function loadDependencies() {
		$Proveedor = $this->toJsonListArray( $this->Proveedor->find('list', 
							array(	'fields' => array('Proveedor.id', 'Proveedor.prcvepro'),
									'conditions'=>array('prst'=>'A') )));
		$Divisa = $this->toJsonListArray( $this->Divisa->find('list', 
							array(	'fields' => array('Divisa.id', 'Divisa.dicve')
									 )));

		return compact('Proveedor','Divisa');		
	}

}
