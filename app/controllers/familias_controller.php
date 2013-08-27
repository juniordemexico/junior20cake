<?php


class FamiliasController extends MasterDetailAppController {
	public $name='Familias';

	public $uses = array('Familia');

	public $cacheAction = array('view',
							);
	public $paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Familia.cve'),
								'conditions' => array(),
								); 
/*
	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Familia.cve'),
								'conditions' => array(),
								);
								
		$filter = $this->Filter->process($this);
		
		$this->set('familias', $this->paginate($filter));
	}
*/

	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Familia->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
			$this->redirect(array('action' => 'index'));
		}
		else {
			$this->Session->setFlash(__('item_was_not_deleted', true), 'error');			
		}
		$this->redirect(array('action' => 'index'));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Familia->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Familia->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Familia->read(null, $id);
		}

	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Familia->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Familia->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		$this->set('mode', 'add');
		$this->render('edit');
	}

}

?>