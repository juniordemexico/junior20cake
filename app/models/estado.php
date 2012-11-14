<?php

class Estado extends AppModel 
{
	public $name = 'Estado';
//	public $table = 'estados';
	public $alias = 'Estado';
	public $cache=true;

	public $displayField = 'esedo';
	public $order = "Estado.esedo ASC";
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Pais'
	);

	public $hasMany = array(
		'Cliente', 'Proveedor', 'Vendedor', 'Contacto'
	);

	public function loadDependencies($id=null) {
		$paises = $this->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		return compact('paises');
	}

}

?>