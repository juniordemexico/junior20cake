<?php

class MaterialmovimientosController extends MasterDetailAppController {
	public $name='Materialmovimientos';

	public $uses = array(
		'Entsal', 'Entsaldet', 'Articulo', 'Color', 'Tipoartmovbodega', 'Almacen', 'Artmovbodegadetail'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view');

	public $paginate = array('update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Entsal.esfecha' => 'desc'),
								'fields' => array('Entsal.id', 'Entsal.esrefer', 'Entsal.esfecha',
												'Entsal.estmov','Entsal.esconcep',
												'Entsal.st', 'Entsal.est',
												'Entsal.created', 'Entsal.modified',
												'Entsal.refer_id', 'Entsal.refer_model',
												'Entsal.tipoartmovbodega_id', 'Tipoartmovbodega.cve',
												'Entsal.almacen_id','Almacen.aldescrip'),
							);
	public $actualSerie = "ES";
	
/*
	public function add() {
		$data=array('Master' =>
									array('id'=>null, 'st'=>'A', 'est'=>'0',
										'esrefer'=>$this->Entsal->getNextFolio('ES', 0),
										'esfecha'=> date('Y-m-d'),
											'almacen_id'=>1, 'tipoartmovbodega_id'=>10, 'tipoarticulo_id'=>1,
										),
									'Tipoartmovbodega' => null,
									'masterModel' => $this->{$this->uses[0]}->name,
									'detailModel' => isset($this->{$this->uses[0]}->detailsModel) ?
														$this->{$this->uses[0]}->detailsModel :
														null,
									'Details' => array(),
						);
		parent::add($data);
	}
*/

	public function getItemByCve($cve=null) {
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Material NO Existe');
			return;
		}

		// Check if Item already exists
		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);
		$item['ArticuloColor']=$this->Articulo->getArticuloColor($item['Articulo']['id']);

		$this->set('result', 'ok');
		$this->set('message', 'Material '.$item['Articulo']['arcveart']);
		$this->set('item', $item);
	}

}
