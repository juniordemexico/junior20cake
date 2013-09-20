<?php


class Facturadet extends AppModel 
{
	public $name = 'Facturadet';

	public $table = 'Facturadet';
//	public $useTable = 'Facturadet';
	public $alias = 'Facturadet';
	public $recursive=0;
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


}

?>