<?php

class Clientesdireccion extends AppModel 
{
	var $name = 'Clientesdireccion';
	var $table = 'clientesdirecciones';
	var $alias = 'Clientesdireccion';

	var $_schema= array(
		);

	var $validate = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Cliente'
	);

}
