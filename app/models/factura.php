<?php

//	cldesc2 DECIMAL(10,2) NOT NULL
//	clsuc VARCHAR(64) DEFAULT '' NOT NULL
//	clcvecli VARCHAR(16) DEFAULT NOT NULL
//	clbanco VARCHAR(16) DEFAULT NOT NULL
//	clcuenta VARCHAR(16) DEFAULT NOT NULL
//	clprecio CHAR(1) DEFAULT '' NOT NULL
//	clatn VARCHAR(64) DEFAULT '' NOT NULL
//	cllocfor CHAR(1) DEFAULT '' NOT NULL
//	clrfc VARCHAR(16) DEFAULT NOT NULL
//	cldesc3 DECIMAL(10,2) NOT NULL
//	cltda VARCHAR(16) DEFAULT NOT NULL
//	clt CHAR(1) DEFAULT '' NOT NULL
//	clnom VARCHAR(16) DEFAULT NOT NULL
//	clst CHAR(1) DEFAULT '' NOT NULL
//	cldesc1 DECIMAL(10,2) NOT NULL
//	clplazo INT(10) NOT NULL

class Factura extends AppModel 
{
	public $name = 'Factura';
	public $table = 'Factura';
	public $alias = 'Factura';
	public $cache=true;

	public $virtualFields = array(
		'faimporte' => 'faimporte',
		'faimpoimpu' => 'faimpoimpu',
		'fatotal' => 'fatotal'
		);


	public $validate = array(
		'fat' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'0',
						'1'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Los posibles valores son 0 y 1'
			)
		),
		'fast' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'C',
						'A',
						'S'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Not in list, please enter an item within Clst list'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Cliente', 'Vendedor', 'Divisa'
	);

	function beforeFind( $options ) {
		if( isset( $options['doJoinUservendedor'] )) {
			return(parent::beforeFind($this->generateJoinUservendedor($options)));
		}
		return (parent::beforeFind($options));
	}

}

?>