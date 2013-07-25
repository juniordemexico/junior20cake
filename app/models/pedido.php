<?php


class Pedido extends AppModel 
{
	public $name = 'Pedido';
//	public $table = 'pedido';
//	public $useTable = 'Pedido';
	public $alias = 'Pedido';
	public $cache = false;

	public $title = 'perefer';
	public $longTitle = null;

	public $detailsModel='Pedidodet';

	public $virtualFields = array(
		'peimporte' => 'peimporte',
		'peimpoimpu' => 'peimpoimpu',
		'petotal' => 'petotal'
		);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Divisa',
		'Cliente',
		'Vendedor'
	);

	public $hasMany = array(
		'Pedidodet'
	);
		
	public $validate = array(
		'perefer' => array(
			'isunique' => array(
				'rule' => array('isUnique'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
				),
			'between' => array(
				'rule' => array('between', 1, 8),
				'message' => 'FOLIO se compone hasta de 8 caracteres maximo'
				)
			),
		'pedescu1' => array(
			'decimal' => array(
				'rule' => array(
					'decimal',
					2,
					null
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Please enter a decimal for Descuento 1'
			)
		),
		'pedescu2' => array(
			'decimal' => array(
				'rule' => array(
					'decimal',
					2,
					null
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Please enter a decimal for Descuento 2'
			)
		),
		'peimpu1' => array(
			'decimal' => array(
				'rule' => array(
					'decimal',
					2,
					null
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Please enter a decimal for Impuesto 1'
			)
		),
		'peimpu2' => array(
			'decimal' => array(
				'rule' => array(
					'decimal',
					2,
					null
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Please enter a decimal for Impuesto 2'
			)
		),
		'perefer' => array(
			'isunique' => array(
				'rule' => array(
					'isUnique'
				),
				'required' => true,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'This Refer has already been taken, please enter an unique Refer'
			)
		),
		'pest' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array('A', 'B', 'S')
				),
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Not in list, please enter an item within ST list'
			)
		),
	);


	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			return(parent::beforeFind($this->generateJoinUservendedor($options)));
		}
		return (parent::beforeFind($options));
	}

	function getDetail($id=null) {
		if(!$id) return (null);
		$this->recursive=1;
		$conditions = array('Pedidodet.id'=>$id);
		
		$fields = array('Pedidodet.id','Pedidodet.pedido_id','Pedidodet.articulo_id','Pedidodet.color_id',
						'Pedidodet.pedpedido','Pedidodet.pedprecio','Pedidodet.peddesc1','Pedidodet.peddesc2',
						'Pedidodet.pedImpu1','Pedidodet.pedImpu2','Pedidodet.pedImporte',
						'Articulo.arcveart','Articulo.ardescrip','Color.cve',
						'Pedidodet.pedpt0','Pedidodet.pedpt1','Pedidodet.pedpt2','Pedidodet.pedpt3',
						'Pedidodet.pedpt4','Pedidodet.pedpt5','Pedidodet.pedpt6','Pedidodet.pedpt7',
						'Pedidodet.pedpt8','Pedidodet.pedpt9'
						);
		return $this->find('all', array('fields'=>$fields, 'conditions' => compact($conditions)));  
	}

	function getDetailTallaColor($child_id=null) {
		if(!$child_id) return (null);
		$this->recursive=1;
		$conditions = array('Pedidodet.pedido_id'=>$this->id,'Pedidodet.articulo_id'=>$child_id);
		return $this->find('all', compact($conditions));  
	}
	
	function Autoriza($id=null) {
		if( !$id && (!isset($this->id) || empty($this->id)) ) {
			$this->transactionResult="Error: No se especifico el ID";
			return false;
		}
		if($id) {
			$this->read(null, $id);
		}
		if(empty($this->id)) {
			$this->transactionResult="Error: Transaccion Invalida";
			return false;
		}
		$theDate=date('Y/m/d');
		if ($this->saveField('pefauto', $theDate) &&
		    $this->saveField('peauto', 1) ) {
			$this->transactionResult="Autorizado ".$theDate;
			return true;
		}
		$this->transactionResult="Error";
		return false;
	}

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

?>