<?php


class InvfisicosmovilController extends MasterDetailAppController {
	var $name='Invfisicosmovil';

	var $uses = array('Invfisico', 'Invfisicodetail', 'Almacen', 'Articulo', 'Color', 'Talla', 'Ubicacion' );

	var $layout = 'almacenmovil';


	public function index() {
		$this->set('title_for_layout', "Inventario Físico");	
		
//		$this->set('items', $this->paginate($filter));
	}

	public function addItem() {
		$this->autoRender=false;
		$theData=$this->params['url'];
		unset($theData['url']);

		if(
			isset($theData['articulo_id']) && $theData['articulo_id']>0 &&
			isset($theData['color_id']) && $theData['color_id']>0 &&
			isset($theData['talla_index']) && $theData['articulo_id']>=0 &&
			isset($theData['cantidad']) && $theData['cantidad']>0 
			)
		{
			$cadena='Art:'.$theData['articulo_id'].
					' Col:'.$theData['color_id'].
					' Talla:'.$theData['talla_index'].
					' CANTIDAD:'.$theData['cantidad'];
					
			$out=array(
				'result'=>'recibido',
				'message'=>$cadena
			);
		}
		else {
			$out=array(
				'result'=>'error',
				'message'=>'Error en la Solicitud'
			);
		}

		echo json_encode($out);
	}

	public function getItemByCve($cve=null) {
		$this->autoRender=false;
		$this->Articulo->recursive=1;
		$rs=$this->Articulo->findByArcveart($cve);
		$out=array(
			'result'=>'error',
			'errorMessage'=>'Producto Inválido',
		);

		if($rs && isset($rs['Articulo']['id']) && $rs['Articulo']['id']>0) {
			$color=array();
//			$color[]=array('id'=>1, 'cve'=>'NEGRO');


			foreach($rs['Color'] as $item) {
				$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
			}
	
			$out=array(
				'articulo_id'=>$rs['Articulo']['id'],
				'articulo_cve'=>trim($rs['Articulo']['arcveart']),
				'articulo_descrip'=>trim($rs['Articulo']['ardescrip']),
				'color_id'=>null,
				'color_cve'=>null,
				'talla_id'=>$rs['Articulo']['talla_id'],
				'talla_cve'=>trim($rs['Talla']['tadescrip']),
				'talla'=>array(
					array('label'=>$rs['Talla']['tat0'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat1'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat2'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat3'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat4'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat5'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat6'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat7'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat8'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat9'], 'cant'=>'')
				),
				'color'=>$color

			);

		}
		else {
			$out=array(
				'result'=>'error',
				'errorMessage'=>'Producto Inválido',
				);
		}
		echo json_encode($out);
	}

	public function getItem($articulo_id=null,$color_id=null,$talla_index=null) {
		$this->autoRender=false;
		$this->Articulo->recursive=1;
		
		$rs=$this->Articulo->findById($articulo_id);
		$out=array(
			'result'=>'error',
			'errorMessage'=>'Producto Inválido',
		);

		if($rs && isset($rs['Articulo']['id']) && $rs['Articulo']['id']>0) {
			$color=array();
//			$color[]=array('id'=>1, 'cve'=>'NEGRO');


			foreach($rs['Color'] as $item) {
				if($item['id']==$color_id) {
					$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
					$color_cve=trim($item['cve']);		
				}
			}
	
			$out=array(
				'articulo_id'=>$rs['Articulo']['id'],
				'articulo_cve'=>trim($rs['Articulo']['arcveart']),
				'articulo_descrip'=>trim($rs['Articulo']['ardescrip']),
				'color_id'=>$color_id,
				'color_cve'=>$color_cve,
				'talla_id'=>$rs['Articulo']['talla_id'],
				'talla_cve'=>trim($rs['Talla']['tadescrip']),
				'talla_index'=>$talla_index,
				'talla_label'=>trim($rs['Talla']['tat'.$talla_index]),
				'talla'=>array(
					array('label'=>$rs['Talla']['tat0'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat1'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat2'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat3'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat4'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat5'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat6'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat7'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat8'], 'cant'=>''),
					array('label'=>$rs['Talla']['tat9'], 'cant'=>'')
				),
				'color'=>$color

			);

		}
		else {
			$out=array(
				'result'=>'error',
				'errorMessage'=>'Producto Inválido',
				);
		}
		echo json_encode($out);
	}


	public function getUbicacion($cve=null) {
		$this->autoRender=false;
		$this->Articulo->recursive=1;

		$out=array(
			'result'=>'error',
			'errorMessage'=>'Ubicación Inválida',
		);
		
		if(!$cve or empty($cve)) {
			echo json_encode($out);
			return;
		}
		
		if(is_numeric($cve)) {
			$rs=$this->Ubicacion->findById($cve);
		}
		else {
			$rs=$this->Ubicacion->findByCve($cve);
		}

		$out=array(
			'result'=>'error',
			'errorMessage'=>'Producto Inválido',
		);

		if($rs && isset($rs['Ubicacion']['id']) && $rs['Ubicacion']['id']>0) {
			$color=array();
			$color[]=array('id'=>1, 'cve'=>'NEGRO');


			foreach($rs['Color'] as $item) {
				$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
			}
	
			$out=array(
				'id'=>$rs['Ubicacion']['id'],
				'cve'=>$rs['Ubicacion']['cve'],
				'zona'=>$rs['Ubicacion']['zona'],
				'fila'=>$rs['Ubicacion']['fila'],
				'espacio'=>$rs['Ubicacion']['espacio'],
			);

		}
		else {
			$out=array(
				'result'=>'error',
				'errorMessage'=>'Producto Inválido',
				);
		}
		echo json_encode($out);
	}

}
