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
	public $stField = 'st';

	public $detailsModel='Entsaldet';
	
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
		'Almacen',
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
				'required' => true,
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
				'required' => true,
				'allowEmpty' => false,
				'message' => 'El Concepto debe contener de 1 a 64 caracteres'
				),
		),
		'esobser' => array( 
			'inbetween' => array(
				'rule' => array('between', 0, 255),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Las Observaciones deben contener hasta 255 caracteres'
				),
		),
		'tipoartmovbodega_id' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Tipo de Movimiento'
			),
		),
		'almacen_id' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Almacén'
			),
		),

	);
/*
	public function getItemWithDetails($id=null) {
		if( !$id && isset($this->id) && 
			(is_numeric($this->id) || is_string($this->id)) ) {
			$id=$this->id;
		}
		$this->recursive=0;

		// Get and Process the Master
		$Item=$this->findById($id);
		if($Item && isset($Item[$this->name])) {
			$Item['Master']=$Item[$this->name];
			unset($Item[$this->name]);
		}
		$Item['masterModel']=$this->name;
		$Item['detailsModel']=$this->detailsModel;
		
		// Get and Process the Details
		$method='findAllBy'.$this->name.'_id';
		$Item['Details']=array();
		$details=$this->{$this->detailsModel}->{$method}($id);
		foreach($details as $detail) {
			$row=array();
			foreach($detail as $key=>$value) {
				if( $key==$this->name )  continue;
				if( $key==$this->detailsModel ) $key='Detail';
				$row[$key]=$value;
			}
			$Item['Details']=$row;
		}

		return( $Item );
	}
*/

	public function loadDependencies() {
		$Tipoartmovbodega = $this->toJsonListArray( $this->Tipoartmovbodega->find('list', 
							array(	'fields' => array('Tipoartmovbodega.id', 'Tipoartmovbodega.cve'),
									'conditions'=>array('visible'=>1) )));
		$Almacen = $this->toJsonListArray( $this->Almacen->find('list', 
							array(	'fields' => array('Almacen.id', 'Almacen.aldescrip')
									 )));
		return compact('Almacen','Tipoartmovbodega');		
	}
/*
	public function ArrayRenameKey($data=array(), $oldKey=null, $newKey=null) {
		$out=array();
		foreach($data as $key=>$value) {
			if($key===$oldKey) {
				$data
			}
		}
	}
*/
}
