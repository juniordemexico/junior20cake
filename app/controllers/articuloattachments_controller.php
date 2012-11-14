<?php

class Articuloattachments extends MasterDetailAppController {
 
	var $name = 'Articuloattachments';
//	var $uses = array('Articuloattachment');
//	var $layout = 'attachment';
	
/*
	public function add() {
		if (!empty($this->data)) {
			if ($this->Articuloattachments->save($this->data)) {
				$result = '<div id="status">success</div>';
				$result .= '<div id="message">Successfully Uploaded</div>';
			} else {
				$result = "<div id='status'>error</div>";
				$result .= '<div id="message">'. $this->Articuloattachment->validationErrors['file'] .'</div>';
			}
 
			$this->RequestHandler->renderAs($this, 'ajax');
			$this->set('result', $result);
			$this->render('../elements/ajax');
		}
	}
*/
	public function index() {
		die("EL INDICE");
	}

}
