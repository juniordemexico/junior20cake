<?php


class MaterialexistenciasController extends MasterDetailAppController {
	var $name='Materialexistencias';

	var $uses = array('Artmovbodegaexistencia', 'Articulo', 'Color', 'Talla', 'Almacen', 'Ubicacion', 'Linea', 'Marca', 'Temporada');

	var $layout = 'bodegamaterial';

	var $currentPrinter=array('id'=>11, 'cve'=>'Zebra01', 'printqueue'=>'barcodes-tezi01');

	public function beforeFilter() {
//		$this->autoRender=false;
//		echo 'HOLA';
	
		if(isset($this->data['Materialexistencia'])) {
			$this->data['Artmovbodegaexistencia']=$this->data['Bodegaexistencia'];
		}
		parent::beforeFilter();
	}
	public function index() {
		$this->set('title_for_layout', "BODEGA TEZIUTLÁN");	
		$this->Artmovbodegaexistencia->recursive = 1;
		$this->paginate = array(
					'update' => '#content',
					'evalScripts' => true,
					'limit' => 20,
					'fields'=>array('"ARTMOVBODEGAEXISTENCIA".*, "ARTICULO".*, "TALLA".*, "COLOR".*, "UBICACION".*'),
					'conditions'=>array('Articulo.tipoarticulo_id'=>1,
										'Artmovbodegaexistencia.almacen_id'=>100
					),
				);
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
	}

	public function nada() {
		die('JOJOJOY');
	}
}
