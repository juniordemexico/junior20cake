<?php

class Cliente extends AppModel 
{
	var $name = 'Cliente';
	var $table = 'clientes';
	var $alias = 'Cliente';

	public $_schema = array(
		'clcvecli' => array(
			'type' => 'string', 
			'length' => 4
		),
		'cltda' => array(
			'type' => 'string', 
			'length' => 4
		),
		'clnom' => array(
			'type' => 'string',
			'length' => 64
		),
		'cldesc1' => array(
			'type' => 'float',
			'length' => 4
		),
		'cldesc2' => array(
			'type' => 'float',
			'length' => 4
		),
		'cldesc3' => array(
			'type' => 'float',
			'length' => 4
		),
		'clplazo' => array(
			'type' => 'integer',
			'length' => 3
		),
		'seriefactura' => array(
			'type' => 'string',
			'length' => 4
		),
	);
	
	var $validate = array(
		'clcvecli' => array(
			'cvebetween' => array(
				'rule' => array('between', 1, 4),
				'message' => 'CLAVE debe contener entre 1 y 4 caracteres',
				'required' => true,
				'allowEmpty' => false,
				)
		),
		'cltda' => array(
			'tdabetween' => array(
				'rule' => array('between', 0, 4),
				'message' => 'TIENDA debe contener hasta 4 caracteres',
				'required' => true,
				'allowEmpty' => true,
				)
		),		
		'clnom' => array(
			'cvebetween' => array(
				'rule' => array('between', 1, 64),
				'message' => 'NOMBRE / RAZON SOCIAL debe contener entre 1 y 64 caracteres',
				'required' => true,
				'allowEmpty' => false,
				)
		),
		'clst' => array(
			'inlist' => array(
				'rule' => array('inList', array('A', 'B', 'C', 'S') ),
				'allowEmpty' => false,
				'message' => 'ESTATUS debe ser Activo/Cancelado/Suspendido'
				)
		),
		'cllocfor' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'0',
						'1'
					)
				),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Los posibles valores son: 0-Local, 1-Foráneo'
			)
		),
		'seriefactura' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'A',
						'B',
						'C',
						'D',
						'E'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Elige serie ( A / B / C / D)'
			)
		),
		'clt' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'0',
						'1'
					)
				),
				'required' => false,
				'allowEmpty' => true,
				'on' => null,
				'message' => 'Los posibles valores son 0 y 1'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Divisa', 'Estado', 'Pais', 'Vendedor'
	);

	var $hasMany = array(
		'Clientesdireccion'=>array(
			'dependent'=>true,
			),
		'Pedido',
		'Factura',
	);

	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			$options=$this->generateJoinUservendedor($options);
			return(parent::beforeFind( $options ));
		}
		$options=$this->generateJoinUservendedor($options);
		return (parent::beforeFind($options));
	}


	function getMovs() {
		$rs=$this->query("SELECT CTEMOV.* from CTEMOV CTEMOV ORDER BY CTEMOV.cmcvecli,CTEMOV.cmtda,CTEMOV.cmfecha,CTEMOV.cmrefer ROWS 10000");
		print_r($rs);
		die();
		return($rs);
	}
}
