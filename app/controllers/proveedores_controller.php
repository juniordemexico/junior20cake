<?php


class ProveedoresController extends MasterDetailAppController {
	var $name='Proveedores';

	var $uses = array(
		'Proveedor', 'Pais', 'Estado', 'Divisa', 'Articulo', 'ArticuloProveedor'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);

	public function index() {
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

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('proveedor', $this->Proveedor->read(null, $id));
	}

	public function add() { 
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

	public function costos() {
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

	public function costoarticulo($id = null) {
		$this->set('listAction', 'costos');

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		$this->data = array();
		$this->data['master']=$this->Proveedor->read(null, $id);
		$this->data['details']=$this->ArticuloProveedor->getAllArticuloProveedor($id);
		$this->set('related', $this->ArticuloProveedor->loadDependencies());
		$this->set('title_for_layout', 'Costos :: '.$this->data['master']['Proveedor']['prcvepro'] );
	}

	public function addCostoArticulo() {
		//  If Material or Proveedor doesn't exists
		if( !isset($this->params['url']['proveedor_id']) || 
			!isset($this->params['url']['material_id']) || 
			!isset($this->params['url']['costo']) ||
			!($this->params['url']['costo']>0) ) {
			$this->set('result', 'error');
			$this->set('message', __('item_could_not_be_saved', true) );
			return;
		}

		$proveedor_id=$this->params['url']['proveedor_id'];
		$material_id=$this->params['url']['material_id'];
		
		$record=array('ArticuloProveedor'=>array(
							'proveedor_id'=>$proveedor_id,
							'articulo_id'=>$material_id,
							'costo'=>$this->params['url']['costo'],
					));

		if(!isset($this->params['url']['unidad_id']) || !($this->params['url']['unidad_id']>0) )
			$record['ArticuloProveedor']['unidad_id']=1; 
		else 
			$record['ArticuloProveedor']['unidad_id']=$this->params['url']['unidad_id'];

		if(isset($this->params['url']['composicion'])) $record['ArticuloProveedor']['composicion']=$this->params['url']['composicion'];
		if(isset($this->params['url']['ancho'])) $record['ArticuloProveedor']['ancho']=$this->params['url']['ancho'];
		if(isset($this->params['url']['origen'])) $record['ArticuloProveedor']['origen']=$this->params['url']['origen'];

		// Create the new record
		$this->ArticuloProveedor->create();
		if( $this->ArticuloProveedor->save($record) ) {
			$this->set('result', 'ok');
			$this->set('message', 'El Costo se agregó correctamente');
			$this->set('details', $this->ArticuloProveedor->getAllArticuloProveedor($proveedor_id) );
			return;
		}
		$this->set('result', 'error');
		$this->set('message', 'El Costo NO se pudo agregar');
	}

	public function getDetails($proveedor_id=null) {
		$this->set('details', $this->ArticuloProveedor->getAllArticuloProveedor($proveedor_id) );
	}

	public function authorizeCostoArticulo($id=null) {
		if(!$id && isset($this->params['url']['id']) ) $id=$this->params['url']['id'];

		// Check if the ID was submited and if the specified item exists
		if(!$id ||
			!($item=$this->ArticuloProveedor->read(null, $id)) ) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Item NO Existe ('.$id.')');
			return;
		}
		$proveedor_id=$item['ArticuloProveedor']['proveedor_id'];
		$material_cve=$item['Articulo']['arcveart'];

		// Execute DB Operations
		if ( $this->ArticuloProveedor->saveField('fautoriza', date('Y-m-d H:m:i')) ) {
			$this->set('result', 'ok');
			$this->set('message', 'Se Autorizó '.$material_cve.' '.round($item['ArticuloProveedor']['costo'],2));
			$this->set('details', $this->ArticuloProveedor->getAllArticuloProveedor($proveedor_id) );
			return;
		}			
		$this->set('result', 'error');
		$this->set('message', 'El Costo NO se pudo AUTORIZAR ('.$id.')');
	}

	public function deleteCostoArticulo($id=null) {
		if(!$id && isset($this->params['url']['id']) ) $id=$this->params['url']['id'];

		// Check if the ID was submited and if the specified item exists
		if (!$id || 
			!$master=$this->ArticuloProveedor->findById($id)
			) {
			$this->set('result', 'error');
			$this->set ('message', 'Ese Item NO Existe ('.$id.')');
			return;
		}
		$proveedor_id=$master['ArticuloProveedor']['proveedor_id'];

		// Execute DB Operations
		if ( $this->ArticuloProveedor->delete($id) ) {
			$this->set('result', 'ok');
			$this->set('message', 'El Costo se Eliminó');
			$this->set('details', $this->ArticuloProveedor->getAllArticuloProveedor($proveedor_id) );
			return;
		}
		$this->set('result', 'error');
		$this->set('message', 'El Costo NO se pudo eliminar ('.$id.')');
	}

	public function changeCosto($id=null) {
		if(isset($this->params['url']['id'])) $id=$this->params['url']['id'];
		if(isset($this->params['url']['costo'])) $costo=abs($this->params['url']['costo']);

		if(!$id ||
			!($item=$this->ArticuloProveedor->read(null, $id)) ) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Item NO Existe ('.$id.')');
			return;
		}

		if( $this->ArticuloProveedor->saveField('costo', $costo) ) {
			$this->set('result', 'ok');
			$this->set('details', $this->ArticuloProveedor->getAllArticuloProveedor($proveedor_id) );
			return;
		}
		$this->set('result', 'error');
		$this->set('message', 'El Costo NO se pudo cambiar ('.$id.')');
	}

	public function delete($id) {
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

	public function edit($id = null) {
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
