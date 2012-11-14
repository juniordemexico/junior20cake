<?php


class Corte extends AppModel 
{
	var $name = 'Corte';

	var $table = 'Cortes';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Articulo'
	);

}

?>