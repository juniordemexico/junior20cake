<?php


class FacturadoctosController extends MasterDetailAppController {

	var $name = "Facturadoctos";
	var $uses = array('Facturadocto', 'Factura', 'Cliente', 'Vendedor');

	public function index() {
		$params = array(
			'fields' => array('_id', 'folio', 'fecha', 'cliente_id', 'content', 'created', 'modified' ),
			//'fields' => array('Facturadocto.title', ),
			//'conditions' => array('title' => 'hehe'),
			//'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
			//'order' => array('title' => 1, 'body' => 1),
			'order' => array('folio' => -1),
			'limit' => 10,
			'page' => 1,
		);
		$items = $this->Facturadocto->find('all', $params);
		//$items_count = $this->Facturadocto->find('count', $params);
		$this->set(compact('items'));
	}

	public function add() {
		if (!empty($this->data)) {

			$this->Facturadocto->create();
			if ($this->Facturadocto->save($this->data)) {
				$this->flash(__('Post saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

/**
 * edit method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Post', true), array('action' => 'index'));
		}
		if (!empty($this->data)) {

			if ($this->Facturadocto->save($this->data)) {
				$this->flash(__('The Post has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Facturadocto->read(null, $id);
			//$this->data = $this->Facturadocto->find('first', array('conditions' => array('_id' => $id)));
		}
	}

/**
 * delete method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	public function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Post', true), array('action' => 'index'));
		}
		if ($this->Facturadocto->delete($id)) {
			$this->flash(__('Post deleted', true), array('action' => 'index'));
		} else {
			$this->flash(__('Post deleted Fail', true), array('action' => 'index'));
		}
	}

/**
 * deleteall method
 *
 * @return void
 * @access public
 */
	public function deleteall() {
		$conditions = array('title' => 'aa');
		if ($this->Facturadocto->deleteAll($conditions)) {
			$this->flash(__('Post deleteAll success', true), array('action' => 'index'));

		} else {
			$this->flash(__('Post deleteAll Fail', true), array('action' => 'index'));
		}
	}

/**
 * updateall method
 *
 * @return void
 * @access public
 */
	public function updateall() {
		$conditions = array('title' => 'ichi2' );

		$field = array('title' => 'ichi' );

		if ($this->Facturadocto->updateAll($field, $conditions)) {
			$this->flash(__('Post updateAll success', true), array('action' => 'index'));

		} else {
			$this->flash(__('Post updateAll Fail', true), array('action' => 'index'));
		}
	}

	public function createindex() {
		$mongo = ConnectionManager::getDataSource($this->Facturadocto->useDbConfig);
		$mongo->ensureIndex($this->Facturadocto, array('title' => 1));

	}


}