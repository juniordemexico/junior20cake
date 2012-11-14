<?php


class DesktopController extends AppController {
	var $name='Desktop';
	var $uses=null;
	var $layout='desktop';

	function index() {
		$monitors=array('left'=>'/Pedidos/monitor', 'center'=>'', 'right'=>'/Facturas/monitor');
		if($this->Auth->User('group_id')==21) {
			$monitors=array('left'=>'', 'center'=>'', 'right'=>'');
		}
		$this->set('monitors', $monitors);
	}

}

?>