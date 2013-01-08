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
		'Color',
		'Talla',
		);

	var $validate = array(
	);
	
	// Returns a Recordset with both Conteos
	public function getConteos($id=null, $conteo=null) {
		if(!$conteo) {
			$conteo=null;
		}
		return (

			$rs=$this->Articulo->find('all', array(
					'fields'=>array('Articulo.*, Linea.*, Marca.*, Invfisicodenormal.*'),
					'conditions'=>array('Articulo.tipoarticulo_id'=>0),
					'joins'=>array(
						array(	'table' => 'Invfisicodenormals',
								'alias' => 'Invfisicodenormal',
								'type' => 'INNER',
								'conditions' => array(
											'Articulo.id=Invfisicodenormal.articulo_id',
											),
							)
						)
					))

			);
			
	} 

}
