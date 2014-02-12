<?php

class ServiciosController extends MasterDetailAppController {
	var $name='Servicios';

	var $uses = array(
		 'Articulo', 'Color', 'Linea', 'Marca', 'Familia', 'ArticulosColor'
	);

	var $cacheAction = array('view');
							
	var $tipoarticulo_id = 2;
	
	public function beforeFilter() {
		$this->Articulo->tipoarticulo=$this->tipoarticulo_id;

		if(isset($this->data['Articulo'])) {
			$this->data['Articulo']['tipoarticulo_id']=$this->tipoarticulo_id;
			if(isset($this->data['Articulo']['arcveart'])) {
				$this->data['Articulo']['arcveart']=strtoupper(trim($this->data['Articulo']['arcveart']));
			}
			// Forzamos el Sevicio al Color Unico

			if( ($this->action=='add' || $this->action=='edit') &&
				(!isset($this->data['Color']) || !is_array($this->data['Color']) ) ) {
				$this->data['Color']=array(1);
			}
		}		
		parent::beforeFilter();
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true));
				$this->redirect(array('action' => 'index'));
		}
		$this->set('articulo', $this->Articulo->read(null, $id));
	}

	function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			exit;
		}
		if (!empty($this->data)) {
			if ($this->Articulo->save($this->data)) {
//				$this->Axnotification->sendNotification(array('title'=>'Modificacion de producto',
//				array('subject'=>'Modificacion Articulo: '.$this->Articulo->arcveart), 'Este es el contenido chido chdo' ) );
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Articulo->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} 
			else {
			//	$dates = $this->Articulo->find(array('Articulo.id'=>$id),array('Articulo.created','Articulo.modified','Color.id','Color.cve'));
				$dates=$this->Articulo->findById($id);
				$this->data['Color']=$dates['Color'];
				$this->data['Articulo']['created'] = $dates['Articulo']['created'];
				$this->data['Articulo']['modified'] = $dates['Articulo']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Articulo->read(null, $id);
			$this->set('title_for_layout', $this->name.'::'.$this->data['Articulo']['arcveart']);
		}

		$this->set( $this->Articulo->loadDependencies($this->tipoarticulo_id) );
	}

	public function add() { 
		if (!empty($this->data)) {
			$this->data['Articulo']['arcveart']=strtoupper($this->data['Articulo']['arcveart']);
			$this->Articulo->create();
			if (
				$this->Articulo->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Articulo->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}

		$this->set( $this->Articulo->loadDependencies($this->tipoarticulo_id) );
	}


	public function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
 		if ($this->Articulo->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
		$this->redirect(array('action' => 'index'));
	}

	function archivos($id = null) {
		$this->set('listAction', 'archivos');
		$this->set('clickAction', 'archivos');
		if (!$id) {
			$this->autoRender=false;
			$this->paginate = array(
									'update' => '#content',
									'evalScripts' => true,
									'limit' => PAGE_ROWS,
									'order' => array('Linea.licve', 'Articulo.arcveart'),
									'fields' => array('Articulo.id','Articulo.arcveart','Articulo.ardescrip',
													'Articulo.tipoarticulo_id','Articulo.arst','Articulo.art',
													'Tipoarticulo.cve',
													'Marca.macve','Linea.licve','Unidad.cve'),
									'conditions' => array('Articulo.tipoarticulo_id'=>$this->tipoarticulo_id),
									);
			$filter = $this->Filter->process($this);
			$this->set('articulos', $this->paginate($filter));
			$this->render('index');
		}
		$this->data = $this->Articulo->read(null, $id);
	}


	public function details($id=null) {
		$this->data = $this->Articulo->read(null, $id);
    	echo json_encode($this->data);
    	exit;		
	}


	/* Text Field Autocomplete action */
	public function autoComplete() {
 		Configure::write ( 'debug', 0 );
		$this->autoRender=false;
  		$this->layout = 'ajax';

		/* Validate and Format the search term */
		$term=strtoupper(substr(trim($this->params['url']['term']),0,32));

		/* Configure and Execute the Query */
		$this->Articulo->recursive=0;
  		$articulos = $this->Articulo->find('all', array(
			'fields'=>array('Articulo.id', 'Articulo.arcveart', 'Articulo.ardescrip',
							'Articulo.arlinea', 'Articulo.armarca'),
			'order'=>'Articulo.arcveart ASC',
			'limit'=>32,
			'conditions' => array(
   					'OR' => array(
/*    					'Articulo.id'=>(is_numeric($term)?$term:0),*/
    					'Articulo.arcveart LIKE'=>$term.'%',
    					'Articulo.ardescrip LIKE'=>'%'.$term.'%'
   						),
					'Articulo.arst'=>'A',
					'Articulo.tipoarticulo_id'=>$this->tipoarticulo_id
  					)
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($articulos as $articulo) {
   			$response[$i]['id']=$articulo['Articulo']['id'];
   			$response[$i]['value']=trim($articulo['Articulo']['arcveart']);
   			$response[$i]['label']='('.trim($articulo['Articulo']['arcveart']) . ') ' . $articulo['Articulo']['ardescrip'] . ' (' . $articulo['Articulo']['arlinea'].')';
   			$i++;
  		}
		/* Send the response in json format */
  		echo json_encode($response);
	}

	public function tallacolor($id=null) {
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


	public function tallacolorexistenciadata($id=null) {
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

}

