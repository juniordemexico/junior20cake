<?php


class InvfisicosmovilController extends MasterDetailAppController {
	var $name='Invfisicos';

	var $uses = array('Invfisico', 'Almacen');

	var $cacheAction = array('view',
							);
	var $layout = 'almacenmovil';


	function index() {
				
//		$this->set('items', $this->paginate($filter));
	}

}
