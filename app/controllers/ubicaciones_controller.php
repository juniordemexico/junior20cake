<?php


class UbicacionesController extends MasterDetailAppController {
	var $name='Ubicaciones';

	var $uses = array('Ubicacion', 'Almacen');

	var $cacheAction = array('view',
							);
	var $layout = 'default';

	function beforeFilter() {
		parent::beforeFilter();
		if( isset($this->data) && isset($this->data['Ubicacion']) ) {
			$this->data['Ubicacion']['cve']=$this->data['Ubicacion']['zona'].
											$this->data['Ubicacion']['fila'].
											$this->data['Ubicacion']['espacio'];
		}
	}

	function index() {
		$this->Ubicacion->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Almacen.alcve','Ubicacion.cve'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('items', $this->paginate($filter));
	}


	function delete($id) {
		$this->autoRender=false;

		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Ubicacion->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true));
			exit;
		}
		if (!empty($this->data)) {
			if ($this->Ubicacion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Ubicacion->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ubicacion->read(null, $id);
		}

		$this->set('almacenes', $this->Ubicacion->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}

	function add() { 
		if (!empty($this->data)) {
			pr($this->data);
//			$this->Ubicacion->create($this->data);
			if ($this->Ubicacion->save($this->data, array('validate'=>false))) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Ubicacion->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set('almacenes', $this->Ubicacion->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}

}
