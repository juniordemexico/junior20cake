<?php


class ConteosController extends MasterDetailAppController {
	var $name='Conteos';

	var $uses = array('Articulo', 'Invfisico', 'Invfisicodetail', 'Linea', 'Marca', 'Color');

	var $cacheAction = array('view',
							);
	var $layout = 'default';


	public function index() {
		$this->Articulo->recursive = 0;
		$this->paginate = array(
					'update' => '#content',
					'evalScripts' => true,
					'limit' => 20,
					'fields'=>array('Articulo.*, Linea.*, Marca.*, Invfisicodenormal.*, Thecolor.cve color_cve,
					(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart=Articulo.arcveart AND amcolor=(SELECT cve FROM colores WHERE id=Invfisicodenormal.color_id)) existencia,
					(SELECT LIST(ubicaciones.cve, '."'.  '".') FROM invfisicodetails JOIN ubicaciones ON invfisicodetails.ubicacion_id=ubicaciones.id WHERE articulo_id=Articulo.id AND color_id=Invfisicodenormal.color_id AND '."st='A'".') ubicacion_cves'),
					'conditions'=>array('Articulo.tipoarticulo_id'=>0),
					'joins'=>array(
						array(	'table' => 'Invfisicodenormals',
								'alias' => 'Invfisicodenormal',
								'type' => 'INNER',
								'conditions' => array(
											'Articulo.id=Invfisicodenormal.articulo_id',
											),
							),
						array( 'table'=>'Colores',
								'alias'=>'Thecolor',
								'type'=>'LEFT',
								'conditions' => array(
											'Thecolor.id=Invfisicodenormal.color_id',									
									)
								)
					
						)
				);
		$filter = $this->Filter->process($this);		
		$this->set('items', $this->paginate($filter));
	}

}
