<?php

App::import('Component', 'Barcode');

class BarcodesController extends MasterDetailAppController {
	var $name='Barcodes';

	var $uses = array(
		'Articulo','Barcode','Barcodeserie','Articulobarcode','Color','Talla','Linea','Marca'
	);

	var $cacheAction = array(
							);

	function edit($articulo_id = null) {
		if (!$articulo_id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true));
			exit;
		}
		if (!empty($this->data)) {
			if ($this->Barcode->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Articulo->find(array('id'=>$id), array('created','modified'));
				$this->data['Barcode']['created'] = $dates['Barcode']['created'];
				$this->data['Barcode']['modified'] = $dates['Barcode']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->Barcode->recursive=0;
			$this->Articulo->recursive=-1;
			$this->Articulobarcode->recursive=0;
			$this->data = $this->Articulo->read(null, $articulo_id);
		//	$barcodes=$this->Barcode->getBarcodes($articulo_id);
		
			$this->set('barcodes', $this->Articulobarcode->getBarcodes($articulo_id));
		}

		$barcodeseries = $this->Barcode->Barcodeserie->find('list', array('fields' => array('Barcodeserie.id', 'Barcodeserie.cve')));
		$this->set(compact('barcodeseries'));

	}

	function index() {
		$this->Articulo->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Articulo.arlinea' => 'asc','Articulo.arcveart' => 'asc'),
								'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
												'Articulo.artipo','Articulo.arst','Articulo.art',
												'Tipoarticulo.cve',
												'Marca.macve','Linea.licve','Temporada.tecve','Unidad.cve'),
								'conditions' => array('Articulo.artipo'=>'0', 'Articulo.arst'=>'A'),
								);
		$filter = $this->Filter->process($this);
		$this->set('articulos', $this->paginate($filter));
	}


	function tallacolor($id=null) {
		$this->layout = 'empty';
		$thecontroller='tallacolor';
		if(!$id) {
				$this->Session->setFlash(__('invalid_item', true));
		}
		Configure::write ( 'debug', 2 );
		$this->Articulo->recursive=0;
		$result = $this->Articulo->read(null, $id);
		
		$this->set('result',$result);
		$this->set('thecontroller', $this->params['named']['control']);
		$this->set('theaction', $this->params['named']['action']);
		if(isset($this->params['named']['iseditable']))
			$this->set('isEditable', 'true');
		else
			$this->set('isEditable', 'false');
		
		if(isset($this->params['named']['master_id']))
			$this->set('master_id', $this->params['named']['master_id']);
		if(isset($this->params['named']['child_id']))
			$this->set('child_id', $this->params['named']['child_id']);
		elseif(isset($id))
			$this->set('child_id', $id);
	}


	function tallacolorexistenciadata($id=null) {
		$this->layout = 'empty';
		if(!$id) {
				$this->Session->setFlash(__('invalid_item', true),'default');
		}
		Configure::write ( 'debug', 0 );
		
  		$result = $this->Articulo->query("SELECT Articulo.id id,
												 Artmov.amcolor color_cve,
												 SUM(amT0) t0,SUM(amT1) t1,SUM(amT2) t2,SUM(amT3) t3,
												 SUM(amT4) t4,SUM(amT5) t5,SUM(amT6) t6,SUM(amT7) t7,
												 SUM(amT8) t8,SUM(amT9) t9
												FROM articulo Articulo
												JOIN ArtMov Artmov on Artmov.amCveArt=Articulo.arcveart
										        WHERE Articulo.id=$id
												GROUP BY Articulo.id, Artmov.amcolor
											    ORDER BY Artmov.amcolor");
		$this->set('result', $result);
	}

	// Captura de codigos de barra
	function barcodes($id=null) {
		if(empty($this->data)) {
			if(isset($id) && $id>0) {
				$this->data = $this->Articulo->read(null, $id);

			}
			else {
				$this->Session->setFlash(__('invalid_item', true), 'error');								
			}
		} 
		else {
			// Save the Item's Barcode
			//$this->Pedido->saveField('pefauto', $theDate)
		}

	}



}

?>