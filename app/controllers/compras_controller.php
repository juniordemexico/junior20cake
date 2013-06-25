<?php

class ComprasController extends MasterDetailAppController {
	public $name='Compras';

	public $uses = array(
		'Compra', 'Compradet', 'Articulo', 'Color', 'Tipoartmovbodega', 'Almacen', 'Artmovbodegadetail'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view');

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Compra.fecha' => 'desc'),
							'fields' => array('Compra.id', 'Compra.folio', 'Compra.fecha',
											'Compra.ordencompra_id',
											'Compra.importe', 'Compra.impoimpu', 'Compra.total',
											'Compra.st', 'Compra.t',
											'Compra.created', 'Compra.modified',
											'Compra.proveedor_id','Compra.proveedor_refer',
											'Compra.divisa_id', 'Divisa.dicve',
											'Proveedor.prcvepro','Proveedor.prnom',
											'Proveedor.pratn'),
//										'conditions' => array('Compra.est'=>0),
							);

	public $actualSerie = 'CO';

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
