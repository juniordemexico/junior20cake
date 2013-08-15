<?php


class TransportesController extends MasterDetailAppController {
	var $name='Transportes';

	var $uses = array(
		'Transporte', 'Pais', 'Estado'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);

	public function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Transporte.trcve' => 'asc'),
								'fields' => array('Transporte.id','Transporte.trcve','Transporte.trnom',
												'Transporte.trst','Transporte.trt','Transporte.tratn',
												'Transporte.pais_id','Transporte.estado_id',
												'Pais.papais','Estado.esedo')
								);
		$filter = $this->Filter->process($this);
		$this->set('transportes', $this->paginate($filter));
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('transporte', $this->Transporte->read(null, $id));
	}

	public function add() { 
		if (!empty($this->data)) {
			if ($this->Transporte->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		$estados = $this->Transporte->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
		$paises = $this->Transporte->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
	}

	public function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Transporte->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
			$this->redirect(array('action' => 'index', 'idd' => false));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}

	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Transporte->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Transporte->find(array('id'=>$id),array('created','modified'));
				$this->data['Transporte']['created'] = $dates['Transporte']['created'];
				$this->data['Transporte']['modified'] = $dates['Transporte']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Transporte->read(null, $id);
		}
		$estados = $this->Transporte->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
		$paises = $this->Transporte->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
	}

	public function getItemByCve($cve=null) {
		if(!$cve && isset($this->params['url']['articulo_id']) ) $articulo_id=$this->params['url']['articulo_id'];
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Material NO Existe');
			return;
		}

		if($item['Articulo']['tipoarticulo_id']==2) $palabra='Servicio'; else $palabra='Material';
		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);

		$this->set('result', 'ok');
		$this->set('message', $palabra.' ('.$cve.')');
		$this->set('item', $item);
	}


	/* Text Field Autocomplete action */
	public function autoComplete() {
 		Configure::write ( 'debug', 0 );
		$this->autoRender=false;
  		$this->layout = 'ajax';

		/* Validate and Format the search term */
		$term=strtoupper(substr(trim($_GET['term']),0,32));

		/* Configure and Execute the Query */
		$this->Transporte->recursive=0;
  		$results = $this->Transporte->find('all', array(
			'fields'=>array('Transporte.id','Transporte.trcve','Transporte.trnom','Transporte.tratn'),
			'order'=>'Transporte.trcve ASC',
			'limit'=>32,
			'conditions' => array(
   					'OR' => array(
    					'Transporte.trcve LIKE'=>$term.'%',
    					'Transporte.trnom LIKE'=>'%'.$term.'%'
   						),
					'Transporte.trst'=>'A'
  					)
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($results as $result) {
   			$response[$i]['id']=$result['Transporte']['id'];
   			$response[$i]['value']=trim($result['Transporte']['prcvepro']);
   			$response[$i]['label']='('.trim($result['Transporte']['prcvepro']) . ') ' . $result['Transporte']['prnom'];
   			$i++;
  		}
		/* Send the response in json format */
  		echo json_encode($response);
	}

}
