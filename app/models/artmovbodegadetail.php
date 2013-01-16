<?php


class Artmovbodegadetail extends AppModel 
{
	var $name = 'Artmovbodegadetail';
	var $table = 'artmovbodegadetails';
	var $alias = 'Artmovbodegadetail';
	var $primaryKey = 'id';
	var $cache=false;
	var $recursive=1;
	
	var $belongsTo = array(
		'Articulo',
		'Almacen',
		'Ubicacion',
		'Color',
		'Talla',
		'Tipoartmovbodega',
		);

	var $validate = array(
	);

}
