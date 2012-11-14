<?php

class ArticuloProveedor extends AppModel 
{
	var $name = 'ArticuloProveedor';
	var $table = 'articulos_proveedores';
	var $useTable = 'articulos_proveedores';
	var $alias = 'ArticuloProveedor';

	var $belongsTo = array(
		'Proveedor', 'Articulo'
	);

}
