<?php


class EstadosController extends MasterDetailAppController {
	var $name='Estados';

	var $uses = array('Estado', 'Pais');

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Estado.esedo'),
								'fields' => array('Estado.id', 'Estado.esedo', 'Estado.pais_id', 'Pais.papais'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('estados', $this->paginate($filter));
	}


	function delete($id) {
		$this->autoRender=false;

		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Estado->delete($id)) {
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
			if ($this->Estado->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Estado->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Estado->find(array('id'=>$id),array('created','modified'));
				$this->data['Estado']['created'] = $dates['Estado']['created'];
				$this->data['Estado']['modified'] = $dates['Estado']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Estado->read(null, $id);
		}

		$this->set($this->Estado->loadDependencies());

	}

	function add() { 
		if (!empty($this->data)) {
			$this->estado->create();
			if ($this->Estado->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Estado->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set($this->Estado->loadDependencies());
	}

}
