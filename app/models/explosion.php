<?php

class Explosion extends AppModel 
{
	var $name = 'Explosion';
	var $table = 'Explosiones';
	var $alias = 'Explosion';
	public $cache=true;
	var $primaryKey = 'id';

	public $_schema = array(
		'insumopropio' => array(
			'type' => 'string', 
			'length' => 1
		),
		't0' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't1' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't2' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't3' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't4' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't5' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't6' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't7' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't8' => array(
			'type' => 'boolean', 
			'length' => 1
		),
		't9' => array(
			'type' => 'boolean', 
			'length' => 1
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Material' => array(
			'className'=>'Articulo',
			'foreignKey'=>'material_id',
			'conditions'=>'Material.tipoarticulo_id<>0',
			),
		'Color',
		'Proveedor'
	);

/*
	public $hasOne = array(
		'Explosiondato' => array(
			'className'=>'Explosiondato',
			'foreignKey'=>'articulo_id',
			)	
	);
*/

	var $validate = array(
		'articulo_id' => array(
			'isunique' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe Especificar el Producto Terminado'
			),
		),
		'articulo_id' => array(
			'isunique' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Debe Especificar el Material o Servicio'
			),
		),
		'insumopropio' => array( 
			'inlist' => array(
				'rule' => array('boolean'),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Debe especificar si el insumo es propio o no'
			)
		),
	);

	public function getAllItems($id) {
		$this->recursive=0;

		$out=array();
		// Telas
		$rs=$this->find('all', array( 'conditions'=>array(	'Explosion.articulo_id'=>$id,
															'Explosion.tipoexplosion_id=1'
														),
									'order'=>'Explosion.id'
														 ) );
		$out['tela']=$rs;
		
		// Habilitacion
		$rs=$this->find('all', array( 'conditions'=>array(	'Explosion.articulo_id'=>$id,
															'Explosion.tipoexplosion_id=2'
														),
									'order'=>'Explosion.id' ) );
		$out['habilitacion']=$rs;
		
		// Servicios
		$rs=$this->find('all', array( 'conditions'=>array(	'Explosion.articulo_id'=>$id,
															'Explosion.tipoexplosion_id=3'), 
											'order'=> 'Material.linea_id, Explosion.id' ) );
		$out['servicio']=$rs;

		return($out);
	}

	public function getAllItemsWithAllCosts($id) {
		$items=$this->getAllItems($id);
		$out=array();
		foreach($items['tela'] as $item) {
			$item['Costo']=$this->getItemAllCosts($item['Explosion']['material_id']);
			$out['tela'][]=$item;
		}

		foreach($items['habilitacion'] as $item) {
			$item['Costo']=$this->getItemAllCosts($item['Explosion']['material_id']);
			$out['habilitacion'][]=$item;
		}

		foreach($items['servicio'] as $item) {
			$item['Costo']=$this->getItemAllCosts($item['Explosion']['material_id']);
			$out['servicio'][]=$item;
		}
		return ($out);
	}

	public function getItemAllCosts($id, $order='') {
		$rs=$this->query('SELECT "Articuloproveedor".proveedor_id, 
								"Articuloproveedor".costo,
								"Proveedor".prcvepro, "Proveedor".prnom 
								FROM articulos_proveedores "Articuloproveedor"
								JOIN Proveedores "Proveedor" ON ("Proveedor".id="Articuloproveedor".proveedor_id)
								WHERE "Articuloproveedor".articulo_id='.$id.
								' ORDER BY "Articuloproveedor".costo ASC '
								);	
		return($rs);	
	}
	
	
}
