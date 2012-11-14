<?php

class FacturasController extends MasterDetailAppController {
	var $name='Facturas';

	var $uses = array(
		'Factura', 'Facturadet', 'Cliente', 'Vendedor', 'Divisa', 'Articulo', 'Color', 'Pedido'
	);

	var $cacheAction = array('view/',
							array('monitor/', 'duration'=>'30'),
							);

	var $layout = 'default';

	var $tableFields = 	array(
							'id','farefer','fafecha','fat','fast','fasuma','faimporte','faimpoimpu','fatotal',
							'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
							'fapedido',
							'vendedor_id','Vendedor.vecveven','Vendedor.venom','fadivisa',
							'crefec','modfec');

/*
	var $paginate = array(	'update' => '#content',
							'evalScripts' => true,
							'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
							'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)),
							'limit' => 15,
							'order' => array('Factura.arcveart' => 'asc'),
						);
*/

	function index() {
		$this->Factura->recursive = 0;
/*
		$joins=array();
		if($this->Session->read('Auth.User.group_id')==30) {
			$joins[]=array(	'table' => 'Uservendedores',
							'alias' => 'Uservendedor',
							'type' => 'INNER',
							'conditions' => array('Uservendedor.user_id='.$this->Session->read('Auth.User.id'),
												'Uservendedor.vendedor_id=Factura.vendedor_id')
							);
		}
*/		
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Factura.farefer' => 'desc'),
								'fields' => $this->tableFields,
								'conditions' => array("Factura.crefec >" => date('Y-m-d', strtotime("-24 months")), 'Factura.faT'=>'0'),
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);
		$filter = $this->Filter->process($this);
		$this->set('facturas', $this->paginate($filter));
	}


	function Entrega() {
		if(!$this->RequestHandler->isAjax()) $this->layout='plain';
		$this->Factura->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Factura.farefer' => 'desc'),
								'fields' => array('id','farefer','fafecha','fat','fast','fasuma','fatotal',
								'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
								'fapedido', 'fafentrega', 'facajas', 'fatalonemb', 'fafembarque', 
								'vendedor_id','Vendedor.vecveven','Vendedor.venom','fadivisa',
								'crefec','modfec'),
								'conditions' => array("Factura.crefec >" => date('Y-m-d', strtotime("-24 months")), 'Factura.fafembarque <>'=>null, 'Factura.fast'=>'A', 'Factura.faT'=>'0'),
								);
/*
	'scope' => array('Factura.fast'=>'A', 'Factura.faT'=>'0')
*/
		$filter = $this->Filter->process($this);
		$this->set('facturas', $this->paginate($filter));
	}

	function Embarque() {
		if(!$this->RequestHandler->isAjax()) $this->layout='plain';
		$this->Factura->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Factura.fafecha' => 'desc'),
								'fields' => array('id','farefer','fafecha','fat','fast','fasuma','fatotal',
								'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
								'fapedido', 'fafentrega', 'facajas', 'fatalonemb', 'fafembarque', 
								'vendedor_id','Vendedor.vecveven','Vendedor.venom','fadivisa',
								'crefec','modfec'),
								'conditions' => array("Factura.crefec >" => date('Y-m-d', strtotime("-24 months")), 'Factura.fast'=>'A', 'Factura.faT'=>'0'),
								);
	/*
		'scope' => array('Factura.fast'=>'A', 'Factura.faT'=>'0')
	*/
		$filter = $this->Filter->process($this);
		$this->set('facturas', $this->paginate($filter));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_transaction', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Factura->save($this->data)) {
				$this->Session->setFlash(__('transaction_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Factura->find(array('id'=>$id),array('created','modified'));
				$this->data['Factura']['created'] = $dates['Factura']['created'];
				$this->data['Factura']['modified'] = $dates['Factura']['modified'];
				$this->Session->setFlash(__('transaction_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Factura->read(null, $id);
		}
//		$divisas = $this->Factura->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
//		$this->set(compact('divisas'));
		
		$details = $this->Facturadet->query("SELECT min(factura_id) id, min(facturadet.id) facturadet_id,
											Facturadet.articulo_id articulo_id, min(Articulo.arcveart) cveart,
											min(Articulo.ardescrip) descrip, sum(Facturadet.fadcant) cant,
											min(Facturadet.fadprecio) precio,sum(Facturadet.fadimporte) importe
											FROM Facturadet Facturadet
											JOIN Articulo Articulo ON Facturadet.articulo_id=Articulo.id
											WHERE Facturadet.factura_id=$id
											GROUP BY Facturadet.articulo_id
											");
		$this->set('details', $details);
		$this->set('master_id',$id);
	}

		function tallacolordata($id=null) {
		$this->layout = 'empty';
		if(!$id) {
				$this->Session->setFlash(__('invalid_item', true), 'error');
		}
		$master_id=isset($this->params['named']['master_id'])?$this->params['named']['master_id']:0;
		$child_id=isset($this->params['named']['child_id'])?$this->params['named']['child_id']:0;

  		$result = $this->Facturadet->query("SELECT Articulo.id, Articulo.arcveart, Articulo.talla_id,
										Color.cve color_cve,
										Talla.tadescrip,
										Facturadet.id child_id, Facturadet.articulo_id articulo_id,
										Facturadet.color_id color_id,
										Facturadet.fadprecio precio, Facturadet.fadimporte,
										Facturadet.fadt0 t0, Facturadet.fadt1 t1, Facturadet.fadt2 t2,
										Facturadet.fadt3 t3, Facturadet.fadt4 t4, Facturadet.fadt5 t5,
										Facturadet.fadt6 t6, Facturadet.fadt7 t7, Facturadet.fadt8 t8,
										Facturadet.fadt9 t9
										FROM Facturadet Facturadet
										JOIN Articulos Articulo ON Articulo.id=Facturadet.articulo_id
										JOIN Colores Color ON Color.id=Facturadet.color_id
										JOIN Tallas Talla ON Talla.id=Articulo.talla_id
										WHERE Facturadet.factura_id=$master_id AND Facturadet.articulo_id=$child_id
										ORDER BY Facturadet.id ASC, Color.cve ASC;
										");										
		$this->set('result', $result);	
		$this->set('master_id',$this->params['named']['master_id']);
		$this->set('child_id',$this->params['named']['child_id']);
	}

	function Monitor() {
		$this->layout='monitor';
		$facturas = $this->Factura->find('all',array(
								'limit'=> PAGINATE_ROWS,
								'order' => array('Factura.crefec' => 'desc'),
								'conditions'=>array("Factura.crefec >" => date('Y-m-d', strtotime("-3 months")), "Factura.fat" => '0'),		
								'fields' => $this->tableFields,
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								));			
		$this->set('facturas', $facturas);
	}


	function registraembarque() {
		$this->autoRender=false;
		if(!empty($this->data) && !empty($this->data['FacturaEmbarque']['id'])) {
			$id=$this->data['FacturaEmbarque']['id'];
			$this->Factura->read(null, $id);
			if(empty($this->Factura) || !$this->Factura) {
				echo "Error: ID inexistente";
				return;
			}
			
			if ($this->Factura->saveField('fafembarque', $this->data['FacturaEmbarque']['fafembarque']) &&
				$this->Factura->saveField('fatalonemb', $this->data['FacturaEmbarque']['fatalonemb']) &&
				$this->Factura->saveField('facajas', $this->data['FacturaEmbarque']['facajas'])
			) {
				echo "Embarcada ".$this->data['FacturaEmbarque']['fafembarque'];
				return;		
			}
		}
		echo "Error";
	}

	function registraentrega($id=null) {
		$this->autoRender=false;
		if(!empty($this->data) && !empty($this->data['FacturaEntrega']['id'])) {
			$id=$this->data['FacturaEntrega']['id'];
			$this->Factura->read(null, $id);
			if(empty($this->Factura) || !$this->Factura) {
				echo "Error: ID inexistente";
				return;
			}
			
			if ($this->Factura->saveField('fafentrega', $this->data['FacturaEntrega']['fafentrega']) ) {
				echo "Entregada ".$this->data['FacturaEntrega']['fafentrega'];
				return;
			}
		}
		echo "Error";
	}

}

	
?>