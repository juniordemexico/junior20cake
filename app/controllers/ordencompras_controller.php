<?php

class OrdencomprasController extends MasterDetailAppController {
	public $name='Ordencompras';

	public $uses = array(
		'Ordencompra', 'Ordencompradet', 'Articulo', 'Color', 'Proveedor', 'Divisa', 'ArticuloProveedor', 'Entsal', 'Entsaldet'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view'
							);

	public $paginate = array('update' => '#content',
							'evalScripts' => true,
							'limit' => PAGINATE_ROWS,
							'order' => array('Ordencompra.fecha' => 'desc'),
							'fields' => array('Ordencompra.id', 'Ordencompra.folio', 'Ordencompra.fecha',
											'Ordencompra.importe', 'Ordencompra.impoimpu', 'Ordencompra.total',
											'Ordencompra.st', 'Ordencompra.t',
											'Ordencompra.created', 'Ordencompra.modified',
											'Ordencompra.proveedor_id','Ordencompra.proveedor_refer',
											'Ordencompra.divisa_id',
											'Proveedor.prcvepro','Proveedor.prnom',
											'Proveedor.pratn'),
//										'conditions' => array('Ordencompra.est'=>0),
							);

	public $actualSerie = 'OC';

	public function add( $data=null ) {
		$data=array('Master' =>
									array('id'=>null, 'st'=>'A', 'est'=>'0',
										'folio'=>$this->Ordencompra->getNextFolio($this->actualSerie, 0),
										'fecha'=> date('Y-m-d'),
										'almacen_id'=>100, 'tipoartmovbodega_id'=>10, 'tipoarticulo_id'=>1,
										'divisa_id'=>1, 'tipodecambio'=>1
										),
									'masterModel' => $this->{$this->uses[0]}->name,
									'detailModel' => isset($this->{$this->uses[0]}->detailsModel) ?
														$this->{$this->uses[0]}->detailsModel :
														null,
									'Details' => array(),
						);
		$this->set('related', $this->Ordencompra->loadDependencies());

		// Send a blank form to the user
		$model=$this->{$this->masterModelName};
		if( !$data || empty($data) ) {
			$data=array(
						'Master'	=> array(
									'id'=>null, 
									$model->title => $model->getNextFolio($this->actualSerie, 0),
									$model->dateField => date('Y-m-d'),
									$model->stField=>'A',
									't'=>'0'
									),
						'Details'	=> array(),
						'masterModel' => $model->name,
						'detailModel' => isset($model->detailsModel) ?
											$model->detailsModel :
											null
					);
		}
		else {
			$this->set('data', $data);
		}

		$this->render('edit');
		return;
	}


	public function getItemByCve($cve=null, $proveedor_id=null ) {
		if(!$cve && isset($this->params['url']['cve']) ) $cve=$this->params['url']['cve'];
		if(!$proveedor_id && isset($this->params['url']['proveedor_id']) ) $proveedor_id=$this->params['url']['proveedor_id'];
		if(!$cve ||
			!$item=$this->Articulo->findByArcveart($cve)
			) {
			$this->set('result', 'error');
			$this->set('message', 'Ese Material NO Existe');
			return;
		}

		// Check if Item already exists
		$item['Articulo']['arcveart']=trim($item['Articulo']['arcveart']);
		$item['ArticuloColor']=$this->Articulo->getArticuloColor($item['Articulo']['id']);
		$articulo_id=$item['Articulo']['id'];
		$precios=$this->ArticuloProveedor->find('first', array('conditions'=>array("articulo_id=$articulo_id","proveedor_id=$proveedor_id")));
		$item['Articulo']['costo']=(isset($precios['ArticuloProveedor']['costo'])?$precios['ArticuloProveedor']['costo']:0);
		$item['Articulo']['codigoproveedor']=(isset($precios['ArticuloProveedor']['codigoproveedor'])?$precios['ArticuloProveedor']['codigoproveedor']:'');
		$this->set('result', 'ok');
		$this->set('message', 'Material '.$item['Articulo']['arcveart']);
		$this->set('item', $item);
	}

}
