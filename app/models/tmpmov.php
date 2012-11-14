<?php


class Tmpmov extends AppModel 
{
	public $name = 'Tmpmov';

	public $table = 'Tmpmovs';

	public $alias = 'Tmpmovs';
	
	public $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Divisa' =>
			array(
			'className' => 'Divisa',
			'foreignKey' => 'divisa_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
			)
		,
		'Cliente' =>
			array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
			)
		,
		'Proveedor' =>
			array(
			'className' => 'Proveedor',
			'foreignKey' => 'proveedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
			)
		,
		'Vendedor' =>
			array(
			'className' => 'Vendedor',
			'foreignKey' => 'vendedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
			)
		,
	);

	function getDivisas() {
		$divisas = $this->Divisa->find
		(
			'list',
			array
			(
				'fields' => array('id', 'dicve'),
				'order' => 'Divisa.dicve ASC',
				'recursive' => -1
			)
		);
		return compact('divisas');
	}

	function getClientes() {
		$clientes = $this->Cliente->find
		(
			'list',
			array
			(
				'fields' => array('id', 'clcvecli'),
				'order' => 'Cliente.clcvecli ASC',
				'recursive' => -1
			)
		);
		return compact('clientes');
	}

	function getVendedores() {
		$vendedores = $this->Vendedor->find
		(
			'list',
			array
			(
				'fields' => array('id', 'vecveven'),
				'order' => 'Vendedor.vecveven ASC',
				'recursive' => -1
			)
		);
		return compact('vendedores');
	}

	function getProveedores() {
		$proveedores = $this->Proveedor->find
		(
			'list',
			array
			(
				'fields' => array('id', 'prcvepro'),
				'order' => 'Proveedor.prcvepro ASC',
				'recursive' => -1
			)
		);
		return compact('proveedores');
	}

}

?>