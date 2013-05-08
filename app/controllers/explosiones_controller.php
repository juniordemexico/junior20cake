<?php

class ExplosionesController extends MasterDetailAppController {
	var $name='Explosiones';

	var $uses = array(
		'Articulo', 'Explosion', 'Explosiondato', 'Color', 'Linea', 'Marca', 'Temporada'
	);

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);

	var $tipoexplosiones = array('Habio', 'Tela', 'Material', 'Servicio');
	
	public function index() {
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

	public function edit( $id = null ) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$this->data=array();
		$this->data['master']=$this->Articulo->findById($id);
		$this->data['master']['Explosiondato']['molde']=$this->Explosiondato->field('molde', array('articulo_id'=>$id));
		$this->data['details']=$this->Explosion->getAllItems($id);
		$this->set('title_for_layout', 'Explosion::'.$this->data['master']['Articulo']['arcveart'] );
	}

	public function add($articulo_id=null) {
		if(	!isset($this->params['url']['articulo_id']) ||
			!isset($this->params['url']['material_id']) ||
			!isset($this->params['url']['cant']) ||
			!isset($this->params['url']['tipoexplosion_id'])
		) {
			$this->set('result', 'error');
			$this->set('message', __('invalid_item', true)." (id: $material_id)" );
			return;
		}
		$articulo_id=$this->params['url']['articulo_id'];
		$material_id=$this->params['url']['material_id'];
		$cant=$this->params['url']['cant'];
		$insumopropio=$this->params['url']['insumopropio'];
		$tipoexplosion_id=$this->params['url']['tipoexplosion_id'];
		$color_id=(isset($this->params['url']['color_id'])?$this->params['url']['color_id']:1);

		$material=$this->Explosion->Material->findById($material_id);
		$tipoarticulo_id=$material['Articulo']['tipoarticulo_id'];
		$linea_id=$material['Articulo']['linea_id'];

		$record=array('Explosion'=>array(
							'articulo_id'=>$articulo_id,
							'material_id'=>$material_id,
							'color_id'=>$color_id,
							'cant'=>$cant,
							'insumopropio'=>$insumopropio,
							'tipoarticulo_id'=>$tipoarticulo_id,
							'tipoexplosion_id'=>$tipoexplosion_id
		));

		$this->Explosion->create();
		if( $this->Explosion->save($record) ) {
			$this->set('result', 'ok');
			$this->set('message', $this->tipoexplosiones[$tipoexplosion_id].' '.
									$material['Articulo']['arcveart'].' se Agregó a la Explosión');
			$this->set('details', $this->Explosion->getAllItems($articulo_id) );
			return;
		}
		$this->set('result', 'error');
		$this->set('message', __('item_could_not_be_saved', true)." (id: $material_id)" );
	}

	public function setCaracteristicas($articulo_id=null) {
		
		if(	!isset($this->params['url']['articulo_id'])
		) {
			$this->set('result', 'error');
			$this->set('message', __('invalid_item', true) );
			return;
		}

		$articulo_id=$this->params['url']['articulo_id'];
		$item=$this->Explosiondato->findByArticulo_id($articulo_id);

		if( isset($this->params['url']['molde']) ) $item['Explosiondato']['molde']=$this->params['url']['molde'];
		if( isset($this->params['url']['datos']) ) $item['Explosiondato']['datos']=$this->params['url']['datos'];

		if( $this->Explosiondato->save($item)) {
			$this->set('result', 'ok');
			$this->set('message', "Las Caracteristicas se guardaron correctamente");
			return;
		}
		$this->set('result', 'error');
		$this->set('message', __('item_could_not_be_saved', true) );
	}
	
	public function deleteItem($id=null) {
		// Check if the ID was submited and if the specified item exists
		$id=$this->params['url']['id'];
		if (
			!$item=$this->Explosion->findById($id)
			) {
			$this->set('result', 'error');
			$this->set('message', __('invalid_item', true)." (id: $id)" );
			return;
		}
		$articulo_id=$item['Explosion']['articulo_id'];

		// Execute DB Operations
		if ($this->Explosion->delete($id)) {
			$this->set('result', 'ok');
			$this->set('message', $this->tipoexplosiones[$item['Explosion']['tipoexplosion_id']].' '.
								' se Eliminó de la Explosión');
			$this->set('details', $this->Explosion->getAllItems($item['Explosion']['articulo_id']) );
			return;
		}
		$this->data['result']='error';
		$this->data['message']=__('item_could_not_be_deleted', true)." (id: ".$item['Explosion']['id'].")";
	}


	public function toggleInsumoPropio($id=null, $newValue=-1) {
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

	public function updateCantidad($id=null, $value=0) {
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

		// Check if Item already exists
		if(
			$this->Explosion->find('first', array('conditions'=>array('articulo_id'=>$articulo_id,
			 														'material_id'=>$item['Articulo']['id'])) )
			) {
			$this->set('result', 'error');
			$this->set('message', "$cve ya existe para este producto");
			return;			
		}

		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);
		$item['ArticuloColor']=$this->Articulo->getArticuloColor($item['Articulo']['id']);

		$this->set('result', 'ok');
		$this->set('item', $item);
	}

}
