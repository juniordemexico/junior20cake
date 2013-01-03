<?php

class UbicacionesController extends MasterDetailAppController {
	var $name='Ubicaciones';

	var $uses = array('Ubicacion', 'Almacen');

	var $cacheAction = array('view',
							);
	var $layout = 'default';

	function beforeFilter() {
		parent::beforeFilter();
		if( isset($this->data) && isset($this->data['Ubicacion']) ) {
			$this->data['Ubicacion']['cve']=$this->data['Ubicacion']['zona'].
											$this->data['Ubicacion']['fila'].
											$this->data['Ubicacion']['espacio'];
		}
	}

	function index() {
		$this->Ubicacion->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Almacen.alcve','Ubicacion.cve'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('items', $this->paginate($filter));
	}


	function delete($id) {
		$this->autoRender=false;

		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Ubicacion->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true));
			exit;
		}
		if (!empty($this->data)) {
			if ($this->Ubicacion->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Ubicacion->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ubicacion->read(null, $id);
		}

		$this->set('almacenes', $this->Ubicacion->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}

	function add() { 
		if (!empty($this->data)) {
			pr($this->data);
//			$this->Ubicacion->create($this->data);
			if ($this->Ubicacion->save($this->data, array('validate'=>false))) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Ubicacion->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set('almacenes', $this->Ubicacion->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}
	
	public function printLabel($zona=null, $fila=null, $espacio=null) {
		$this->layout='plain';
		$tmpPath='/home/www/junior20dev/app/files/tmp';
		if(!$zona) {
			$this->Session->setFlash(__('invalid_item', true).' ('.$this->Ubicacion->id.')', 'error');
			$this->redirect(array('action' => 'index'));			
		}

		$conditions= array(
				'Ubicacion.zona'=>$zona,
/*				'Ubicacion.fila ='=>$fila,

				'Ubicacion.espacio >'=>'1000',
				'Ubicacion.espacio <'=>'4999',
				'SUBSTRING(Ubicacion.espacio FROM 3 for 2) <'=>'13',
*/
			);
		
		$options=array(
			'offset'=>0,
			'limit'=>433,
			'order'=>array('Ubicacion.cve'),
			'conditions'=>$conditions,
			);

		$rs=$this->Ubicacion->find('all', $options);
		$items=array();
		$content='';
		foreach($rs as $item) {
			$items[]=array(	'id'=>$item['Ubicacion']['id'],
							'cve'=>$item['Ubicacion']['cve'],
							'descrip'=>$item['Ubicacion']['descrip'],
							);
$t%U,id%17778905				$content.='
N
D14
A225,5,0,5,1,1,N,"'.$item['Ubicacion']['cve'].'"
B225,65,0,1,2,10,75,N,"t%u,id%'.$item['Ubicacion']['id'].'"
P4
';
		}
		$this->Axfile->StringToFile($tmpPath.'/tmp.ubicaciones.label.'.$zona.$fila.'.txt', $content);

		$shellout = shell_exec('/usr/bin/lpr -P Zebra_TLP2844 '.$tmpPath.'/tmp.ubicaciones.label.'.$zona.$fila.'.txt');
		$this->set(compact('content', 'items', 'shellout'));
	}

}
