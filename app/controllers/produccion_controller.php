<?php


class ProduccionController extends MasterDetailAppController {
	var $name='Produccion';

	var $uses = array(
		'Corte', 'Divisa',
		'Articulo', 'Artexist', 'Talla', 'Linea', 'Color', 'Linea', 'Marca', 'Temporada'
	);
/*
	var $cacheAction = array('reports',
							);
*/

	function beforeFilter() {

	}


	function index() {
	}

	
	function reports() {
		$this->layout='reportform';
	}

}

?>