<?php

class ArticuloColor extends AppModel 
{
	var $name = 'ArticuloColor';
	var $table = 'articulos_colores';
	var $useTable = 'articulos_colores';
	var $alias = 'ArticuloColor';

	public $belongsTo=array(
		'Articulo',
		'Color'
	);


}
