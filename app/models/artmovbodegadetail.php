<?php


class Artmovbodegadetail extends AppModel 
{
	var $name = 'Artmovbodegadetail';
	var $table = 'artmovbodegadetails';
	var $alias = 'Artmovbodegadetail';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Almacen',
		'Ubicacion',
		'Articulo',
		'Color',
		'Talla',
		'Tipoartmovbodega',
		);

	var $validate = array(
	);

}
