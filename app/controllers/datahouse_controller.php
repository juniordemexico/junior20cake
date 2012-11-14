<?php
class DatahouseController extends AppController {

	var $name = 'Datahouse';
	var $uses = array('SystemTable');
	var $components = array('Auth');

	
	function index() {
		
	}

	function query($sql=null) {
		Configure::write('debug',2); 
		$dataset=$this->SystemTable->query($sql);
		$this->set('dataset',$dataset);
		print_r($dataset);
		die();
	}

}
?>