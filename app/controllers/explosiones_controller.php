<?php


class ExplosionesController extends MasterDetailAppController {
	var $name='Explosiones';

	var $uses = array(
		'Explosion', 'Articulo', 'Color', 'Linea', 'Marca', 'Temporada'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);

	function index( $id = null ) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$this->data=$this->Explosion->findByArticuloId($id);
		$this->set('title_for_layout', 'Explosion::'.$this->data['Articulo']['arcveart'] );
		
		$this->set('articulo', $this->Articulo->read(null,$id) );
		$this->set('explosion', $this->Explosion->getAllItems() );
	}

	function view( $id = null ) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('explosion', $this->Explosion->read(null, $id));
	}

	function add($id=null) {
		if(!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));			
		} 
		if (!empty($this->data)) {
			if ($this->Explosion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Explosion->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
			$this->redirect(array('action' => 'index', 'idd' => false));
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
			if ($this->Explosion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Explosion->find(array('id'=>$id),array('created','modified'));
				$this->data['Explosion']['created'] = $dates['Explosion']['created'];
				$this->data['Explosion']['modified'] = $dates['Explosion']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Explosion->read(null, $id);
		}
		$divisas = $this->Explosion->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));

	}

}

?>