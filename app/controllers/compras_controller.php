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

	public function edit( $id = null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$data=$this->Compra->getItemWithDetails($id);
		$this->set('data', $data );
//		$this->set('related', $this->Compra->loadDependencies());
		$this->set('title_for_layout', 'Factura Compra::'.$data['Master'][$this->{$this->uses[0]}->title] );
	}

	public function add() {
		// Send a blank form to the user
		if ( empty($this->data) ) {
			$this->set('data', array('Master' =>
									array('id'=>null, 'st'=>'A', 't'=>'0',
										'folio'=>$this->Compra->getNextFolio('CO', 0),
										'fecha'=> date('Y-m-d'),
											'tipoarticulo_id'=>1,
										),
									'Proveedor' => null,
									'masterModel' => $this->{$this->uses[0]}->name,
									'detailModel' => isset($this->{$this->uses[0]}->detailsModel) ?
														$this->{$this->uses[0]}->detailsModel :
														null,
									'Details' => array(),
						));
//			$this->set('related', $this->Compra->loadDependencies());
			
			$this->render('edit');
			return;
		}
		
		// Receive the user's PUT request's data in order to add the Item
		$folio=$this->Compra->getNextFolio('CO', 1);
		$this->data['Compra']['folio']=$folio;

		$this->Compra->create();
		if ( $this->Compra->saveAll($this->data) ) {
			$id=$this->Compra->id;
			$this->set('result','ok');
			$this->set('message', "Transacción guardada {$folio}. (id: {$id})");
		} else {
			$this->set('result', 'error');
			$this->set('message', 'Error al guardar el movimiento');
		}
		return;
	}
	
	

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
