<?php


class TallasController extends MasterDetailAppController {
	var $name='Tallas';

	var $uses = array('Talla');

	var $cacheAction = array('view',
							);

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Talla.tadescrip'),
								);
								
		$filter = $this->Filter->process($this);
		
		$this->set('tallas', $this->paginate($filter));
	}

/*
	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Talla->delete($id)) {
			CakeLog::write('activity', 'Usr:'.$this->Auth->User('id').' Ctrl:'.$this->name .' Action:'.$this->action.' Id:'.$id);
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}
*/

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
//			if ($this->Talla->save($this->data)) {
			$this->Talla->read(null, $id);
			if($this->Talla->saveField('tadescrip', $this->data['Talla']['tadescrip']) &&
				$this->Talla->saveField('st', $this->data['Talla']['st'])
				) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Talla->read(null, $id);
		}
	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Talla->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Talla->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

}

?>