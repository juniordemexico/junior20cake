<?php

class Articuloattachment extends AppModel  {

	public $name = 'Articuloattachment';
	public $table = 'Articuloattachments';
	public $alias = 'Articuloattachment';
	
/*	
	//media plugin behaviors
	public $actsAs = array(
		'Media.Transfer',
		'Media.Coupler',
		'Media.Generator'
	);
	//file validation which only allowed jpeg and png to be uploaded
	public $validate = array(
		'file' => array(
			'mimeType' => array(
				'rule' => array('checkMimeType', false, array( 'image/jpeg', 'image/png'))
			)
		)
	);
*/
}
