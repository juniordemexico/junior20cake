<?php

class VentaexposController extends MasterDetailAppController {
	public $name='Ventaexpos';

	public $uses = array(
		'Ventaexpo', 'Ventaexpodet', 'Vendedor', 'Cliente', 'Articulo', 'Color', 'Bases', 'Estilos', 'Tallas'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view'
							);

	public $tipoarticulo_id = 0;
	public $actualSerie = 'VX';

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Ventaexpo.fecha' => 'desc'),
							'fields' => array('Ventaexpo.id', 'Ventaexpo.folio', 'Ventaexpo.fecha',
											'Ventaexpo.fvence', 'Ventaexpo.importe', 'Ventaexpo.total',
											'Ventaexpo.st', 'Ventaexpo.t',
											'Ventaexpo.created', 'Ventaexpo.modified',
											'Ventaexpo.cliente_id',
											'Ventaexpo.vendedor_id',
											'Vendedor.vecveven','Vendedor.venom',
											'Cliente.clcvecli','Cliente.clnom',
											'Cliente.clatn'),
							);

	public function add() {		
		$model=$this->Ventaexpo;
		$this->set('items', $this->Ventaexpodet->getArticulosCatalogo());
		$this->set('title_for_layout', 'Pedido Expo :: Nuevo');
		parent::add( array(
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
	}

	public function edit( $id=null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$data=$this->{$this->masterModelName}->getItemWithDetails($id);
		$this->set('data', $data );
		$this->set('title_for_layout', ucfirst($this->name).'::'.
										$data['Master'][$this->masterModelTitle]
				);
		$this->render('view');
	}

	public function save() {
		// Receive the user's PUT request's data in order to add the Item
		$folio=$this->{$this->masterModelName}->getNextFolio($this->actualSerie, 1);
		$this->data[$this->masterModelName][$this->{$this->masterModelName}->title]=$folio;

		$this->{$this->masterModelName}->create();
		if ( $this->{$this->masterModelName}->saveAll($this->data) ) {
			$id=$this->{$this->masterModelName}->id;
			$this->set('result','ok');
			$this->set('message', "Transacción guardada {$folio}. (id: {$id})");
			$this->set('nextFolio', $this->Ventaexpo->getNextFolio($this->actualSerie, 0));
		} else {
			$this->set('result', 'error');
			$this->set('message', 'Error al guardar el movimiento');
		}
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

}
