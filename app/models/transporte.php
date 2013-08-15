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
//	clt CHAR(1) DEFAULT '' NOT NULL
//	clnom VARCHAR(16) DEFAULT NOT NULL
//	clst CHAR(1) DEFAULT '' NOT NULL
//	cldesc1 DECIMAL(10,2) NOT NULL
//	clplazo INT(10) NOT NULL

class Transporte extends AppModel 
{
	var $name = 'Transporte';
//	var $table = 'Transporte';
	var $alias = 'Transporte';

	var $validate = array(
		'trst' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'B',
						'A',
						'S'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'ESTATUS debe puede ser Alta/Baja/Suspendido'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Estado', 'Pais'
	);

	var $hasMany = array(
	);

	function beforeSave($options) {
		if(!array_key_exists('Transporte', $this->data) ||
		 	!array_key_exists('trt', $this->data['Transporte']) || 
			(
			array_key_exists('trt', $this->data['Transporte']) &&
			empty($this->data['Transporte']['prt']) )) {
				$this->data['Transporte']['prt']=0;
			}
		return parent::beforeSave($options);
	}

}

?>