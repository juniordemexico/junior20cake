<?php

//	arcostoprom DECIMAL(10,2) NOT NULL

class Barcodeserie extends AppModel 
{
	var $name = 'Barcodeserie';

	var $table = 'Barcodeseries';
	
	var $validate = array(
		'st' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'S',
						'A',
						'B',
						'C'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Not in list, please enter an item within Arst list'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
	);

	var $hasMany = array(
		'Barcode' =>
			array(
			'className' => 'Barcode',
			'foreignKey' => 'barcodeserie_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => false,
			'exclusive' => false,
			'finderQuery' => '',
			'countyQuery' => ''
			)
	);

	function getDivisas() {
		$barcodes = $this->Barcode->find
		(
			'list',
			array
			(
				'fields' => array('id', 'cve'),
				'order' => 'Barcode.cve ASC',
				'recursive' => -1
			)
		);
		return compact('barcodes');
	}

}

?>