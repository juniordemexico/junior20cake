<?php

class VentatiendasController extends MasterDetailAppController {
	public $name='Ventatiendas';

	public $uses = array(
		'Ventatda', 'Ventatdadet', 'Vendedor', 'Cliente', 'Divisa', 'Articulo', 'Color'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view'
							);

	public $tipoarticulo_id = 0;
	public $actualSerie = 'VT';

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Ventatda.fecha' => 'desc'),
							'fields' => array('Ventatda.id', 'Ventatda.folio', 'Ventatda.fecha',
											'Ventatda.suma', 'Ventatda.impu1', 'Ventatda.importe', 'Ventatda.impoimpu', 'Ventatda.total',
											'Ventatda.st', 'Ventatda.t',
											'Ventatda.created', 'Ventatda.modified',
											'Ventatda.cliente_id',
											'Ventatda.vendedor_id','Vendedor.vecveven','Vendedor.venom',
											'Ventatda.divisa_id',
											'Cliente.clcvecli', 'Cliente.cltda', 'Cliente.clnom',
											'Cliente.clatn'),
							);

	public function save() {
		// Receive the user's PUT request's data in order to add the Item
		$folio=$this->{$this->masterModelName}->getNextFolio($this->actualSerie, 1);
		$this->data[$this->masterModelName][$this->{$this->masterModelName}->title]=$folio;

		$this->{$this->masterModelName}->create();
		if ( $this->{$this->masterModelName}->saveAll($this->data) ) {
			$id=$this->{$this->masterModelName}->id;
			$this->set('result','ok');
			$this->set('message', "Transacción guardada {$folio}. (id: {$id})");
			$this->set('nextFolio', $this->Ventatda->getNextFolio($this->actualSerie, 0));
		} else {
			$this->set('result', 'error');
			$this->set('message', 'Error al guardar el movimiento');
		}
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
	}

	public function add() {		
		$model=$this->Ventatda;
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
