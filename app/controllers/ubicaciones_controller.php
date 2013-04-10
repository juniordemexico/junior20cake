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
			if ($this->Ubicacion->save($this->data, array('validate'=>false))) {
				$this->Session->write($this->name+$this->action);
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
		$tmpPath='/home/www/junior20cake/app/webroot/files/tmp';
		if(!$zona) {
			$this->Session->setFlash(__('invalid_item', true).' ('.$this->Ubicacion->id.')', 'error');
			$this->redirect(array('action' => 'index'));			
		}

		$conditions= array(
			'Ubicacion.zona'=>$zona,
			'Ubicacion.fila'=>$fila,
			'Ubicacion.espacio'=>$espacio,
		);
		
		$options=array(
			'offset'=>0,
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
			$content.='
N
D14
A225,5,0,5,1,1,N,"'.$item['Ubicacion']['cve'].'"
B225,65,0,1,2,10,75,N,"t%u,id%'.$item['Ubicacion']['id'].'"
P4
';
		}
		$this->Axfile->StringToFile($tmpPath.'/tmp.ubicaciones.label.'.$zona.$fila.'-'.$espacio.'.txt', $content);

		$shellout = shell_exec('/usr/bin/lpr -P barcodes-viaducto01 '.$tmpPath.'/tmp.ubicaciones.label.'.$zona.$fila.'-'.$espacio.'.txt');
		$this->set(compact('content', 'items', 'shellout'));
	}

}


/*

N
D14
A025,025,0,4,1,1,N,"2012-12-11 14:30:37"
A450,025,0,4,1,1,N,"Oper: FERNANDO"
A025,75,0,5,1,1,N,"POWEBLACK"
A450,75,0,5,1,1,N,"BLACK"
A025,150,0,5,1,1,N,"TALLA:28"
A450,150,0,5,1,1,N,"CANT:10"
B050,250,0,1,2,3,75,N,"t=p,a=181233,c=123123,t=28"
A050,400,0,4,1,1,N,"MARBETE: 45234652"
A450,400,0,4,1,1,N,"UBICACION: A09-0087"
B050,425,0,1,4,6,150,N,"t=M,id=45234652"
P1

*/