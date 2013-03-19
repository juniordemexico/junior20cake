<?php

class ExplosionesController extends MasterDetailAppController {
	var $name='Explosiones';

	var $uses = array(
		'Articulo', 'Explosion', 'Color', 'Linea', 'Marca', 'Temporada'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);

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
										array(	'table' => '(SELECT articulo_id, COALESCE(MAX(modified), MAX(created)) Modified FROM Explosiones GROUP BY articulo_id) ',
												'alias' => 'Explosion',
												'type' => 'LEFT',
												'conditions' => array(
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
		$this->data['details']=$this->Explosion->getAllItems($id);
		$this->set('title_for_layout', 'Explosion::'.$this->data['master']['Articulo']['arcveart'] );

	}

	function add($id=null) {
		$this->autoRender=false;
		$this->data=array();
		if (!$id) {
			$this->data['result']='error';
			$this->data['message']=__('invalid_item', true)." (id: $id)";
			echo json_encode($this->data);
			die();
		}
		if(!isset($this->params['named']['cve']) ||
			!isset($this->params['named']['cant']) ||
			!isset($this->params['named']['tipoexplosionid'])
		) {
			$this->data['result']='error';
			$this->data['message']="Faltan Datos";
			echo json_encode($this->data);
			die();
		}
		$material_cve=strtoupper($this->params['named']['cve']);
		$material=$this->Explosion->Material->findByArcveart($material_cve);
		if(!$material || !isset($material['Articulo']['id'])) {
			$this->data['result']='error';
			$this->data['message']="NO se encontro $material_cve de tipo $tipoexplosionid";
			echo json_encode($this->data);
			die();
		}
		else {
			$material_id=$material['Articulo']['id'];
			$tipoarticulo_id=$material['Articulo']['tipoarticulo_id'];	
		}

		$color_id=isset($this->params['named']['color_id'])?$this->params['named']['color_id']:1;
		$cant=$this->params['named']['cant'];
		$insumopropio=isset($this->params['named']['insumopropio'])?$this->params['named']['insumopropio']:0;
		$tipoexplosionid=isset($this->params['named']['tipoexplosionid'])?$this->params['named']['tipoexplosionid']:1;

		$record=array('Explosion'=>array(
							'articulo_id'=>$id,
							'material_id'=>$material_id,
							'color_id'=>$color_id,
							'cant'=>$cant,
							'insumopropio'=>$insumopropio,
							'tipoarticulo_id'=>$tipoexplosionid
		));
			
		$this->Explosion->create();
		$palabra=($tipoexplosionid==2?'Servicio': 'Insumo');
		if( $this->Explosion->save($record) ) {
			$this->data['result']='ok';
			$this->data['message']='El '.$palabra.' '.$material['Articulo']['arcveart'].
									' se Agregó';
			$this->data['details']=$this->Explosion->getAllItems($id);
		}
		else {
			$this->data['result']='ok';
			$this->data['message']=__('item_could_not_be_saved', true)." (id: $material_cve)";
		}
		echo json_encode($this->data);
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
			die();				
		}
		$this->data['result']='ok';
		$this->data['message']='Material ('.$cve.')';
		$this->data['item']=array();
		$this->data['item']=$item;
		$this->data['item']['Articulo']['arcveart']=trim($this->data['item']['Articulo']['arcveart']);
		$this->data['item']['ArticuloColor']=$this->Articulo->getArticuloColor($this->data['item']['Articulo']['id']);
		echo json_encode($this->data);
	}

/*
	public function getDetail($id=null, $type=null) {
		if($id) {
			$rs=$this->Explosion->getAllItems($id);
			$this->set('response', $this->Explosion->getAllItems($id) );			
			$this->set('articulo', $this->Articulo->read(null,$id) );
		}
	}
*/

	public function deleteItem($id=null) {
		$this->autoRender=false;
		$this->data=array();
		
		// Check if the ID was submited and if the specified item exists
		if (!$id || 
			!$item=$this->Explosion->findById($id)) {
			$this->data['result']='error';
			$this->data['message']='Item Inválido ('.$id.')';
			echo json_encode($this->data);
			die();
		}
		
		// Execute DB Operations
		if ($this->Explosion->delete($id)) {
			$this->data['result']='ok';
			$this->data['message']='El Material '.$item['Articulo']['arcveart'].
									' se elimino de la Explosión del Producto';
			$this->data['details']=$this->Explosion->getAllItems($item['Explosion']['articulo_id']);
		}
		else {
			$this->data['result']='error';
			$this->data['message']='El Material '.$item['Explosion']['id'].
									' NO se puedo eliminar ';
		}
		echo json_encode($this->data);
	}

	function toggleInsumoPropio($id=null, $newValue=-1) {
		$this->autoRender=false;
		$this->data=array();

		// Check if the ID was submited and if the specified item exists
		if (!$id) {
			$this->data['result']='error';
			$this->data['message']='Item Inválido ('.$id.')';
			echo json_encode($this->data);
			die();
		}

		// Check if the ID was submited and if the specified item exists
		if (!$id || 
			!$item=$this->Explosion->read(null, $id)) {
			$this->data['result']='error';
			$this->data['message']='Item Inválido ('.$id.')';
			echo json_encode($this->data);
			die();
		}

		// Determine field's new value
		if($newValue==-1 && isset($item['Explosion']['insumopropio'])) {
			$newValue=(int)$item['Explosion']['insumopropio']==1?0:1;
		}
		elseif($newValue>0 || $newValue=='on' || $newValue=='checked' || $newValue=='true' || $newValue==true) {
			$newValue=1;
		}
		else {
			$newValue=0;
		}
		$this->data=array();
		// Execute DB Operations
		if ($this->Explosion->saveField('insumopropio', $newValue) ) {
			$this->data['result']='ok';
			$this->data['message']='El Material '.$item['Articulo']['arcveart'].
									' se actualizo correctamente.';
			$this->data['details']=$this->Explosion->getAllItems($item['Explosion']['articulo_id']);
		}
		else {
			$this->data['result']='error';
			$this->data['message']='El Material '.$this->Explosion->id.
									' NO se puedo actualizar ';
		}
		echo json_encode($this->data);		
	}

	function updateCantidad($id=null, $value=0) {
		$this->autoRender=false;
		$this->data=array();

		// Check if the ID was submited and if the specified item exists
		if (!$id || 
			!$item=$this->Explosion->read(null, $id)) {
			$this->data['result']='error';
			$this->data['message']='Item Inválido ('.$id.', '.$value.')';
			echo json_encode($this->data);
			die();
		}

		$this->data=$this->Explosion->read(null, $id);

/*
		if( isset($this->params['url']['value']) && $this->params['url']['value']>0) {
			$value=$this->params['url']['value'];
		}
		else {
			return( e(json_encode(array('result'=>'error', 'mesage'=>__('invalid_item', true)))) );
		}
*/		
		if (!$value || $value<0) {
			if( isset($this->params['url']['value']) ) {
				$value=$this->params['url']['value'];
			}
			else {
				echo __('invalid_item', true).($id?" (id: $id)":'');			
				exit;
			}
		}

		// Execute DB Operations
		if ($this->Explosion->saveField('cant', $value) ) {
			$this->data['result']='ok';
			$this->data['message']='El Material '.$item['Articulo']['arcveart'].
									' se actualizo correctamente.';
			$this->data['details']=$this->Explosion->getAllItems($item['Explosion']['articulo_id']);
		}
		else {
			$this->data['result']='error';
			$this->data['message']='El Material '.$id.
									' NO se pudo actualizar al costo '.$value;
		}
		echo json_encode($this->data);
	}

}
