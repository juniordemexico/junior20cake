<?php

class ExplosionesController extends MasterDetailAppController {
	var $name='Explosiones';

	var $uses = array(
		'Articulo', 'Explosion', 'Color', 'Linea', 'Marca', 'Temporada'
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
//		$this->data=$this->Explosion->findByArticuloId($id);
		
		$this->set('articulo', $this->Articulo->read(null,$id) );
		$this->set('explosion', $this->Explosion->getAllItems($id) );
		$this->set('title_for_layout', 'Explosion::'.$this->data['Articulo']['arcveart'] );
	}

	function add($id=null) {
		if(!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));			
		} 

		if (!empty($this->data)) {
			if ($this->Explosion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

	}

	function delete($id=null) {
		$this->autoRender=false;
		
		// Check if the ID was submited and if the specified item exists
		if (!$id && 
			isset($this->params['url']['id']) && !($id=$this->params['url']['id']) &&
			!$this->Explosion->read(null, $id)) {
			echo __('invalid_item', true).($id?" (id: $id)":'');			
			exit;
		}

		// Execute DB Operations
		if ($this->Explosion->delete($id)) {
			echo "OK";
		}
		else {
 			echo __('item_could_not_be_deleted', true)." (id: $id)";
		}
	}

	function toggleInsumoPropio($id=null, $newValue=-1) {
		$this->autoRender=false;

		// Check if the ID was submited and if the specified item exists
		if (!$id) {
			if(isset($this->params['named']['id'])) {
				$id=$this->params['named']['id'];
			}
			elseif( isset($this->params['url']['id']) ) {
				$id=$this->params['url']['id'];
			}
			else {
				echo __('invalid_item', true).($id?" (id: $id)":'');			
				exit;
			}
		}
		$this->data=$this->Explosion->read(null, $id);
		if (!($this->Explosion->id>0) ) {
				echo __('invalid_item', true).($id?" (id: $id)":'');			
				exit;			
		}

		// Determine field's new value
		if($newValue==-1 && isset($this->Explosion->insumopropio)) {
			$newValue=((int)$this->Explosion->insumopropio)*-1;
		}
		elseif($newValue>0 || $newValue=='on' || $newValue=='checked' || $newValue=='true' || $newValue==true) {
			$newValue=1;
		}
		else {
			$newValue=0;
		}

		// Execute DB Operations
		if ($this->Explosion->saveField('insumopropio', $newValue) ) {
			echo "OK";
		}
		else {
			echo __('item_could_not_be_updated', true)." (id: $id)";				
		}

	}

}
