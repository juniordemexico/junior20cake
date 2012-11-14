<?php


class CustomerportalController extends MasterDetailAppController {
	var $name='Customerportal';
	var $layout='customerportal';
	var $uses = array(
		'Factura','Cliente','Vendedor','Divisa','Articulo','Linea','Marca','Temporada','Unidad'
	);

	function index() {
		parent::index();
	}

	function facturas() {
		$cvecli='GRAN'; //$this->Auth->User('username');
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 10,
								'model' => 'factura',
								'order' => array('Factura.fafecha' => 'desc'),
								'conditions' => array('facvecli'=> $cvecli )
								);

		$this->Factura->recursive = 1;
		$filter = $this->Filter->process($this);
		$this->set('facturas', $this->paginate($filter));
	}

	function pedidos() {
		$this->set('pedidos','asdasd<br/>qwewqeqwewqe<br/>');
	}

	function facturaelectronica ($id=null,$format='pdf') {
		$this->view = 'Media';
		$params = array('id' => $id.'.'.$format,
						'name' => $id,
						'download' => true,
						'extension' => $format,
						'path' => APP . 'files'.DS.'facturaselectronicas' . DS);
		$this->set($params);
	}

}
?>