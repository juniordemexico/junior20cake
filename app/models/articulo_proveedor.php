<?php

class ArticuloProveedor extends AppModel 
{
	var $name = 'ArticuloProveedor';
	var $table = 'articulos_proveedores';
	var $useTable = 'articulos_proveedores';
	var $alias = 'ArticuloProveedor';

	var $belongsTo = array(
		'Proveedor', 'Articulo'
	);


	// Returns all the Supplier's related Materiales and Servicios 
	public function getAllProveedorArticulo($proveedor_id=null) {
		if(!$proveedor_id) {
			if(isset($this->id) && $this->id>0 &&
				isset($this->proveedor_id) && $this->proveedor_id>0) {
				$proveedor_id=$this->proveedor_id;
			}
		}
		if(!$proveedor_id) return array('material'=>array(), 'servicio'=>array());
		 
		return array(	'material'=>$this->Find('all', array('conditions'=>
									"Articuloproveedor.proveedor_id=$proveedor_id AND Articulo.tipoarticulo_id=1")),
						'servicio'=>$this->Find('all', array('conditions'=>
									"Articuloproveedor.proveedor_id=$proveedor_id AND Articulo.tipoarticulo_id=2"))
							)
					);
	}

}
