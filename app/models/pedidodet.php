<?php


class Pedidodet extends AppModel 
{
	var $name = 'Pedidodet';

//	var $table = 'pedidodet';
//	var $useTable = 'pedidodet';
	var $alias = 'Pedidodet';
	
	var $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Pedido',
		'Articulo',
		'Color',
		'Talla',
	);

}

?>