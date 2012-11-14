<?php

//	cldesc2 DECIMAL(10,2) NOT NULL

class Folio extends AppModel 
{
	public $name = 'Folio';
	public $table = 'Folios';
	public $alias = 'Folio';
	
	public $validate = array(
		't' => array(
			'inlist' => array(
				'rule' => array(
					'inList',
					array(
						'0',
						'1'
					)
				),
				'required' => false,
				'allowEmpty' => false,
				'on' => null,
				'message' => 'Los posibles valores son 0 y 1'
			)
		),
	);
	
}

?>