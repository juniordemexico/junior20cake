<?php


class ArcanteController extends AppController {
	var $name='Arcante';
	var $uses=null;
	
	function index() {
		$this->layout='ajax';
    }
	function robot() {
		$this->layout='ajax';
		$this->data->archivos=array();
		$this->data->archivos[]='HOLA.001.ARC';
		$this->data->archivos[]='HOLA.002.ARC';
		$this->data->archivos[]='HOLA.003.ARC';
		
//		$this->data->respuesta="UYUYUY ARCANTE";
	}
}

?>