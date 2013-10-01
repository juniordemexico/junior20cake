<?php


class Pedidodet extends AppModel 
{
	var $name = 'Pedidodet';

//	var $table = 'pedidodet';
//	var $useTable = 'pedidodet';
	var $alias = 'Pedidodet';
	
	var $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Pedido',
		'Articulo',
		'Color',
		'Talla',
	);


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
								ORDER BY Articulo.linea_id, Articulo.estilo_id, Articulo.base_id,  Articulo.id, Color.id
		ROWS 20000");
		$out=array();
		foreach($items as $item) {
			$out[]=array(
				'id'=>$item[0]['id'],
				'arcveart'=>trim($item[0]['arcveart']),
				'color_cve'=>trim($item['Color']['cve']),
				'base_cve'=>$item['Bases']['cve'],			
				'talla_cve'=>trim($item['Tallas']['tadescrip']),
				'estilo_cve'=>$item['Estilos']['cve'],
				'linea_cve'=>trim($item['Linea']['licve']),
				'precio'=>$item[0]['arpva'],
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
				'base_id'=>$item[0]['base_id'],			
				'estilo_id'=>$item[0]['estilo_id'],
				'talla_id'=>$item[0]['talla_id'],
				);
		}
		return ( $out );
	}

}
