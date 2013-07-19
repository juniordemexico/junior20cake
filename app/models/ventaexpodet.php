<?php

class Ventaexpodet extends AppModel 
{
	var $name = 'Ventaexpodet';
//	var $table = 'Ventaexpodets';
//	var $useTable='Ventaexpodets';
	var $alias = 'Ventaexpodet';
	var $cache = false;

	var $primaryKey = 'id';

/*
	public $_schema = array(
	);
*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Ventaexpo',
		'Articulo',
		'Color',
		'Talla',
	);

	var $validate = array(
		'articulo_id' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Código del articulo'
			),
		),
		'color_id' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Especifica el Color del articulo'
			),
		),
		'cant' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Especifica la Cantidad'
			),
			'inbetween' => array(
				'rule' => array('between', 0.01, 9999999.99),
				'message' => 'El valor máximo de cantidad es 9,999,999.99'
				),
		),
		'precio' => array(
			'isrequired' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Especifica el Precio'
			),
			'inbetween' => array(
				'rule' => array('between', 0.0001, 9999999.99),
				'message' => 'El valor máximo del precio es 9,999,999.9999'
				),
		),
	);

	public function getDetail($master_id=null) {
		return( $this->findAllByVentaexpo_id($master_id) );
	}
	
	public function getDetailTemp($entsal_id=null) {
		return( $this->findAllByVentaexpo_id($master_id) );
	}
	
	public function getArticulosCatalogo( $id = null) {
		$items=$this->query("SELECT Articulo.id, ArticuloColor.color_id, Articulo.arcveart, Color.cve,
								Articulo.ardescrip,
								Articulo.talla_id, Articulo.base_id, Articulo.estilo_id, Articulo.linea_id,
								Talla.tadescrip,
								Linea.licve,
								Base.cve,
								Estilo.cve,
								Articulo.arpva,
								Talla.tat0,
								Talla.tat1,
								Talla.tat2,
								Talla.tat3,
								Talla.tat4,
								Talla.tat5 ,
								Talla.tat6 ,
								Talla.tat7 ,
								Talla.tat8 ,
								Talla.tat9 
								FROM Articulos Articulo
								JOIN Tallas Talla ON Talla.id=Articulo.talla_id
								JOIN Articulos_Colores ArticuloColor ON ArticuloColor.articulo_id=Articulo.id
								JOIN Colores Color ON Color.id=ArticuloColor.color_id
								JOIN Lineas Linea ON Linea.id=Articulo.linea_id
								LEFT JOIN Bases Base ON Base.id=Articulo.base_id
								LEFT JOIN Estilos Estilo ON Estilo.id=Articulo.estilo_id
								WHERE Articulo.arst='A' AND Articulo.tipoarticulo_id=0
								ORDER BY Articulo.estilo_id DESC, Articulo.base_id,  Articulo.id, Color.id
		ROWS 12000");
		$out=array();
		foreach($items as $item) {
			$out[]=array(
				'id'=>$item['Articulo']['id'],
				'arcveart'=>trim($item['Articulo']['arcveart']),
				'color_cve'=>trim($item['Color']['cve']),
				'base_cve'=>$item['Bases']['cve'],			
				'talla_cve'=>trim($item['Tallas']['tadescrip']),
				'estilo_cve'=>$item['Estilos']['cve'],
				'linea_cve'=>trim($item['Linea']['licve']),
				'precio'=>$item['Articulo']['arpva'],
				'cant'=>0,
				'tl0'=>$item['Tallas']['tat0'],
				'tl1'=>$item['Tallas']['tat1'],
				'tl2'=>$item['Tallas']['tat2'],
				'tl3'=>$item['Tallas']['tat3'],
				'tl4'=>$item['Tallas']['tat4'],
				'tl5'=>$item['Tallas']['tat5'],
				'tl6'=>$item['Tallas']['tat6'],
				'tl7'=>$item['Tallas']['tat7'],
				'tl8'=>$item['Tallas']['tat8'],
				'tl9'=>$item['Tallas']['tat9'],
				'color_id'=>$item['ArticulosColor']['color_id'],
				'base_id'=>$item['Articulo']['base_id'],			
				'estilo_id'=>$item['Articulo']['estilo_id'],
				'talla_id'=>$item['Articulo']['talla_id'],
				);
		}
		return ( $out );
	}
}
