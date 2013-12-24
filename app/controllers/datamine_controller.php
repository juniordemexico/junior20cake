<?php

class DatamineController extends MasterDetailAppController {
	public $name='Datamine';

	public $uses = array(
		'Articulo', 'Cliente', 'Vendedor', 'Proveedor', 'Linea', 'Marca', 'Temporada', 'User'
	);

	public $layout = 'default';
	

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Compra.fecha' => 'desc'),
							'fields' => array('Compra.id', 'Compra.folio', 'Compra.fecha',
											'Compra.ordencompra_id',
											'Compra.importe', 'Compra.impoimpu', 'Compra.total',
											'Compra.st', 'Compra.t',
											'Compra.created', 'Compra.modified',
											'Compra.proveedor_id','Compra.proveedor_refer',
											'Compra.divisa_id', 'Divisa.dicve',
											'Proveedor.prcvepro','Proveedor.prnom',
											'Proveedor.pratn'),
//										'conditions' => array('Compra.est'=>0),
							);


	function index() {
		this->set('result', 'ok');
		this->set('result', 'Analisis de datos grandotes');
		this->set('title_for_layout', 'Data Minning');
		
	}
}
