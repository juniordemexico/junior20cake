<?php


class ProporcionesController extends MasterDetailAppController {
	public $name='Proporciones';

	public $uses = array('Proporcion');

	public $cacheAction = array('view',
							);

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Proporcion.cve'),
								'conditions' => array(),
								);
								
		$filter = $this->Filter->process($this);
		
		$this->set('proporciones', $this->paginate($filter));
	}


	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Proporcion->delete($id)) {
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
			if ($this->Proporcion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Proporcion->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Proporcion->read(null, $id);
		}

	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Proporcion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Proporcion->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

}

?>