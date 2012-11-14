<?php


class MarcasController extends MasterDetailAppController {
	var $name='Marcas';

	var $uses = array('Marca');

	var $cacheAction = array('view',
							);

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Marca.MACVE'),
								'conditions' => array(),
								);
								
		$filter = $this->Filter->process($this);
		
		$this->set('marcas', $this->paginate($filter));
	}


	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Marca->delete($id)) {
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
			if ($this->Marca->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Marca->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Marca->find(array('id'=>$id),array('created','modified'));
				$this->data['Marca']['created'] = $dates['Marca']['created'];
				$this->data['Marca']['modified'] = $dates['Marca']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Marca->read(null, $id);
		}

	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Marca->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Marca->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

}

?>