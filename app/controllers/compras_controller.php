<?php

class ComprasController extends MasterDetailAppController {
	public $name='Compras';

	public $uses = array(
		'Compra', 'Compradet', 'Articulo', 'Color', 'Proveedor', 'Divisa'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view'
							);

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Compra.fecha' => 'desc'),
							'fields' => array('Compra.id', 'Compra.folio', 'Compra.fecha',
											'Compra.importe', 'Compra.impoimpu', 'Compra.total',
											'Compra.st', 'Compra.t',
											'Compra.created', 'Compra.modified',
											'Compra.proveedor_id','Compra.divisa_id',
											'Proveedor.prcvepro','Proveedor.prnom',
											'Proveedor.pratn'),
//										'conditions' => array('Compra.est'=>0),
							);

	public function edit( $id = null ) {
		$this->layout='default';
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$master=$this->Compra->findById($id);
		$details=$this->Compra->getDetails($id);
		$this->set(compact('master', 'details'));
		$this->set('related', $this->Entsal->loadDependencies());
		$this->set('title_for_layout', 'Compras :: Nueva' );
	}

	public function add() {
		if (!empty($this->data)) {
			$this->Compra->create();
			if (
				$this->Compra->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Compra->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set('master', array('Compra'=>
										array('id'=>null, 'folio'=>'C0000001', 'fecha'=> date('Y-m-d'), 
											'divisa_id'=>1,'tipodecambio'=>1,'proveedor_id'=>null,'','st'=>'A',
										),
									'Proveedor' => null
							));
		$this->set('details', array());
		$this->set('related', $this->Compra->loadDependencies());

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
			$this->Compradet->find('first', array('conditions'=>array('articulo_id'=>$articulo_id,
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
