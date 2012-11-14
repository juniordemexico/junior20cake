<?php


class PaisesController extends MasterDetailAppController {
	var $name='Paises';

	var $uses = array('Pais', 'Divisa');

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Pais.papais'),
								'fields' => array('Pais.id', 'Pais.papais', 'Pais.divisa_id', 'Divisa.dicve'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('paises', $this->paginate($filter));
	}


	function delete($id) {
		$this->autoRender=false;

		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Pais->delete($id)) {
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
			if ($this->Pais->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Pais->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Pais->find(array('id'=>$id),array('created','modified'));
				$this->data['Pais']['created'] = $dates['Pais']['created'];
				$this->data['Pais']['modified'] = $dates['Pais']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pais->read(null, $id);
		}

		$this->set($this->Pais->loadDependencies());

	}

	function add() { 
		if (!empty($this->data)) {
			$this->pais->create();
			if ($this->Pais->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Pais->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set($this->Pais->loadDependencies());
	}

}

?>