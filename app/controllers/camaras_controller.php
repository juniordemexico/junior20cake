<?php

class CamarasController extends MasterDetailAppController {
	var $name='Camaras';

	var $uses = array();

	var $layout = 'default';
	
	var $cacheAction = array('view'
							);
	
	public function index() {
		$camara=array();
		for($i=1;$i<=16;$i++) { $camara[]=array('id'=>$i,'cve'=>"Reforma $i"); }
		$this->data=array();
		$this->data['items']=$camara;
	}

	public function view( $facility= null, $id = 0 ) {
		$this->layout='default';
		if (!$facility) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$urls=array(
			'reforma'=>'192.168.0.25:1050',
			'viaducto1'=>'192.168.3.250:1050',
			'viaducto2'=>'192.168.3.250:1051',
			'teziutlan'=>'192.168.2.254:1050',			
		);
		$cve=ucfirst($facility)." $id";
		$this->data=array();
		$this->data['Camara']=array('id'=>$id, 'cve'=>$cve, 'facility'=>ucfirst($facility), 'url'=>$urls[$facility]);
		
		$this->set('title_for_layout', "Camara :: $cve" );
	}

}
