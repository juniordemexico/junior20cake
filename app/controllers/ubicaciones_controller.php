<?php


class UbicacionesController extends MasterDetailAppController {
	var $name='Ubicaciones';

	var $uses = array('Ubicacion', 'Tipoarticulo');

	var $cacheAction = array('view',
							);
	var $layout = 'default';


	function index() {
		$this->Ubicacion->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Ubicacion.tipoarticulo_id', 'Ubicacion.licve'),
								'fields' => array('id', 'licve', 'descrip', 'Tipoarticulo.id', 'Tipoarticulo.cve', 'created', 'modified'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('ubicaciones', $this->paginate($filter));
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
				$dates = $this->Ubicacion->find(array('id'=>$id),array('created','modified'));
				$this->data['Ubicacion']['created'] = $dates['Ubicacion']['created'];
				$this->data['Ubicacion']['modified'] = $dates['Ubicacion']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ubicacion->read(null, $id);
		}

		$tipoarticulos = $this->Tipoarticulo->find('list', array('fields' => array('Tipoarticulo.id', 'Tipoarticulo.cve')));
		$this->set(compact('tipoarticulos'));

	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Ubicacion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Ubicacion->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$tipoarticulos = $this->Tipoarticulo->find('list', array('fields' => array('Tipoarticulo.id', 'Tipoarticulo.cve')));
		$this->set(compact('tipoarticulos'));

	}

}
