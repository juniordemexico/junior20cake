<?php

//	cve VARCHAR(32) DEFAULT '' NOT NULL

class Color extends AppModel 
{
	public $name = 'Color';
//	public $table = 'colores';
//    var $useTable = 'colores';
	public $alias = 'Color';

	public $validate = array(
		'cve' => array(
			'isunique' => array(
				'rule' => array(
					'isUnique'
				),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Ese Color YA Existe'
			),
			'between' => array(
				'rule' => array('between', 1, 20),
				'message' => 'CLAVE debe contener entre 1 y 20 caracteres'
			),
		),
		'st' => array(
			'inlist' => array(
				'rule' => array('inList', array('A', 'B', 'S') ),
			'required' => false,
			'allowEmpty' => false,
			'message' => 'El Estatus debe ser (A)ctivo, (B)aja o (S)uspendido'
			)
		),
/*
		'tipoarticulo_id_0' => array(
			'bool' => array(
				'rule' => array('boolean'),
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Especifique si el Color se utiliza para Producto Terminado'
			)
		),
		'tipoarticulo_id_1' => array(
			'bool' => array(
				'rule' => array('boolean'),
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Especifique si el Color se utiliza para Materiales'
			)
		),
		'tipoarticulo_id_2' => array(
			'bool' => array(
				'rule' => array('boolean'),
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Especifique si el Color se utiliza para Servicios'
			)
		),
*/
	);

	public $hasAndBelongsToMany = array(
		'Articulo' => array(
			'className'=>'Articulo',
			'joinTable'=>'articulos_colores',
			'foreignKey'=>'color_id',
			'associationForeignKey'=>'articulo_id',
			'unique'=>false,
			)
	);

	function beforeSave($options) {
		$this->data['Color']['tipoarticulo_ids']=' '.
										($this->data['Color']['tipoarticulo_id_0']?'0':'').
										($this->data['Color']['tipoarticulo_id_1']?'1':'').
										($this->data['Color']['tipoarticulo_id_2']?'2':'').
										($this->data['Color']['tipoarticulo_id_3']?'3':'').
										($this->data['Color']['tipoarticulo_id_4']?'4':'');
		return(parent::beforeSave($options));
	}

}

?>