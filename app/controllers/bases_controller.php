<?php


class BasesController extends MasterDetailAppController {
	public $name='Bases';

	public $uses = array('Base');

	public $cacheAction = array('view',
							);
	public $paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Base.cve'),
								'conditions' => array(),
								); 

	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Base->delete($id)) {
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
			if ($this->Base->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Base->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Base->read(null, $id);
		}

	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Base->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Base->id.')', 'success');
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