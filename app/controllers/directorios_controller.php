<?php


class DirectoriosController extends MasterDetailAppController {
	var $name='Directorios';

	var $uses = array(
		'Directorio', 'Pais', 'Estado', 'Vendedor'
	);

	var $cacheAction = array('view'
							);

	var $layout='plain';
	
	function index() {
		$conditions=array();
		$this->paginate = array('update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Directorio.tipopersona_cve' => 'asc' ,'Directorio.nom' => 'asc'),
								'conditions' => $conditions,
								'session' => $this->Auth->User()
								);
		$filter = $this->Filter->process($this);
		$this->set('directorios', $this->paginate($filter));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		$this->set('directorio', $this->Directorio->read(null, $id));
	}


	function details($id) {
		$this->data = $this->Directorio->read(null, $id);
    	echo json_encode($this->data);
    	exit;		
	}

	function getInfo($clcvecli='') {
		$this->autoRender=false;
		$this->layout='ajax';
		$data=$this->Directorio->find('first', array('conditions'=>array('clcvecli'=>$clcvecli),
		 						'fields'=>array('Directorio.id', 'Directorio.clcvecli', 'Directorio.cltda', 
												'Directorio.clnom', 'Directorio.clsuc', 'Directorio.clcveven', 
												'Directorio.vendedor_id', 
												'Directorio.cldesc1', 'Directorio.cldesc2', 'Directorio.clplazo', 
												'Directorio.divisa_id',
												'Directorio.tipopersona_id','Directorio.tipopersona_cve','Directorio.vendedor_id')
								));
		$response = array();
		foreach($data as $field=>$value) {
			$response[]=array($field => $value);			
		}
		/* Send the response in json format */
		echo json_encode($response);
	}	

}

?>