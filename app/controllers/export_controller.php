<?php

/* Export to Excel, CSV, plain text, json, xml vcard, v-cal,*/

class ExportController extends AppController {
	var $name='Export';
	var $uses=null;
	var $layout='text';
	
	public $helpers = array('PhpExcel'); 

	function index() {
    }

}

?>