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
											'Ordencompra.proveedor_id','Ordencompra.divisa_id',
											'Proveedor.prcvepro','Proveedor.prnom',
											'Proveedor.pratn'),
//										'conditions' => array('Ordencompra.est'=>0),
							);

	public function edit( $id = null ) {
		$this->layout='default';
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$master=$this->Ordencompra->findById($id);
		$details=$this->Ordencompra->getDetails($id);
		$this->set(compact('master', 'details'));
		$this->set('related', $this->Entsal->loadDependencies());
		$this->set('title_for_layout', 'Orden de Compra :: Nueva' );
	}

	public function add() {
		if (!empty($this->data)) {
			$this->Ordencompra->create();
			if (
				$this->Ordencompra->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Ordencompra->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set('master', array('Ordencompra'=>
										array('id'=>null, 'folio'=>'C0000001', 'fecha'=> date('Y-m-d'), 
											'divisa_id'=>1,'tipodecambio'=>1,'proveedor_id'=>null,'','st'=>'A',
										),
									'Proveedor' => null
							));
		$this->set('details', array());
		$this->set('related', $this->Ordencompra->loadDependencies());

		$this->render('edit');
	}

	public function getItemByCve($cve=null) {
//		if(!$cve && isset($this->params['url']['articulo_id']) ) $articulo_id=$this->params['url']['articulo_id'];
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Material NO Existe');
			return;
		}

		// Check if Item already exists
/*
		if(
			$this->Ordencompradet->find('first', array('conditions'=>array('articulo_id'=>$articulo_id,
			 														'material_id'=>$item['Articulo']['id'])) )
			) {
			$this->set('result', 'error');
			$this->set('message', "$cve ya existe para este producto");
			return;			
		}
*/
		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);
		$item['ArticuloColor']=$this->Articulo->getArticuloColor($item['Articulo']['id']);

		$this->set('result', 'ok');
		$this->set('message', 'Material '.$item['Articulo']['arcveart']);
		$this->set('item', $item);
	}

}
