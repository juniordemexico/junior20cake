<?php

class OrdencomprasController extends MasterDetailAppController {
	public $name='Ordencompras';

	public $uses = array(
		'Ordencompra', 'Ordencompradet', 'Articulo', 'Color', 'Proveedor', 'Divisa'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view'
							);

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Ordencompra.fecha' => 'desc'),
							'fields' => array('Ordencompra.id', 'Ordencompra.folio', 'Ordencompra.fecha',
											'Ordencompra.importe', 'Ordencompra.impoimpu', 'Ordencompra.total',
											'Ordencompra.st', 'Ordencompra.t',
											'Ordencompra.created', 'Ordencompra.modified',
											'Ordencompra.proveedor_id','Ordencompra.proveedor_refer',
											'Ordencompra.divisa_id',
											'Proveedor.prcvepro','Proveedor.prnom',
											'Proveedor.pratn'),
//										'conditions' => array('Ordencompra.est'=>0),
							);

	public $actualSerie = 'OC';

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
