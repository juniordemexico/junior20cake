<?php

class ArticuloProveedor extends AppModel 
{
	var $name = 'ArticuloProveedor';
	var $table = 'articulos_proveedores';
	var $useTable = 'articulos_proveedores';
	var $alias = 'ArticuloProveedor';

	var $belongsTo = array(
		'Articulo', 'Proveedor', 'Unidad'
	);


	// Returns all the Supplier's related Materiales and Servicios 
	public function getAllArticuloProveedor($proveedor_id=null) {
		$this->recursive=1;
//		if(!$proveedor_id) return array('material'=>array(), 'servicio'=>array());

		return array(	'material'=>$this->Find('all', array('conditions'=>
									"Articuloproveedor.proveedor_id=$proveedor_id AND Articulo.tipoarticulo_id=1",
									'order'=>'Articulo.arcveart')),
						'servicio'=>$this->Find('all', array('conditions'=>
									"Articuloproveedor.proveedor_id=$proveedor_id AND Articulo.tipoarticulo_id=2",
									'order'=>'Articulo.arcveart'))
					);
	}
	
	public function loadDependencies() {
		$Unidad = $this->toJsonListArray( $this->Unidad->find('list', 
							array(	'fields' => array('Unidad.id', 'Unidad.cve'),
									'order'=>array('Unidad.id') 
									 )));
		return compact('Unidad');
	}

}
