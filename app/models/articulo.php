<?php

//	arcostoprom DECIMAL(10,2) NOT NULL
//	arcomposicion VARCHAR(16) DEFAULT '' NOT NULL
//	ardescrip VARCHAR(64) DEFAULT '' NOT NULL
//	ardescu1 DECIMAL(10,2) NOT NULL
//	arucosto DECIMAL(10,2) NOT NULL

class Articulo extends AppModel 
{
	public $name = 'Articulo';
//	public $table = 'ARTICULOS';
//	public $useTable = 'ARTICULOS';
	public $alias = 'Articulo';

	public $primaryKey = 'id';
	public $title = 'arcveart';
	public $longTitle = 'ardescrip';
	public $stField = 'arst';
	public $recursive= 0;
	public $tipoarticulo=0;

	public $_schema = array(
		'arcveart' => array  (
			'type' => 'string', 
			'length' => 16
		),
		'ardescrip' => array(
			'type' => 'string', 
			'length' => 64
		),
		'arpva' => array(
			'type' => 'float',
			'length' => 7
		),
		'arpva' => array(
			'type' => 'float',
			'length' => 7
		),
		'ardescrip' => array(
			'type' => 'string', 
			'length' => 128
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Tipoarticulo',
		'Divisa',
		'Unidad',
		'Talla',
		'Proporcion',
		'Linea',
		'Temporada',
		'Marca',
	);

	var $hasMany = array(
		'ArticuloProveedor',
//		'Pedidodet',
//		'Facturadet',
/*		'Explosion'=>array(
			'className'=>'Explosion',
			'foreignKey'=>'articulo_id',
//			'dependent'=>true,
			),
*/
/*
		'ExplosionMaterial'=>array(
			'className'=>'Explosion',
			'foreignKey'=>'material_id',
			),
*/		
	);


	var $hasAndBelongsToMany = array(
		'Color' => array(
			'className'=>'Color',
			'joinTable'=>'articulos_colores',
			'foreignKey'=>'articulo_id',
			'associationForeignKey'=>'color_id',
//			'unique'=>true,
		)
	);

	var $validate = array(
		'arcveart' => array(
			'isunique' => array(
				'rule' => array('isUnique'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'La Clave YA Existe'
			),
			'cvebetween' => array(
				'rule' => array('between', 1, 16),
				'message' => 'CLAVE debe contener entre 1 y 16 caracteres'
			)
			
		),
		'arst' => array(
			'inlist' => array(
				'rule' => array('inList', array('A', 'C', 'S') ),
				'allowEmpty' => false,
				'message' => 'ESTATUS debe ser Activo/Cancelado/Suspendido'
			)
		),
		'arpva' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => false,
				'message' => 'Precio de Venta A requiere un valor monetario'
			),
		),
		'arpvb' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => false,
				'message' => 'Precio de Venta B requiere un valor monetario'
			)
		),
		'arpvc' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => false,
				'message' => 'Precio de Venta C requiere un valor monetario'
			) 
		),
		'arpvd' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => false,
				'message' => 'Precio de Venta D requiere un valor monetario'
			)
		),
		'arpcosto' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => false,
				'message' => 'Costo requiere un valor monetario'
			)
		),
		'arcostoprom' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => false,
				'message' => 'Costo Promedio requiere un valor monetario'
			)
		),
		'arucosto' => array(
			'money' => array(
				'rule' => array('money'),
				'allowEmpty' => false,
			'message' => 'Ultmo Costo requiere un valor monetario'
			)
		),
		'arimpu1' => array(
			'money' => array(
			'rule' => array('money'),
			'allowEmpty' => false,
			'message' => 'El Impuesto 1 (IVA) requiere un valor numerico'
			)
		),
		'arimpu2' => array(
			'money' => array(
			'rule' => array('money'),
			'allowEmpty' => false,
			'message' => 'El Impuesto 2 requiere un valor numerico'
			)
		),
		'ardesc1' => array(
			'money' => array(
			'rule' => array('money'),
			'allowEmpty' => false,
			'message' => 'El Descuento 1 requiere un valor numerico'
			)
		),
		'ardesc2' => array(
			'money' => array(
			'rule' => array('money'),
			'allowEmpty' => false,
			'message' => 'El Descuento 2 requiere un valor numerico'
			)
		),
		'arinvmin' => array(
			'numeric' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => 'Inventario Minimo requiere un valor numerico entero'
			)
		),
		'arinvmax' => array(
			'numeric' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => 'Inventario Maximo requere un valor numerico entero'
			)
		),
		'arancho' => array(
			'numeric' => array(
			'rule' => 'numeric',
			'allowEmpty' => false,
			'message' => 'ANCHO requiere un valor numerico'
			)
		),
		'art' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'required' => false,
				'allowEmpty' => true,
		'message' => 'TIPO debe ser un valor Verdadero(1) o Falso(0)'
		)
		)
	);

	function beforeSave($options) {
		if (isset($this->data['Articulo']['art']) && empty($this->data['Articulo']['art']) && 
			!is_numeric($this->data['Articulo']['art']) ) {
			unset($this->data['Articulo']['art']);
		}
		return(parent::beforeSave($options));
	}

	public function loadDependencies( $tipoarticulo=0 ) {
		// Determine the product's type
		if( isset($tipoarticulo) && is_numeric(trim($tipoarticulo)) ) {
			$tipoarticulo=(int)$tipoarticulo;
		}
		elseif(isset($this->tipoarticulo) && is_numeric(trim($this->tipoarticulo)) ) {
			$tipoarticulo=$this->tipoarticulo;
		}
		else {
			$tipoarticulo=0;
		}

		$colores = $this->Color->find('list', array('fields' => array('Color.id', 'Color.cve'), 'order'=>array('Color.cve'), 'conditions'=>array( array('OR'=>array('Color.st'=>'A','Color.st'=>'S')), 'tipoarticulo_id_'.$tipoarticulo=>1) ));
		$divisas = $this->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$unidades = $this->Unidad->find('list', array('fields' => array('Unidad.id', 'Unidad.cve')));
		$lineas = $this->Linea->find('list', array('fields' => array('Linea.id', 'Linea.licve'), 'conditions'=>array('Linea.tipoarticulo_id'=>$tipoarticulo) ) );
		$marcas = $this->Marca->find('list', array('fields' => array('Marca.id', 'Marca.macve')));
		$temporadas = $this->Temporada->find('list', array('fields' => array('Temporada.id', 'Temporada.tecve')));
		$tallas = $this->Talla->find('list', array('fields' => array('Talla.id', 'Talla.tadescrip'), 'conditions'=>array('st'=>'A')));
		$proporciones = $this->Proporcion->find('list', array('fields' => array('Proporcion.id',  'Proporcion.cve')));
		$tipoarticulos = $this->Tipoarticulo->find('list', array('fields' => array('Tipoarticulo.id', 'Tipoarticulo.cve'), 'conditions'=>array('Tipoarticulo') ));

		return compact('colores', 'unidades', 'tallas', 'proporciones', 'lineas', 'marcas', 
							'temporadas', 'divisas', 'tipoarticulos');
		
	}

}

?>