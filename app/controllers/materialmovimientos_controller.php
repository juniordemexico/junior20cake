<?php

class MaterialmovimientosController extends MasterDetailAppController {
	var $name='Materialmovimientos';

	var $uses = array(
		'Entsal', 'Articulo', 'Color', 'Artmovbodegadetail'
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
												'Entsal.esst', 'Entsal.est',
												'Entsal.created', 'Entsal.modified'),
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
		$this->data=array();
		$this->data['master']=$this->Entsal->findById($id);
		$this->data['details']=$this->Entsal->getDetails($id);
		$this->set('title_for_layout', 'Movimiento de Materiales :: Nuevo' );
	}

	public function add() {
		if (!empty($this->data)) {
			$this->Entsal->create();
			if (
				$this->Entsal->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Entsal->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->data['master']=array('Entsal'=>
								array('esrefer'=>'ES000001', 'esfecha'=> date('Y-m-d'), 'est'=>'0')
							);
		$this->data['details']=array('Entsaldet'=>array());
		$this->data['related']=$this->Entsal->loadDependencies();

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
/*
		if(
			$this->Entsaldet->find('first', array('conditions'=>array('articulo_id'=>$articulo_id,
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
