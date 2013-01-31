<?php


class BodegaexistenciasController extends MasterDetailAppController {
	var $name='Bodegaexistencias';

	var $uses = array('Artmovbodegaexistencia', 'Articulo', 'Color', 'Talla', 'Almacen', 'Ubicacion', 'Linea', 'Marca', 'Temporada');

	var $layout = 'bodega';

	var $currentPrinter=array('id'=>11, 'cve'=>'Zebra01', 'printqueue'=>'barcodes-viaducto01');
	
	public function beforeFilter() {
		if(isset($this->data['Bodegaexistencia'])) {
			$this->data['Artmovbodegaexistencia']=$this->data['Bodegaexistencia'];
		}
		parent::beforeFilter();
	}

	public function index() {
		$this->set('title_for_layout', "BODEGA VIADUCTO");	
		$this->Artmovbodegaexistencia->recursive = 1;
		$this->paginate = array(
					'update' => '#content',
					'evalScripts' => true,
					'limit' => 20,
					'fields'=>array('"ARTMOVBODEGAEXISTENCIA".*, "ARTICULO".*, "TALLA".*, "COLOR".*, "UBICACION".*'),
					'conditions'=>array('Articulo.tipoarticulo_id'=>0),
				);
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
	}

}
