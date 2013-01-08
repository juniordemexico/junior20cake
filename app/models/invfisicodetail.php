<?php


class Invfisicodetail extends AppModel 
{
	var $name = 'Invfisicodetail';
	var $table = 'invfisicodetails';
	var $alias = 'Invfisicodetail';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Invfisico',
		'Ubicacion',
		'Articulo',
		'Color'
		);

	var $validate = array(
	);
}
