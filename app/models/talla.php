<?php

//	tacve VARCHAR(16) DEFAULT '' NOT NULL

class Talla extends AppModel 
{
	public $name = 'Talla';
//	public $table = 'tallas';
//	public $useTable = 'tallas';
	public $alias = 'Talla';
	public $cache=true;


	public $_displayFields=array(
		'tadescrip'
		);
		
	public $hasMany = array(
		'Articulo'
		);

	public $validate = array(
		'tacve' => array(
			'isunique' => array(
				'rule' => array(
					'isUnique'
				),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Esa Clave YA Existe'
			),
			'cvebetween' => array(
				'rule' => array('between', 1, 16),
				'message' => 'CLAVE debe contener entre 1 y 16 caracteres'
			)
		),
		'tadescrip' => array(
			'isunique' => array(
				'rule' => array(
					'isUnique'
				),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Esa Clave YA Existe'
			)	
		),
		'st' => array(
			'inlilst' => array(
				'rule' => array('inList', array('A', 'C', 'S') ),
				'allowEmpty' => false,
				'message' => 'El Estatus debe ser (A)ctivo (B)aja (S)uspendido'
			)	
		),
		'tat0' => array(
			'tat0int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat1' => array(
			'tat1int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat2' => array(
			'tat2int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat3' => array(
			'tat3int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat4' => array(
			'tat4int' => array(
				'rule' => 'alphaNumeric',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat5' => array(
			'tat5int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat6' => array(
			'tat6int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat7' => array(
			'tat7int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat8' => array(
			'tat8int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		'tat9' => array(
			'tat9int' => array(
				'rule' => 'alphaNumeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
	);

/*
	function beforeSave($options) {
		$options=parent::beforeSave($options);
		for($i=0; $i<10; $i++) 
		$this->data['Color']['tipoarticulo_ids']=
	}
*/	
}

?>