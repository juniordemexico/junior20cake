<?php


class InvfisicosmovilController extends MasterDetailAppController {
	var $name='Invfisicosmovil';

	var $uses = array('Invfisico', 'Invfisicodetail', 'Almacen', 'Articulo', 'Color', 'Talla' );

	var $layout = 'almacenmovil';


	function index() {		
//		$this->set('items', $this->paginate($filter));
	}

}
