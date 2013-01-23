<?php


class CosteosController extends MasterDetailAppController {
	var $name='Costeos';

	var $uses = array(
		'Articulo', 'Explosion', 'ArticuloProveedor', 'Linea', 'Marca', 'Temporada'
	);

	var $layout = 'ajaxclean';
	
	var $cacheAction = array('view'
							);

	function index() {
		$this->layout='default';

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

	function add($id=null) {
		if(!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));			
		} 
		
		if (!empty($this->data)) {
			if ($this->Costeo->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

	function delete($id=null) {
		$this->autoRender=false;
		if (!$id) {
			echo json_encode(array('result'=>'error', 'message'=>echo __('invalid_item', true));
			exit;
		}
		if ($this->Costeo->delete($id)) {
			$out=array(result=>'ok','message'=>'');
		}
		else {
			$out=array(result=>'error','message'=>'El Item NO pudo ser Eliminado');
		}
		echo json_encode($out);
	}

	public function getItem($id=null) {
		$this->autoRender();

		$out=array('result'=>'','message'=>__('invalid_item', false));
		
		if( !$id || !($id>0) ) {
			echo json_encode($out);
			return false;
		}
		
		$master=$this->Articulo->findById($id);
		$details=$this->Articulo->Explosiones->findByArticulo_id($id);

		if($master && is_array($master) && count($master)>0 &&
			$details && is_array($details) && count($details)>0
			) {
			$out=array(
				'master'=>array(
					'id'=>$master['Articulo']['id'],
					'arcveart'=>$master['Articulo']['arcveart'],
					'ardescrip'=>$master['Articulo']['ardescrip'],
					'arst'=>$master['Articulo']['arst'],
					'id'=>$master['Articulo']['id'],
					),
				'details'=>array(
					),
				);
			foreach($details as $detail) {
//				$out['']
			}
		}
		elseif(!$master || !is_array($master) || !(count($master)>0) ) {
			$out=array('result'=>'error','message'=>'Producto Inválido');
		}
		elseif(!$details || !is_array($details) || !(count($details)>0) ) {
			$out=array('result'=>'error','message'=>'El Producto NO tiene registrada una Explosión');
		}	

		echo json_encode($out);
	}
	
}
