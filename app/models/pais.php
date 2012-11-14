<?php

//	id INTEGER NOT NULL PRIMARY KEY
//	papais VARCHAR(32) NOT NULL UNIQUE
//  pais_id INTEGER NOT NULL
//  FOREIGN KEY (pais_id) REFERENCES pais(id) ON DELETE DEFAULT ON UPDATE CASCADE

class Pais extends AppModel 
{
	public $name = 'Pais';
	public $table = 'paises';
	public $alias = 'Pais';
	public $displayField = 'papais';
	public $order = "Pais.papais ASC";
	public $cache=true;

	public $validate = array(
		'papais' => array(
			'isunique' => array(
				'rule' => array(
					'isUnique'
				),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Esa Clave YA Existe'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(
		'Estado', 'Cliente', 'Proveedor', 'Vendedor', 'Contacto'
	);

	public $belongsTo = array(
		'Divisa'
	);

	public function loadDependencies($id=null) {
		$divisas = $this->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		return compact('divisas');
	}

}
