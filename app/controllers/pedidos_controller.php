<?php

class PedidosController extends MasterDetailAppController {
	public $name='Pedidos';

	public $uses = array(
		'Pedido', 'Pedidodet', 'Vendedor', 'Cliente', 'Articulo', 'Color', 'Bases', 'Estilos', 'Tallas'
	);

	public $layout = 'default';
/*	
	public $cacheAction = array('view'
							);
*/
	public $tipoarticulo_id = 0;
	public $actualSerie = 'PT';

	public $paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Pedido.pefecha'=>'DESC','Pedido.perefer' => 'DESC'),
								'fields' => array(
							'id','perefer','pefecha','pefvence','pet','pest','petotal','peauto','pefauto',
							'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
							'Pedido.vendedor_id','Vendedor.vecveven','Vendedor.venom','divisa_id','Divisa.dicve',
							'Pedido.ventaexpo_id',
							'crefec','modfec'),
								'conditions' => array(),
								'doJoinUservendedor'=>true,
								);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->paginate['session']=$this->Auth->User();
		$this->Auth->allow('importa');    
	}
	
	public function add() {		
		$model=$this->Pedido;
		$this->set('items', $this->Pedidodet->getArticulosCatalogo());
		$this->set('title_for_layout', 'Pedido :: Nuevo');
		parent::add( array(
					'Master' =>
						array('id'=>null, 'st'=>'A', 't'=>'0',
								$model->title => $model->getNextFolio($this->actualSerie, 0),
								$model->dateField => date('Y-m-d'),
								$model->dateLimitField => date('Y-m-d'),
								'vendedor_id' => 4002,
								'cliente_id' => 11803,
							),
					'Details' => array(),
					'masterModel' => $model->name,
					'detailModel' => isset($model->detailsModel) ?
									$model->detailsModel :
									null,
				));
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
		$this->set('items', $this->Pedidodet->getArticulosCatalogo( $id ));
	}

	function getArreglo($id=null) {
			$this->Pedido->recursive=2;
			$this->data = $this->Pedido->read(null, $id);
			print_r($this->data);
			die();
	}

}
