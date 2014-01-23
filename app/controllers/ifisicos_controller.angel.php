<?php

class IfisicosController extends MasterDetailAppController {
	var $name='Ifisicos';

	var $uses = array(
		 'Ifisico', 'Articulo', 'Color', 'Linea', 'Talla'
	);

	var $tipoarticulo_id = 0;

	var $paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 25,
								'order' => array('Articulo.arcveart', 'Color.cve'),
								'fields' => array('Ifisico.id', 'Articulo.id', 'Articulo.arcveart', 'Articulo.ardescrip',
												'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
												'Articulo.lento',
												'Articulo.arlinea',
												'Color.cve', 'Color.id',
												'Ifisico.articulo_id',
												'Ifisico.existencia', 'Ifisico.cant_1', 'Ifisico.cant_2',
												'Ifisico.t0_1', 'Ifisico.t1_1', 'Ifisico.t2_1', 'Ifisico.t3_1', 'Ifisico.t4_1',
												'Ifisico.t5_1', 'Ifisico.t6_1', 'Ifisico.t7_1', 'Ifisico.t8_1', 'Ifisico.t9_1',
												'Ifisico.t0_2', 'Ifisico.t1_2', 'Ifisico.t2_2', 'Ifisico.t3_2', 'Ifisico.t4_2',
												'Ifisico.t5_2', 'Ifisico.t6_2', 'Ifisico.t7_2', 'Ifisico.t8_2', 'Ifisico.t9_2',
												'Ifisico.created', 'Ifisico.modified',
												'Ifisico.created_user_id', 'Ifisico.modified_user_id'
												),
								'conditions' => array('Articulo.tipoarticulo_id'=>0),
								);

	function index() {
		$this->Ifisico->recursive=2;
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
		$this->set('totales', $this->Ifisico->totales());
		$this->render('index');
	}

	function edit($id = null) {
		$this->Articulo->recursive=2;
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action'=>'index'));
		}

		if (!empty($this->data)) {
			if(isset($this->data['Ifisico'])) {
				$this->data['Ifisico']['cant_1']=0;
				$this->data['Ifisico']['cant_2']=0;
				for($i=9; $i>=0; $i--) {
					$this->data['Ifisico']['cant_1']+=isset($this->data['Ifisico']['t'.$i.'_1'])?(int)$this->data['Ifisico']['t'.$i.'_1']:0;
					$this->data['Ifisico']['cant_2']+=isset($this->data['Ifisico']['t'.$i.'_2'])?(int)$this->data['Ifisico']['t'.$i.'_2']:0;
				}
				$this->data['Ifisico']['modified_user_id']=$this->Auth->User('id');
			}
			if ( $this->Ifisico->save($this->data) ) {
				$this->Session->setFlash(__('item_has_been_saved', true).'. Clave: '.$this->data['Articulo']['arcveart'].'. Color: '.$this->data['Color']['cve'].'.', 
				'success');
				$this->redirect(array('action' => 'index'));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->Ifisico->read(null, $id);
			$this->data['Articulo']['arcveart']=trim($this->data['Articulo']['arcveart']);
			$this->set('title_for_layout', $this->name.'::'.$this->data['Articulo']['arcveart']);
		}

	}

	public function imprime() {
		$this->Ifisico->recursive=0;
		$items = $this->Ifisico->find('all', array('order' => array('Articulo.arcveart ASC', 'Color.cve ASC',),  
													'conditions' => array('Ifisico.existencia !='=>0, 'Ifisico.cant_2 !='=>0),
													));
//		print_r($items);
//		die();
		$this->layout='print';
		$this->set('result', 'ok' );
		$this->set('items', $items);
//		$this->set('totales', $this->Ifisico->totales());
		$this->set('title_for_layout', 'REPORTE DE INVENTARIO FISICO');
	}

/*
	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		$this->Articulo->read($id);
		// SET todas las tallas en cero
		// y luego hacer el Articulo->save( hash of tallas, false, array(fields to update) )
		if ( $this->Articulo->save(
							array('t0_1'=>0, 't1_1'=>0, 't2_1'=>0, 't3_1'=>0, 't4_1'=>0,
									't5_1'=>0, 't6_1'=>0, 't7_1'=>0, 't8_1'=>0, 't9_1'=>0,
									'cant_1'=>0
								),
							false,
							array('t0_1', 't1_1', 't2_1', 't3_1', 't4_1', 
									't5_1', 't6_1', 't7_1', 't8_1', 't9_1',
									'cant_1')
								) 
								) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));

	}
*/
}