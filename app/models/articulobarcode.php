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

class Articulobarcode extends AppModel 
{
	var $name = 'Articulobarcode';
	var $table = 'Articulobarcodes';
	var $alias = 'Articulobarcode';
	
	var $validate = array();

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
	);

	function getBarcodes($articulo_id, $barcodeseries_id=null) {
			$barcodes=$this->Find('all',array(
									'conditions'=>"articulo_id=${articulo_id}",
									)
									);
			$rs=array();
			foreach($barcodes as $item) {
				$item['Articulobarcode']['talla_label']=$item['Articulobarcode']['tat'.$item['Articulobarcode']['talla_index']];
				$rs[]=$item['Articulobarcode'];
			}
			return($rs);
		
	}
}

?>