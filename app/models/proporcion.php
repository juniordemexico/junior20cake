<?php

//	licve VARCHAR(16) DEFAULT '' NOT NULL

class Proporcion extends AppModel 
{
	public $name = 'Proporcion';
//	public $table = 'proporciones';
//	public $useTable = 'proporciones';
	public $alias = 'Proporcion';
	public $cache=true;

/*
	public $virtualFields=array(
		'displaylabel'=>"T0||T1"
		);
*/

	public $virtualFields=array(
		'lista'=>'lista'
		);

	public $_displayFields=array(
		'cve'
		);
		
	public $hasMany = array(
		'Articulo'
		);

	public $validate = array(
		'cve' => array(
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
		't0' => array(
			't0int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => false,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't1' => array(
			't1int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't2' => array(
			't2int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't3' => array(
			't3int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't4' => array(
			't4int' => array(
				'rule' => 'numeric',
				'required' => false,
				'allowEmpty' => false,
				'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't5' => array(
			't5int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't6' => array(
			't6int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't7' => array(
			't7int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't8' => array(
			't8int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
		't9' => array(
			't9int' => array(
				'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => true,
			'message' => 'Proporcione un valor entero ( 0, 1, 2 ... 99 )'
			)
		),
	);

	public function beforeSave() {
		for($i=0; $i<AX_TALLAS_MAX; $i++ ) {
			$this->data[$this->name]["t{$i}"]=trim($this->data[$this->name]["t{$i}"]);
			if( isset($this->data[$this->name]["t{$i}"]) && empty($this->data[$this->name]["t{$i}"]) ) {
				unset($this->data[$this->name]["t{$i}"]);
			}
		}
		return true;
	}
}
