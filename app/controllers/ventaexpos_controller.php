<?php

class VentaexposController extends MasterDetailAppController {
	public $name='Ventaexpos';

	public $uses = array(
		'Ventaexpo', 'Ventaexpodet', 'Vendedor', 'Cliente', 'Articulo', 'Color', 'Bases', 'Estilos', 'Tallas'
	);

	public $layout = 'ventas';
	
	public $cacheAction = array('view'
							);

	public $tipoarticulo_id = 0;
	public $actualSerie = 'VX';

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Ventaexpo.fecha' => 'desc', 'Ventaexpo.folio' => 'desc'),
							'fields' => array('Ventaexpo.id', 'Ventaexpo.folio', 'Ventaexpo.fecha',
											'Ventaexpo.fvence', 'Ventaexpo.importe', 'Ventaexpo.total',
											'Ventaexpo.st', 'Ventaexpo.t',
											'Ventaexpo.created', 'Ventaexpo.modified',
											'Ventaexpo.cliente_id',
											'Ventaexpo.vendedor_id',
											'Vendedor.vecveven','Vendedor.venom',
											'Cliente.clcvecli','Cliente.cltda','Cliente.clsuc','Cliente.clnom',
											'Cliente.clatn'),
							'doJoinUservendedor'=>true,
							);

	public function beforeFilter() {
		$this->paginate['session']=$this->Auth->User();
		$this->Auth->allow('index', 'add', 'edit', 'delete');
		parent::beforeFilter();
	}
	
	public function add() {		
		$model=$this->Ventaexpo;
		$this->set('title_for_layout', 'Pedido Expo :: Nuevo');
//		$this->set('items', $this->Ventaexpodet->getArticulosCatalogo());
//		$this->set('related', $model->loadDependencies());
		$this->set('mode', 'add');
		$this->set('data',  array(
			'Master' =>
				array('id'=>null, 'st'=>'A', 't'=>'0',
						$model->title => $model->getNextFolio($this->actualSerie, 0),
						$model->dateField => date('Y-m-d'),
						'fvence' => date('Y-m-d'),
						'vendedor_id' => 4002,
						'cliente_id' => 11803,
					),
			'Details' => array(),
			'masterModel' => $model->name,
			'detailModel' => isset($model->detailsModel) ?
							$model->detailsModel :
							null,
			));
		$this->render('edit');
	}

	public function edit( $id=null ) {
		parent::edit($id);
		$this->render('view');
	}

	public function getItemByCve($cve=null) {
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', "Ese Artículo NO Existe (código: $cve)");
			return;
		}

		// Check if Item already exists
		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);
		$item['ArticuloColor']=$this->Articulo->getArticuloColor($item['Articulo']['id']);

		$this->set('result', 'ok');
		$this->set('message', 'Artículo '.$item['Articulo']['arcveart']);
		$this->set('item', $item);
			
	}

	public function getArticulosCatalogo( $id=null ) {
		$this->set('result', 'ok');
		$this->set('message', 'Total de Articulos:');
		$this->set('items', $this->Ventaexpodet->getArticulosCatalogo( $id ));
	}

	public function saveOfflineData( $id=null ) {
		
		
	}

	public function loadOfflineData( $id=null ) {
		
	}

}
