<?php

class Divisa extends AppModel 
{
	public $name = 'Divisa';
//	var $table = 'DIVISAS';
	public $alias = 'Divisa';
	public $cache=true;
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Pais', 'Articulo', 'Cliente', 'Proveedor', 'Pedido'
	);

}

?>