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
					'fields'=>array('Articulo.*, Linea.*, Marca.*, Invfisicodenormal.*,
					(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart=Articulo.arcveart) existencia,
					coalesce((SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart='."'Z'".'||Articulo.arcveart),0) existenciaz,
					(SELECT LIST(ubicaciones.cve, '."'.  '".') FROM invfisicodetails JOIN ubicaciones ON invfisicodetails.ubicacion_id=ubicaciones.id WHERE articulo_id=Articulo.id AND tipomovinvfisico_id BETWEEN -99 AND 99 AND '."st='A'".') ubicacion_cves_1,
					(SELECT LIST(ubicaciones.cve, '."'.  '".') FROM invfisicodetails JOIN ubicaciones ON invfisicodetails.ubicacion_id=ubicaciones.id WHERE articulo_id=Articulo.id AND (tipomovinvfisico_id>99 OR tipomovinvfisico_id<-99) AND '."st='A'".') ubicacion_cves_2'
					),

					'conditions'=>array('Articulo.tipoarticulo_id'=>0),
					'joins'=>array(
						array(	'table' => 'Invfisicomodelodenormals',
								'alias' => 'Invfisicodenormal',
								'type' => 'INNER',
								'conditions' => array(
											'Articulo.id=Invfisicodenormal.articulo_id',
											),
							),
						)
				);
		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
	}

	public function marbete($id=null) {
		if(!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			exit;
		}
		$this->set('item', $this->Articulo->findById($id));
		$this->set('details', $this->Invfisicodetail->findByArticulo_id($id));
	}

}



/*

		$this->paginate = array(
					'update' => '#content',
					'evalScripts' => true,
					'limit' => 20,
					'fields'=>array('Articulo.*, Linea.*, Marca.*, Invfisicodenormal.*, Thecolor.cve color_cve,
					(SELECT SUM(ament)-SUM(amsal) FROM artmov WHERE amcveart=Articulo.arcveart AND amcolor=(SELECT cve FROM colores WHERE id=Invfisicodenormal.color_id)) existencia,
					(SELECT LIST(ubicaciones.cve, '."'.  '".') FROM invfisicodetails JOIN ubicaciones ON invfisicodetails.ubicacion_id=ubicaciones.id WHERE articulo_id=Articulo.id AND color_id=Invfisicodenormal.color_id AND '."st='A'".') ubicacion_cves'),
					'conditions'=>array('Articulo.tipoarticulo_id'=>0),
					'joins'=>array(
						array(	'table' => 'Invfisicomodelodenormals',
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


*/