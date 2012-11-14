<?php

//	arcostoprom DECIMAL(10,2) NOT NULL
//	arcomposicion VARCHAR(16) DEFAULT '' NOT NULL
//	ardescrip VARCHAR(64) DEFAULT '' NOT NULL
//	ardescu1 DECIMAL(10,2) NOT NULL
//	arucosto DECIMAL(10,2) NOT NULL
//	arinvmin INT(10) NOT NULL
//	arinvmax INT(10) NOT NULL
//	arpvc DECIMAL(10,2) NOT NULL
//	arimpu1 DECIMAL(10,2) NOT NULL
//	artipo CHAR(1) DEFAULT '' NOT NULL
//	arpvb DECIMAL(10,2) NOT NULL
//	arpvd DECIMAL(10,2) NOT NULL
//	arcveart VARCHAR(16) DEFAULT '' NOT NULL
//	arpva DECIMAL(10,2) NOT NULL
//	art CHAR(1) DEFAULT '' NOT NULL
//	arst CHAR(1) DEFAULT '' NOT NULL
//	arpcosto DECIMAL(10,2) NOT NULL
//	ardescu2 DECIMAL(10,2) NOT NULL
//	arimpu2 DECIMAL(10,2) NOT NULL
//	arancho VARCHAR(16) DEFAULT '' NOT NULL
//	arorigen VARCHAR(16) DEFAULT '' NOT NULL

class Barcode extends AppModel 
{
	public $name = 'Barcode';

	public $table = 'Barcodes';
	
	public $validate = array(
	);

	public $Cache = true;

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Barcodeserie',
		'Articulo',
		'Color',
		'Talla'
	);

}

?>