<?php

class FormadepagosController extends MasterAppController {
	public $name='Formadepagos';

	public $uses = array(
		'Formadepago'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view'
							);

	public $tipoarticulo_id = 0;

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							);


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true));
			exit;
		}
		if (!empty($this->data)) {
			if ($this->Formadepago->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Formadepago->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Formadepago->find(array('id'=>$id),array('created','modified'));
				$this->data['Formadepago']['created'] = $dates['Formadepago']['created'];
				$this->data['Formadepago']['modified'] = $dates['Formadepago']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Formadepago->read(null, $id);
		}
	}

	public function getItemByCve($cve=null) {
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Esa Forma de Pago NO Existe');
			return;
		}

		// Check if Item already exists
		$item['Formadepago']['cve']=trim($item['Formadepago']['cve']);
		$item['Formadepago']=$this->Formadepago->getItemById($item['Formadepago']['id']);

		$this->set('result', 'ok');
		$this->set('message', 'Forma de Pago '.$item['Formadepago']['cve']);
		$this->set('item', $item);
	}

}
