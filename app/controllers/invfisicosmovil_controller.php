<?php


class InvfisicosmovilController extends MasterDetailAppController {
	var $name='Invfisicosmovil';

	var $uses = array('Invfisico', 'Invfisicodetail', 'Almacen', 'Articulo', 'Color', 'Talla' );

	var $layout = 'almacenmovil';


	public function index() {
		$this->set('title_for_layout', "Inventario Físico");	
		
//		$this->set('items', $this->paginate($filter));
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
			$color[]=array('id'=>1, 'cve'=>'NEGRO');


			foreach($rs['Color'] as $item) {
				$color[]=array('id'=>$item['id'], 'cve'=>trim($item['cve']) );
			}
		

			$out=array(
				'articulo_id'=>$rs['Articulo']['id'],
				'articulo_cve'=>$rs['Articulo']['arcveart'],
				'articulo_descrip'=>$rs['Articulo']['ardescrip'],
				'color_id'=>null,
				'color_cve'=>null,
				'talla_id'=>$rs['Articulo']['talla_id'],
				'talla_cve'=>$rs['Talla']['tadescrip'],
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
}
