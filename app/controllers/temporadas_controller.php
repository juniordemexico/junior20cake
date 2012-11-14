<?php


class TemporadasController extends MasterDetailAppController {
	var $name='Temporadas';

	var $uses = array('Temporada');

	var $cacheAction = array('view',
							);

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Temporada.tecve'),
								'conditions' => array(),
								);
								
		$filter = $this->Filter->process($this);
		
		$this->set('temporadas', $this->paginate($filter));
	}


	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('controller'=>'Temporadas','action' => 'index'));
		}
		if ($this->Temporada->delete($id)) {
			CakeLog::write('activity', 'Usr:'.$this->Auth->User('id').' Ctrl:'.$this->name .' Action:'.$this->action.' Id:'.$id);
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
			$this->redirect(array('controller'=>'Temporadas', 'action'=>'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('controller'=>'Temporadas', 'action' => 'index'));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Temporada->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Temporada->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Temporada->find(array('id'=>$id),array('created','modified'));
				$this->data['Temporada']['created'] = $dates['Temporada']['created'];
				$this->data['Temporada']['modified'] = $dates['Temporada']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Temporada->read(null, $id);
		}

	}

	function add() { 
		if (!empty($this->data)) {
			$this->Temporada->create();
			if ($this->Temporada->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Temporada->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

}

?>