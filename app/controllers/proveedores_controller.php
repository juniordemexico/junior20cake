<?php


class ProveedoresController extends MasterDetailAppController {
	var $name='Proveedores';

	var $uses = array(
		'Proveedor', 'Pais', 'Estado', 'Divisa', 'Articulo', 'ArticuloProveedor'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);

	function index() {
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Proveedor.prcvepro' => 'asc'),
								'fields' => array('Proveedor.id','Proveedor.prcvepro','Proveedor.prnom',
												'Proveedor.prst','Proveedor.prt','Proveedor.pratn',
												'Proveedor.pais_id','Proveedor.estado_id',
												'Pais.papais','Estado.esedo')
								);
		$filter = $this->Filter->process($this);
		$this->set('proveedores', $this->paginate($filter));
	}

	function costos() {
		$this->set('listAction', 'costos');
		$this->set('title_for_layout', 'Costos por Proveedor');
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Proveedor.prcvepro' => 'asc'),
								'fields' => array('Proveedor.id','Proveedor.prcvepro','Proveedor.prnom',
												'Proveedor.prst','Proveedor.prt','Proveedor.pratn',
												'Proveedor.pais_id','Proveedor.estado_id',
												'Pais.papais','Estado.esedo'),
								'conditions'=>array('Proveedor.prst'=>'A')
								);
		$filter = $this->Filter->process($this);
		$this->set('proveedores', $this->paginate($filter));
	}


	function costoarticulo($id = null) {
		$this->set('listAction', 'costos');
		$this->set('title_for_layout', 'Costos por Proveedor');
		if(!empty($this->data)) {
			pr($this->data);
			die();
		}
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if (true/*$this->Proveedor->save($this->data)*/) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Proveedor->read(null, $id);
			$this->set('materiales', $this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN(1)")) );
			$this->set('servicios', $this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id NOT IN(0,1)")) );
		}
	}

	function deleteCostoArticulo($id=null) {
		$this->autoRender=false;
		
		// Check if the ID was submited and if the specified item exists
		if (!$id && 
			isset($this->params['url']['id']) && !($id=$this->params['url']['id']) &&
			!$this->ArticuloProveedor->read(null, $id)) {
			echo __('invalid_item', true).($id?" (id: $id)":'');			
			exit;
		}

		// Execute DB Operations
		if ($this->ArticuloProveedor->delete($id)) {
			echo "OK";
		}
		else {
 			echo __('item_could_not_be_deleted', true)." (id: $id)";
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('proveedor', $this->Proveedor->read(null, $id));
	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Proveedor->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		$divisas = $this->Proveedor->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$estados = $this->Proveedor->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
		$paises = $this->Proveedor->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
	}

	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Proveedor->delete($id)) {
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
			if ($this->Proveedor->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Proveedor->find(array('id'=>$id),array('created','modified'));
				$this->data['Proveedor']['created'] = $dates['Proveedor']['created'];
				$this->data['Proveedor']['modified'] = $dates['Proveedor']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Proveedor->read(null, $id);
		}
		$divisas = $this->Proveedor->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$estados = $this->Proveedor->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
		$paises = $this->Proveedor->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
	}

	/* Text Field Autocomplete action */
	function autoComplete() {
 		Configure::write ( 'debug', 0 );
		$this->autoRender=false;
  		$this->layout = 'ajax';

		/* Validate and Format the search term */
		$term=strtoupper(substr(trim($_GET['term']),0,32));

		/* Configure and Execute the Query */
		$this->Proveedor->recursive=0;
  		$results = $this->Proveedor->find('all', array(
			'fields'=>array('Proveedor.id','Proveedor.prcvepro','Proveedor.prnom','Proveedor.pratn'),
			'order'=>'Proveedor.prcvepro ASC',
			'limit'=>32,
			'conditions' => array(
   					'OR' => array(
    					'Proveedor.prcvepro LIKE'=>$term.'%',
    					'Proveedor.prnom LIKE'=>'%'.$term.'%'
   						),
					'Proveedor.prst'=>'A'
  					)
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($results as $result) {
   			$response[$i]['id']=$result['Proveedor']['id'];
   			$response[$i]['value']=trim($result['Proveedor']['prcvepro']);
   			$response[$i]['label']='('.trim($result['Proveedor']['prcvepro']) . ') ' . $result['Proveedor']['prnom'];
   			$i++;
  		}
		/* Send the response in json format */
  		echo json_encode($response);
	}

}

?>