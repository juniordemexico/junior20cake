<?php


class Artmovbodegaexistencia extends AppModel 
{
	var $name = 'Artmovbodegaexistencia';
	var $table = 'Artmovbodegaexistencias';
	var $alias = 'Artmovbodegaexistencia';
	var $primaryKey = 'id';
	var $cache=false;
	var $recursive=1;
	
	var $belongsTo = array(
		'Articulo',
		'Almacen',
		'Ubicacion',
		'Color',
		'Talla'
		);

	var $validate = array(
	);

}
