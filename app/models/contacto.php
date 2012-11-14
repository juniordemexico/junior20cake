<?php

//	desc2 DECIMAL(10,2) NOT NULL
//	suc VARCHAR(64) DEFAULT '' NOT NULL
//	cvecli VARCHAR(16) DEFAULT NOT NULL

class Contacto extends AppModel 
{
	var $name = 'Contacto';
	var $table = 'contactos';
	var $alias = 'Contacto';
	var $cache=true;
	
	var $validate = array(
		'cve' => array(
			'cvebetween' => array(
				'rule' => array('between', 1, 20),
				'required' => true,
				'allowEmpty' => false,
			'message' => 'CLAVE debe contener entre 1 y 16 caracteres'
		)
	),
		'st' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'A',
						'B',
						'S'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Not in list, please enter an item within ST list'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Estado' =>
			array(
			'className' => 'Estado',
			'foreignKey' => 'estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
			)
		,
		'Pais' =>
			array(
			'className' => 'Pais',
			'foreignKey' => 'pais_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
			)
	);

	function getEstados() {
		$estados = $this->Estado->find
		(
			'list',
			array
			(
				'fields' => array('id', 'esedo'),
				'order' => 'Estado.esedo ASC',
				'recursive' => -1
			)
		);
		return compact('estados');
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