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
		$this->set('title_for_layout', 'Costos por Proveedor');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		$this->data = array();
		$this->data['master']=$this->Proveedor->read(null, $id);
		$this->data['details']['Material']=$this->ArticuloProveedor->Find('all', array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN (1)"));
		$this->data['details']['Servicio']=$this->ArticuloProveedor->Find('all', array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN (2)"));
		$this->set('title_for_layout', 'Costos :: '.$this->data['master']['Proveedor']['prcvepro'] );
	}


	public function detailcostomaterial($id = null) {
		$this->layout='empty';
		if($id) {
			$this->data = $this->Proveedor->read(null, $id);
			$this->set('materiales', $this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN(1)")) );
			$this->set('servicios', $this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN(2)")) );
		}
	}

	public function detailcostoservicio($id = null) {
		$this->layout='empty';
		if($id) {
			$this->data = $this->Proveedor->read(null, $id);
			$this->set('materiales', $this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN(1)")) );
			$this->set('servicios', $this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN(2)")) );
		}
	}

	public function addCostoArticulo($proveedor_id=null, $material_id=null) {
		if(!$proveedor_id && isset($this->params['url']['proveedor_id']) ) $proveedor_id=$this->params['url']['proveedor_id'];
		if(!$material_id && isset($this->params['url']['material_id']) ) $material_id=$this->params['url']['material_id'];

		//  If Material or Proveedor doesn't exists
		if(!$proveedor_id || !$material_id) {
			$this->set('result', 'error');
			$this->set('message', __('item_could_not_be_saved', true)." (id: $id)" );
			exit;
		}

		// Get the tipoarticulo_id field
		$tipoarticulo_id=$this->Articulo->field('tipoarticulo_id', array('id' => $material_id));
		if(!$tipoarticulo_id>0) {
			$tipoarticulo_id=$material_id['Articulo']['tipoarticulo_id'];				
		}

		$record=array('ArticuloProveedor'=>array(
							'proveedor_id'=>$id,
							'articulo_id'=>$material_id,
							'costo'=>$this->params['url']['pcosto'],
		));

		// Create the new record
		$this->ArticuloProveedor->create();
		$palabra=($tipoarticulo_id==2?'Servicio': 'Insumo');
		if( $this->ArticuloProveedor->save($record) ) {
			echo "OK Costo de $material_cve guardado para este Proveedor";
			exit;
		}
		else {
 			echo __('item_could_not_be_saved', true)." (id: $material_id)";
			exit;					
		}
		echo "ERROR Indeterminado";
	}

	public function deleteCostoArticulo($id=null) {
		if(!$id && isset($this->params['url']['id']) ) $id=$this->params['url']['id'];

		// Check if the ID was submited and if the specified item exists
		if (!$id || 
			!$master=$this->ArticuloProveedor->findById($id)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Item NO Existe ('.$id.')');
			exit;
		}
		$masterID=$master['ArticuloProveedor']['proveedor_id'];

		// Execute DB Operations
		if ($this->ArticuloProveedor->delete($id)) {
			$this->set('result', 'ok');
			$this->set('details', array(
						'Material'=>$this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$masterID AND Articulo.tipoarticulo_id IN (1)")),
						'Sevicio'=>$this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$masterID AND Articulo.tipoarticulo_id IN (2)"))
						)
			);
		}
		else {
			$this->set('result', 'error');
			$this->set('message', 'El Costo NO se pudo eliminar ('.$id.')');
		}
	}

	public function changeCosto($id=null) {
		$this->autoRender=false;
		if(!$id) {
 			echo __('item_could_not_be_saved', true)." (id: $id)";
			exit;
		} 

		if(isset($this->params['url']['id'])) $id=$this->params['url']['id'];
		if(isset($this->params['url']['costo'])) $costo=abs($this->params['url']['costo']);

		$this->data=$this->ArticuloProveedor->read(null, $id);

		if( $this->ArticuloProveedor->saveField('costo', $costo) ) {
			echo "OK"; //" El costo se actualizo a $costo";
			exit;
		}
		else {
 			echo __('item_could_not_be_saved', true)." (id: $id)";
			exit;					
		}
		echo "ERROR Indeterminado";
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
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Material NO Existe');
			exit();
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
