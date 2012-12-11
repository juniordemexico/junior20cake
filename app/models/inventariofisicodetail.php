<?php


class Inventariofisicodetails extends AppModel 
{
	var $name = 'Inventariofisicodetail';
	var $table = 'inventariofisicodetails';
	var $alias = 'Inventariofisicodetail';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Inventariofisico',
		'Articulo',
		'Color',
		'Talla'
		);

	var $validate = array(
	);
}
