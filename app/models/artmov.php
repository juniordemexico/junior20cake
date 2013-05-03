<?php


class Artmov extends AppModel 
{
	var $name = 'Artmov';
//	var $useTable = 'artmov';
	var $alias = 'Artmov';
	var $primaryKey = 'id';

	var $cache=false;
	var $recursive=-1;
	
	var $belongsTo = array(
		'Articulo',
		'Color',
		'Almacen',
		'Talla',
		'Tipoartmovbodega',
		);

	var $validate = array(
	);

}
