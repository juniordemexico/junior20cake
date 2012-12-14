<?php


class InvfisicosController extends MasterDetailAppController {
	var $name='Invfisicos';

	var $uses = array('Invfisico', 'Almacen');

	var $cacheAction = array('view',
							);
	var $layout = 'default';


	function index() {
		$this->Invfisico->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Invfisico.fecha','Invfisico.almacen_id'),
								'fields' => array('Invfisico.id', 'Invfisico.cve',
								 				'Invfisico.fecha', 'Almacen.aldescrip',
								 				'Invfisico.finicio', 'Invfisico.ftermino',
								 				'Invfisico.st', 'Invfisico.modified'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('items', $this->paginate($filter));
	}


	function delete($id) {
		$this->autoRender=false;

		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Almacen->delete($id)) {
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
			if ($this->Almacen->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Almacen->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Almacen->find(array('id'=>$id),array('created','modified'));
				$this->data['Almacen']['created'] = $dates['Almacen']['created'];
				$this->data['Almacen']['modified'] = $dates['Almacen']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Almacen->read(null, $id);
		}

		$this->set('almacenes', $this->Invfisico->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Almacen->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Almacen->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set('almacenes', $this->Invfisico->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}

}
