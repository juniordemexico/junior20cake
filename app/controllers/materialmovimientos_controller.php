<?php

class MaterialmovimientosController extends MasterDetailAppController {
	var $name='Materialmovimientos';

	var $uses = array(
		'Entsal', 'Entsaldet', 'Articulo', 'Color', 'Tipoartmovbodega', 'Almacen', 'Artmovbodegadetail'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);
	
	public function index() {
		$this->paginate = array('update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Entsal.esfecha' => 'desc'),
								'fields' => array('Entsal.id', 'Entsal.esrefer', 'Entsal.esfecha',
												'Entsal.estmov','Entsal.esconcep',
												'Entsal.st', 'Entsal.est',
												'Entsal.created', 'Entsal.modified',
												'Entsal.refer_id', 'Entsal.refer_model',
												'Entsal.tipoartmovbodega_id', 'Tipoartmovbodega.cve',
												'Entsal.almacen_id','Almacen.aldescrip'),
//								'conditions' => array('Entsal.est'=>0),
								);
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate('Entsal', $filter));
	}

	public function edit( $id = null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$data=$this->Entsal->getItemWithDetails($id);
		$this->set('data', $data );
		$this->set('related', $this->Entsal->loadDependencies());
		$this->set('title_for_layout', 'Mov Materiales::'.$data['Master'][$this->{$this->uses[0]}->title] );
	}

	public function add() {
		// Send a blank form to the user
		if ( empty($this->data) ) {
			$this->set('data', array('Master' =>
									array('id'=>null, 'st'=>'A', 'est'=>'0',
										'esrefer'=>$this->Entsal->getNextFolio('ES', 0),
										'esfecha'=> date('Y-m-d'),
											'almacen_id'=>1, 'tipoartmovbodega_id'=>10, 'tipoarticulo_id'=>1,
										),
									'Tipoartmovbodega' => null,
									'masterModel' => $this->{$this->uses[0]}->name,
									'detailsModel' => isset($this->{$this->uses[0]}->detailsModel) ?
														$this->{$this->uses[0]}->detailsModel :
														null,
									'Details' => array(),
						));
			$this->set('related', $this->Entsal->loadDependencies());
			
			$this->render('edit');
			return;
		}
		
		// Receive the user's PUT request's data in order to add the Item
		$folio=$this->Entsal->getNextFolio('ES', 1);
		$this->data['Entsal']['esrefer']=$folio;

		$this->Entsal->create();
		if ( $this->Entsal->saveAll($this->data) ) {
			$id=$this->Entsal->id;
			$this->set('result','ok');
			$this->set('message', "Transacción guardada {$folio}. (id: {$id})");
			$this->set('losdatos', $this->data);
		} else {
			$this->set('result', 'error');
			$this->set('message', 'Error al guardar el movimiento');
		}
		return;
	}
	
	public function cancel( $id=null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
		}
		$data=$this->Entsal->findById($id, array('id', 'esrefer', 'esfecha',
												'created', 'modified', 'esst', 'est'));
		if( $data && $data['Entsal']['id']>0 && $data['Entsal']['esst']=='A' ) {
			$title=$data['Entsal']['esrefer'];
			// Execute Model Operations
			if( $this->Entsal->cancel($id) ) {
				$this->set('result', 'ok');
				$this->set('message', "Transacción Cancelada {$title}. (id: {$id})");
				$this->set('setFields', array( 'st' => 'C' ) );
			}
			else {
				$this->set('result', 'error');
				$this->set('message', "Error al cancelar la transacción {$title}. (id: {$id})");
			}
		}
		else {
			$this->set('result', 'error');
			$this->set('message', "No se encontró el item o ya esta cancelado (id: {$id})");
		}
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
		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);
		$item['ArticuloColor']=$this->Articulo->getArticuloColor($item['Articulo']['id']);

		$this->set('result', 'ok');
		$this->set('message', 'Material '.$item['Articulo']['arcveart']);
		$this->set('item', $item);
	}

}
