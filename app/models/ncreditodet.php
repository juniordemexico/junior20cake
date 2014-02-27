<?php


class Ncreditodet extends AppModel 
{
	public $name = 'Ncreditodet';

	public $table = 'Ncreditodet';
	//public $useTable = 'Ncreditodet';
	public $alias = 'Ncreditodet';
	public $recursive=0;
	public $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Ncredito' =>
			array(
			'className' => 'Ncredito',
			'foreignKey' => 'ncredito_id',
			'dependent'    => true
			)
		,
		'Articulo',
		'Color'
	);


}

