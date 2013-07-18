<?php

class VentasController extends MasterDetailAppController {
	public $name='Ventas';

	public $uses = array(
		'Venta', 'Ventadet', 'Vendedor', 'Cliente', 'Divisa', 'Articulo', 'Color'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view'
							);

	public $tipoarticulo_id = 0;
	public $actualSerie = 'VE';

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Venta.fecha' => 'desc'),
							'fields' => array('Venta.id', 'Venta.folio', 'Venta.fecha',
											'Venta.importe', 'Venta.impoimpu', 'Venta.total',
											'Venta.st', 'Venta.t',
											'Venta.created', 'Venta.modified',
											'Venta.cliente_id',
											'Venta.vendedor_id','Vendedor.vecveven','Vendedor.venom',
											'Venta.divisa_id',
											'Cliente.clcvecli','Cliente.clnom',
											'Cliente.clatn'),
							);

	public function add() {		
		$model=$this->Venta;
		parent::add( array(
					'Master' =>
						array('id'=>null, 'st'=>'A', 't'=>'0',
								$model->title => $model->getNextFolio($this->actualSerie, 0),
								$model->dateField => date('Y-m-d'),
								'vendedor_id' => 4002,
								'cliente_id' => 11803,
								'formadepago_id' => 1,
								'divisa_id' => 1,
								'tipodecambio' => 1
							),
					'Details' => array(),
					'masterModel' => $model->name,
					'detailModel' => isset($model->detailsModel) ?
									$model->detailsModel :
									null,
				));
	}

	public function save() {		
		
	}


	public function getItemByCve($cve=null) {
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Artículo NO Existe');
			return;
		}

		// Check if Item already exists
		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);
		$item['ArticuloColor']=$this->Articulo->getArticuloColor($item['Articulo']['id']);

		$this->set('result', 'ok');
		$this->set('message', 'Artículo '.$item['Articulo']['arcveart']);
		$this->set('item', $item);
	}

}
