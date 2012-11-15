<?php

class Explosion extends AppModel 
{
	var $name = 'Explosion';
	var $table = 'Explosiones';
	var $alias = 'Explosion';

	var $primaryKey = 'id';

	public $_schema = array(
		'insumopropio' => array(
			'type' => 'string', 
			'length' => 1
		),
	);

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

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Material'=>array(
			'className'=>'Articulo',
			'foreignKey'=>'material_id',
			'conditions'=>'Material.tipoarticulo_id<>0',
			)
	);

	public function getAllItems() {
		$this->recursive=0;

		$out=array();
		// Telas
		$rs=$this->find('all', array( 'conditions'=>array('Explosion.tipoarticulo_id=1', 
															'Material.linea_id = 2102') ) );
		$out['tela']=$rs;
		
		// Habilitacion
		$rs=$this->find('all', array( 'conditions'=>array('Explosion.tipoarticulo_id=1',
															'Material.linea_id <> 2102') ) );
		$out['habilitacion']=$rs;
		
		// Servicios
		$rs=$this->find('all', array( 'conditions'=>array('Explosion.tipoarticulo_id=2'), 
											'order'=> 'Material.linea_id, Explosion.id' ) );
		$out['servicio']=$rs;

		return($out);
	}
}
