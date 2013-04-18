<?php


class CosteosController extends MasterDetailAppController {
	var $name='Costeos';

	var $uses = array(
		'Articulo', 'Explosion', 'ArticuloProveedor', 'Linea', 'Marca', 'Temporada', 'Proveedor'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);

	function beforeFilter() {

		if(isset($this->data['Costeos'])) {
			$this->data['Articulo']=$this->data['Costeos'];
			unset($this->data['Costeos']);
		}

		parent::beforeFilter();
	}

	function index() {
		$this->paginate = array('update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Articulo.arcveart' => 'asc'),
								'fields' => array('Articulo.id', 'Articulo.arcveart', 'Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
												'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve', 
												'Explosion.modified'),
								'conditions' => array('Articulo.tipoarticulo_id'=>'0', 'Articulo.arst'=>'A'),
								'joins' => array(
										array(	'table'=>'(SELECT articulo_id, COALESCE(MAX(modified), MAX(created)) Modified FROM Explosiones GROUP BY articulo_id) ',
												'alias'=>'Explosion',
												'type'=> 'inner',
												'conditions'=>array(
													'Explosion.articulo_id=Articulo.id'
											)
										),
									)
								);
		$filter = $this->Filter->process($this);
		$this->set('articulos', $this->paginate($filter));
	}

	function edit( $id = null ) {
		$this->layout='default';
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
 		Configure::write ( 'debug', 0 );
		$this->data=array();
		$this->data['master']=$this->Articulo->findById($id);
		$this->data['details']=$this->Explosion->getAllItemsWithAllCosts($id);
		$this->set('title_for_layout', 'Costeos::'.$this->data['master']['Articulo']['arcveart'] );
	}

	function setcosto($id=null) {
		$this->layout='json';
		if(!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));			
		} 
		Configure::write ( 'debug', 0 );

		$theData=$this->params['url'];
		unset($theData['url']);
		$explosion_id=$theData['explosion_id'];
		$proveedor_id=$theData['proveedor_id'];

		$explosion=$this->Explosion->read(null, $explosion_id);
		$proveedor=$this->Proveedor->findById($proveedor_id);

		if($this->Explosion->saveField('proveedor_id', $proveedor_id)) {
			$this->data=array();
			$this->data['result']='ok';
			$this->data['message']='El Material '.$explosion['Articulo']['arcveart'].
									' cambio al Proveedor ('.$proveedor['Proveedor']['prcvepro'].') '.
									$proveedor['Proveedor']['prnom'];
			$this->data['data']=array();
			$this->data['data']['master']=$this->Articulo->findById($id);
			$this->data['data']['details']=$this->Explosion->getAllItemsWithAllCosts($id);
		}
		else {
			$this->data['result']='error';
			$this->data['message']='Error Guardando Material '.$explosion['Articulo']['arcveart'].
									' para el Proveedor  ('.$proveedor['Proveedor']['prcvepro'].') '.
									$proveedor['Proveedor']['prnom'];
		}
	}

	public function getItem($id=null) {
		$this->layout='json';
		$this->data=array();
		$this->data['master']=$this->Articulo->findById($id);
		$this->data['details']=$this->Explosion->getAllItemsWithAllCosts($id);
		$this->set('title_for_layout', 'Costeos::'.$this->data['master']['Articulo']['arcveart'] );

		echo json_encode($out);
	}
	
}
