<?php

class Explosion extends AppModel 
{
	var $name = 'Explosion';
	var $table = 'Explosiones';
	var $alias = 'Explosion';

	var $validate = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Articulo'=>array(
			'className'=>'Articulo',
			'foreignKey'=>'articulo_id',
			'conditions'=>'Articulo.tipoarticulo_id=0',
			),
		'Material'=>array(
			'className'=>'Articulo',
			'foreignKey'=>'material_id',
			'conditions'=>'Articulo.tipoarticulo_id NOT IN(0)',
			)
	);
}

?>