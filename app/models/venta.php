<?php

class Venta extends AppModel 
{
	var $name = 'Venta';
//	var $table = 'Ventas';
//	var $useTable= 'Ventas';
	var $alias = 'Venta';

	public $primaryKey = 'id';
	public $title = 'folio';
	public $longTitle = null;

	public $detailsModel='Ventadet';

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
		'Vendedor',
		'Cliente',
		'Formadepago',
		'Divisa'
	);


	public $hasMany = array(
		'Ventadet',
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
		'cliente_id' => array(
			'inbetween' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe especificar el cliente'
				),
		),
		'vendedor_id' => array(
			'inbetween' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe especificar el vendedor'
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
		$Cliente = $this->toClientoteJsonListArray( $this->Cliente->find('all', 
							array(	'fields' => array('Cliente.id', 'Cliente.clcvecli', 'Cliente.cltda', 'Cliente.clnom'),
									'conditions'=>array('clst'=>'A'),
									'order'=>array('Cliente.clcvecli', 'Cliente.cltda') 
									)));

		$Vendedor = $this->toJsonListArray( $this->Vendedor->find('list', 
							array(	'fields' => array('Vendedor.id', 'Vendedor.vecveven'),
									'conditions'=>array('vest'=>0),
									'order'=>array('Vendedor.vecveven') 
									 )));
		$Divisa = $this->toJsonListArray( $this->Divisa->find('list', 
							array(	'fields' => array('Divisa.id', 'Divisa.dicve')
									 )));
		$Formadepago = $this->toJsonListArray( $this->Formadepago->find('list', 
							array(	'fields' => array('Formadepago.id', 'Formadepago.cve'),
									'conditions'=>array('st'=>'A'),
									 )));

		$ClienteLista = $this->toClienteJsonListArray( $this->Cliente->find('all', 
							array(	'fields' => array('Cliente.id', 'Cliente.clcvecli', 'Cliente.cltda', 'Cliente.clnom'),
									'conditions'=>array('clst'=>'A'),
									'order'=>array('Cliente.clcvecli', 'Cliente.cltda') 
									)));

		return compact('Cliente', 'ClienteLista', 'Vendedor', 'Divisa', 'Formadepago');		
	}

    public function toClienteJsonListArray($arr = null)
    {
        $ret = null;
		
        if (!empty($arr)) {
            $ret = array();
            foreach ($arr as $k => $v) {
                $ret[] = array('id' => $v['Cliente']['id'], 'clcvecli' => $v['Cliente']['clcvecli'], 'cltda'=>trim($v['Cliente']['cltda']), 'clnom'=>trim($v['Cliente']['clnom']));
            }
        }
		return $ret;
    }

    public function toClientoteJsonListArray($arr = null)
    {
        $ret = null;
		
        if (!empty($arr)) {
            $ret = array();
            foreach ($arr as $k => $v) {
                $ret[] = array('id' => $v['Cliente']['id'], 'cve' => '( '.trim($v['Cliente']['clcvecli']).' - '.$v['Cliente']['cltda'].' ) '.$v['Cliente']['clnom'] );
            }
        }
		return $ret;
    }

}
