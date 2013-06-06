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
												'Entsal.tipoartmovbodega_id', 'Tipoartmovbodega.cve',
												'Entsal.almacen_id', 'Almacen.aldescrip'),
//								'conditions' => array('Entsal.est'=>0),
								);
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate('Entsal', $filter));
	}

	public function edit( $id = null ) {
		$this->layout='default';
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$master=$this->Entsal->findById($id);
		$details=$this->Entsal->getDetails($id);
		$this->set(compact('master', 'details'));
		$this->set('related', $this->Entsal->loadDependencies());
		$this->set('title_for_layout', 'Mov Materiales::'.$master['Entsal']['esrefer'] );
	}

	public function add() {
		if (!empty($this->data) ) {
/*
			$this->set('result', 'ok');
			$this->set('message', "REGISTRADO CORRECTAMENTE!" );
			$this->set('losdatos', $this->data);
			return;
*/
			$folio=$this->Entsal->getNextFolio('ES', 1);
			$this->data['Entsal']['esrefer']=$folio;

			$this->Entsal->create();
			if (
				$this->Entsal->saveAll($this->data)) {
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

		$this->set('master', array('Entsal'=>
										array('id'=>null, 'st'=>'A', 'est'=>'0',
										'esrefer'=>'ES01', /*$this->Entsal->getNextFolio('ES', 0)*/
										'esfecha'=> date('Y-m-d'),
										'almacen_id'=>1, 'tipoartmovbodega_id'=>10, 'tipoarticulo_id'=>1,
										),
									'Tipoartmovbodega' => null
							));
		$this->set('details', array());
		$this->set('related', $this->Entsal->loadDependencies());

		$this->render('edit');

	}
	
	public function setCaracteristicas($articulo_id=null) {
		
		if(	!isset($this->params['url']['articulo_id'])
		) {
			$this->set('result', 'error');
			$this->set('message', __('invalid_item', true) );
			return;
		}

		$articulo_id=$this->params['url']['articulo_id'];
		$item=$this->Explosiondato->findByArticulo_id($articulo_id);

		if( isset($this->params['url']['molde']) ) $item['Explosiondato']['molde']=$this->params['url']['molde'];
		if( isset($this->params['url']['datos']) ) $item['Explosiondato']['datos']=$this->params['url']['datos'];

		if( $this->Explosiondato->save($item)) {
			$this->set('result', 'ok');
			$this->set('message', "Las Caracteristicas se guardaron correctamente");
			return;
		}
		$this->set('result', 'error');
		$this->set('message', __('item_could_not_be_saved', true) );
	}
	
	public function deleteItem($id=null) {
		// Check if the ID was submited and if the specified item exists
		$id=$this->params['url']['id'];
		if (
			!$item=$this->Explosion->findById($id)
			) {
			$this->set('result', 'error');
			$this->set('message', __('invalid_item', true)." (id: $id)" );
			return;
		}
		$articulo_id=$item['Explosion']['articulo_id'];

		// Execute DB Operations
		if ($this->Explosion->delete($id)) {
			$this->set('result', 'ok');
			$this->set('message', $this->tipoarticulomovimientos[$item['Explosion']['tipoexplosion_id']].' '.
								' se Eliminó de la Explosión');
			$this->set('details', $this->Explosion->getAllItems($item['Explosion']['articulo_id']) );
			return;
		}
		$this->data['result']='error';
		$this->data['message']=__('item_could_not_be_deleted', true)." (id: ".$item['Explosion']['id'].")";
	}


	public function updateCantidad($id=null, $value=0) {
		$this->autoRender=false;
		$this->data=array();

		// Check if the ID was submited and if the specified item exists
		if (!$id || 
			!$item=$this->Explosion->read(null, $id)) {
			$this->data['result']='error';
			$this->data['message']='Item Inválido ('.$id.', '.$value.')';
			echo json_encode($this->data);
			die();
		}

		$this->data=$this->Explosion->read(null, $id);

/*
		if( isset($this->params['url']['value']) && $this->params['url']['value']>0) {
			$value=$this->params['url']['value'];
		}
		else {
			return( e(json_encode(array('result'=>'error', 'mesage'=>__('invalid_item', true)))) );
		}
*/		
		if (!$value || $value<0) {
			if( isset($this->params['url']['value']) ) {
				$value=$this->params['url']['value'];
			}
			else {
				echo __('invalid_item', true).($id?" (id: $id)":'');			
				exit;
			}
		}

		// Execute DB Operations
		if ($this->Explosion->saveField('cant', $value) ) {
			$this->data['result']='ok';
			$this->data['message']='El Material '.$item['Articulo']['arcveart'].
									' se actualizo correctamente.';
			$this->data['details']=$this->Explosion->getAllItems($item['Explosion']['articulo_id']);
		}
		else {
			$this->data['result']='error';
			$this->data['message']='El Material '.$id.
									' NO se pudo actualizar al costo '.$value;
		}
		echo json_encode($this->data);
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
