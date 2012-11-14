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

class Proveedor extends AppModel 
{
	var $name = 'Proveedor';
	var $table = 'Proveedor';
	var $alias = 'Proveedor';

	var $validate = array(
		'prst' => array(
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
		'Divisa', 'Estado', 'Pais'
	);

	var $hasMany = array(
		'ArticuloProveedor'
	);

	function beforeSave($options) {
		if(!array_key_exists('Proveedor', $this->data) ||
		 	!array_key_exists('prt', $this->data['Proveedor']) || 
			(
			array_key_exists('prt', $this->data['Proveedor']) &&
			empty($this->data['Proveedor']['prt']) )) {
				$this->data['Proveedor']['prt']=0;
			}
		return parent::beforeSave($options);
	}
	
	function getPaises() {
		$paises = $this->Pais->find
		(
			'list',
			array
			(
				'fields' => array('id', 'papais'),
				'order' => 'Pais.papais ASC',
				'recursive' => -1
			)
		);
		return compact('paises');
	}

}

?>