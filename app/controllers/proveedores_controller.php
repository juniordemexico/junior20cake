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
		$this->data['details']['Material']=$this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN (1)"));
		$this->data['details']['Servicio']=$this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$id AND Articulo.tipoarticulo_id IN (2)"));
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

	public function addCostoArticulo($id=null) {
		$this->autoRender=false;
		if(!$id) {
 			echo __('item_could_not_be_saved', true)." (id: $id)";
			exit;
		} 

		if(isset($this->params['named']['cve'])) $material_cve=strtoupper($this->params['named']['cve']);
		$material_id=$this->Articulo->findByArcveart($material_cve);
		if($material_id && isset($material_id['Articulo']['id'])) {
			$material_id=$material_id['Articulo']['id'];
			$tipoarticulo_id=$material_id['Articulo']['tipoarticulo_id'];				
		}
		else {
			echo "NO se encontro $material_cve";
			exit;
		}

		$pcosto=abs($this->params['named']['pcosto']);

		$record=array('ArticuloProveedor'=>array(
							'proveedor_id'=>$id,
							'articulo_id'=>$material_id,
							'costo'=>$pcosto,
		));
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
		$this->layout='json';
		$this->autoRender=false;
		$this->data=array();
		
		// Check if the ID was submited and if the specified item exists
		if (!$id || 
			!$this->ArticuloProveedor->read(null, $id)
			) {
			$this->data['result']='error';
			$this->data['message']='Ese Item NO Existe ('.$id.')';
			echo json_encode($this->data);
			exit();
		}
		$masterID=$this->ArticuloProveedor['proveedor_id'];

		// Execute DB Operations
		if ($this->ArticuloProveedor->delete($id)) {
			$this->data['details']['Material']=$this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$masterID AND Articulo.tipoarticulo_id IN (1)"));
			$this->data['details']['Servicio']=$this->ArticuloProveedor->Find('all',array('conditions'=>"Articuloproveedor.proveedor_id=$masterID AND Articulo.tipoarticulo_id IN (2)"));
		}
		else {
			$this->data['result']='error';
			$this->data['message']='Ese Item NO Existe ('.$id.')';
		}
		echo json_encode($this->data);
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
		$this->layout='json';
		$this->autoRender=false;
		$this->data=array();
 		Configure::write ( 'debug', 0 );

		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)) {
			$this->data['result']='error';
			$this->data['message']='Ese Material NO Existe ('.$cve.')';
			echo json_encode($this->data);
			exit();				
		}

		if($item['Articulo']['tipoarticulo_id']==2) $palabra='Servicio'; else $palabra='Material';
		
		$this->data['result']='ok';
		$this->data['message']=$palabra.' ('.$cve.')';
		$this->data['item']=array();
		$this->data['item']=$item;
		$this->data['item']['Articulo']['arcveart']=trim($this->data['item']['Articulo']['arcveart']);
		echo json_encode($this->data);
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

?>