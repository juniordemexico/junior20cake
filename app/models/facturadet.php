<?php


class Facturadet extends AppModel 
{
	public $name = 'Facturadet';

	public $table = 'Facturadet';
	public $alias = 'Facturadet';
	
	public $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Factura' =>
			array(
			'className' => 'Factura',
			'foreignKey' => 'factura_id',
			'dependent'    => true
			)
		,
		'Articulo' =>
			array(
			'className' => 'Articulo',
			'foreignKey' => 'articulo_id',

			)
		,
		'Color' =>
			array(
			'className' => 'Color',
			'foreignKey' => 'color_id',
			'order' => '',
			)
		,
	);

	function getFacturas() {
		$facturas = $this->Factura->find
		(
			'list',
			array
			(
				'fields' => array('id', 'farefer'),
				'order' => 'Factura.perefer ASC',
				'recursive' => -1,
				'countCache' => true,
			)
		);
		return compact('facturas');
	}

	function getArticulos() {
		$articulos = $this->Articulo->find
		(
			'list',
			array
			(
				'fields' => array('id', 'arcveart'),
				'order' => 'Articulo.arcveart ASC',
				'recursive' => -1
			)
		);
		return compact('articulos');
	}

	function geColores() {
		$colores = $this->Colores->find
		(
			'list',
			array
			(
				'fields' => array('id', 'cve'),
				'order' => 'Color.cve ASC',
				'recursive' => -1
			)
		);
		return compact('colores');
	}

}

?>