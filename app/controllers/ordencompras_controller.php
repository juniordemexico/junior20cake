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

	public function edit( $id = null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$data=$this->Ordencompra->getItemWithDetails($id);
		$this->set('data', $data );
		$this->set('related', $this->Ordencompra->loadDependencies());
		$this->set('title_for_layout', 'Órden de Compra::'.$data['Master'][$this->{$this->uses[0]}->title] );
	}

	public function add() {
		// Send a blank form to the user
		if ( empty($this->data) ) {
			$this->set('data', array('Master' =>
									array('id'=>null, 'st'=>'A', 't'=>'0',
										'folio'=>$this->Ordencompra->getNextFolio('OC', 0),
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
			$this->set('related', $this->Ordencompra->loadDependencies());
			
			$this->render('edit');
			return;
		}
		
		// Receive the user's PUT request's data in order to add the Item
		$folio=$this->Ordencompra->getNextFolio('OC', 1);
		$this->data['Ordencompra']['folio']=$folio;

		$this->Ordencompra->create();
		if ( $this->Ordencompra->saveAll($this->data) ) {
			$id=$this->Ordencompra->id;
			$this->set('result','ok');
			$this->set('message', "Transacción guardada {$folio}. (id: {$id})");
			$this->set('losdatos', $this->data);
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
