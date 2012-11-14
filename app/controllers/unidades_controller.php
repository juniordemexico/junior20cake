<?php


class UnidadesController extends MasterDetailAppController {
	var $name='Unidades';

	var $uses = array('Unidad');

	var $cacheAction = array('view',
							);

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Unidad.cve'),
								'conditions' => array(),
								);
								
		$filter = $this->Filter->process($this);
		
		$this->set('unidades', $this->paginate($filter));
	}


	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Unidad->delete($id)) {
			CakeLog::write('activity', 'Usr:'.$this->Auth->User('id').' Ctrl:'.$this->name .' Action:'.$this->action.' Id:'.$id);
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Unidad->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Unidad->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Unidad->find(array('id'=>$id),array('created','modified'));
				$this->data['Unidad']['created'] = $dates['Unidad']['created'];
				$this->data['Unidad']['modified'] = $dates['Unidad']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Unidad->read(null, $id);
		}

	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Unidad->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Unidad->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

}

?>