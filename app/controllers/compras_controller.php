<?php

class ComprasController extends MasterDetailAppController {
	public $name='Compras';

	public $uses = array(
		'Compra', 'Compradet', 'Articulo', 'Color', 'Tipoartmovbodega', 'Almacen', 'Artmovbodegadetail', 'ArticuloProveedor', 'Entsal', 'Entsaldet'
	);

	public $layout = 'default';
	
	public $cacheAction = array('view');

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

	public $actualSerie = 'CO';

	public function add() {
		$data=array('Master' =>
									array('id'=>null, 'st'=>'A', 'est'=>'0',
										'folio'=>$this->Compra->getNextFolio($this->actualSerie, 0),
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
		$this->set('related', $this->Compra->loadDependencies());
		parent::add($data);
	}

	public function autorizacxp($id=null) {
		if(!$id) {
			if( isset($this->params['url']['id']) ) $id=$this->params['url']['id'];
		} 
		$this->set('result', 'ok');
		$this->set('message', 'Se Generó la Cuenta por Pagar');
		$this->set('fautorizacxp', date('Y-m-d'));
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
