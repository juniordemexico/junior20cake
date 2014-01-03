<?php

class Ifisico extends AppModel 
{
	var $name = 'Ifisico';
//	var $table = 'Ifisicos';
	var $alias = 'Ifisico';
	var $primaryKey = 'id';
	var $cache=false;

	var $belongsTo = array(
		'Articulo',
		'Color',
		'Talla',
		'User'=>array(
			'className'=>'User',
			'joinTable'=>'Users',
			'foreignKey'=>'modified_user_id',
			)
		);

	var $hasMany = array(
		);

	var $validate = array(
	);


}
