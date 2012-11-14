<?php


class DivisasController extends MasterDetailAppController {
	var $name='Divisas';

	var $uses = array('Divisa');

	var $cacheAction = array('view',
							);


	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Divisa.dicve'),
								'fields' => array('Divisa.id', 'Divisa.dicve', 'Divisa.dinom', 'Divisa.ditcambio', 'Divisa.created', 'Divisa.modified'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('divisas', $this->paginate($filter));
	}


	function delete($id) {
		$this->autoRender=false;

		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Divisa->delete($id)) {
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
			if ($this->Divisa->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Divisa->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Divisa->find(array('id'=>$id),array('created','modified'));
				$this->data['Divisa']['created'] = $dates['Divisa']['created'];
				$this->data['Divisa']['modified'] = $dates['Divisa']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Divisa->read(null, $id);
		}

	}

	function add() { 
		if (!empty($this->data)) {
			$this->divisa->create();
			if ($this->Divisa->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Divisa->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

}

?>