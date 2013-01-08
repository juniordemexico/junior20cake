<?php


class InvfisicosController extends MasterDetailAppController {
	var $name='Invfisicos';

	var $uses = array('Invfisico', 'Invfisicodetail', 'Almacen', 'Articulo', 'Color');

	var $cacheAction = array('view',
							);
	var $layout = 'default';


	public function index() {
		$this->Invfisico->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Invfisico.fecha','Invfisico.almacen_id'),
								'fields' => array('Invfisico.id', 'Invfisico.cve',
								 				'Invfisico.fecha', 'Almacen.aldescrip',
								 				'Invfisico.finicio', 'Invfisico.ftermino',
								 				'Invfisico.st', 'Invfisico.modified'),
								'conditions' => array(),
								);
		$filter = $this->Filter->process($this);
		
		$this->set('items', $this->paginate($filter));
	}

	public function conteo($conteo=1) {
		if(!$conteo) {
			$conteo=1;
		}

		$filter = $this->Filter->process($this);
		print_r($filter);
		/*
		$this->set('items', $this->paginate('Invfisicodetail'=>array(
			'conditions'=>$filter);
		);
*/
		$this->set('items', $this->Invfisicodetail->getConteos(1, null) );
	}

	public function delete($id) {
		$this->autoRender=false;

		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Almacen->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}


	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true));
			exit;
		}
		if (!empty($this->data)) {
			if ($this->Almacen->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Almacen->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Almacen->find(array('id'=>$id),array('created','modified'));
				$this->data['Almacen']['created'] = $dates['Almacen']['created'];
				$this->data['Almacen']['modified'] = $dates['Almacen']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Almacen->read(null, $id);
		}

		$this->set('almacenes', $this->Invfisico->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}

	public function add() { 
		if (!empty($this->data)) {
			if ($this->Almacen->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Almacen->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set('almacenes', $this->Invfisico->Almacen->find('list', array('fields' => array('Almacen.id', 'Almacen.aldescrip'))) );

	}

	public function printLabel($cve=null) {
		$this->layout='plain';
		$tmpPath='/home/www/junior20dev/app/files/tmp';
		if(!$cve) {
			$this->Session->setFlash(__('invalid_item', true).' ('.$this->Ubicacion->id.')', 'error');
			die();
		}

		$conditions= array(
				'Articulo.arcveart'=>$cve,
				'Articulo.arst'=>'A',
/*				'Ubicacion.fila ='=>$fila,

				'Ubicacion.espacio >'=>'1000',
				'Ubicacion.espacio <'=>'4999',
				'SUBSTRING(Ubicacion.espacio FROM 3 for 2) <'=>'13',
*/
			);
		
		$options=array(
			'offset'=>0,
//			'limit'=>,
			'order'=>array('Articulo.arcveart'),
			'conditions'=>$conditions,
			);

		$rs=$this->Articulo->find('all', $options);
		$items=array();
		$content='';
		foreach($rs as $item) {
			$lasTallas=array();
			$i=0;
			foreach($rs['Talla'] as $oneTalla) {
				if(!empty($oneTalla)) $lasTallas[]=$i++;
			}
			$items[]=array(	'id'=>$item['Articulo']['id'],
							'cve'=>$item['Articulo']['arcveart'],
							'descrip'=>$item['Articulo']['ardescrip'],
							'color'=>array(),
							'talla'=>$item
							);
			$content.='
N
D14
A025,025,0,4,1,1,N,"2012-12-11 14:30:37"
A450,025,0,4,1,1,N,"Oper: FERNANDO"
A025,75,0,5,1,1,N,"POWEBLACK"
A450,75,0,5,1,1,N,"BLACK"
A025,150,0,5,1,1,N,"TALLA:28"
A450,150,0,5,1,1,N,"CANT:10"
B050,250,0,1,2,3,75,N,"t%p,a%181233,c%'.$item.',t%12"
A050,400,0,4,1,1,N,"MARBETE: 45234652"
A450,400,0,4,1,1,N,"UBICACION: ________"
B050,425,0,1,4,6,150,N,"t=M,id=45234652"
P1
';
		}
		$this->Axfile->StringToFile($tmpPath.'/tmp.articulos.label.'.$cve.'.txt', $content);

		$shellout = shell_exec('/usr/bin/lpr -P Zebra_TLP2844 '.$tmpPath.'/tmp.articulos.label.'.$cve.'.txt');
		$this->set(compact('content', 'items', 'shellout'));
	}

}
