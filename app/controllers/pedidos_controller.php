<?php


class PedidosController extends MasterDetailAppController {
	public $name='Pedidos';

	public $uses = array(
		'Pedido', 'Pedidodet', 'Ttmppartida', 'Articulo', 'Cliente'
	);

	public $cacheAction = array('view',
							array('monitor/', 'duration'=>'30'),
/*							'tallacolordata'*/
							);

	public $layout = 'default';
	
	public $tableFields = 	array(
							'id','perefer','pefecha','pefvence','pet','pest','petotal','peauto','pefauto',
							'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
							'Pedido.vendedor_id','Vendedor.vecveven','Vendedor.venom','divisa_id','Divisa.dicve',
							'crefec','modfec');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('importa');    
	}


	function index() {
		$this->Pedido->recursive = 0;
		$conditions=array();
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Pedido.perefer' => 'DESC'),
								'fields' => $this->tableFields,
								'conditions' => $conditions,
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);
		$filter = $this->Filter->process($this);
		$this->set('pedidos', $this->paginate($filter));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_transaction', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pedido', $this->Pedido->read(null, $id));
	}

	function add($tmpid=null) {
//		$this->autoRender=false;
		if (!empty($this->data)) {
			/* SAVE THE TRANSACTION */
			$tmpid=$this->data['Pedido']['tmpid'];
			$this->data['Pedido']['tmpid']=null;
			$this->data['Pedido']['perefer']=$this->Pedido->getRefer();
			$this->Pedido->save( 
    		array( 
        		'Model' => $fields 
    			), 
    		array( 
    			'id' => $newId 
    		) 
			);
			
			if ($this->Pedido->create() && $this->Pedido->save($this->data)) {
				$this->Session->setFlash(__('transaction_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->data['Pedido']['tmpid']=$tmpid;
				$this->Session->setFlash(__('transaction_could_not_be_saved', true)." tmpid: ".$this->data['Pedido']['tmpid'], 'error');
			}
		}
		else {
			if(!$this->data['Pedido']['tmpid']) {
				$this->data['Pedido']['tmpid']=(!$tmpid ? $this->Tmppartida->getNewTmpID() : $tmpid);
				$this->Tmppartida->Create();
				$tmpData=array();
				$tmpData['id']=$this->Tmppartida->getNewTmpID();
				$tmpData['tmpid']=$this->data['Pedido']['tmpid'];
				if (!$this->Tmppartida->Save($tmpData)) {
					$this->Session->setFlash(__('new_item_could_not_be_added', true)." tmpid: ".$this->data['Pedido']['tmpid'], 'error');					
				}
			}
		}

		$divisas = $this->Pedido->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$vendedores = $this->Pedido->Vendedor->find('list', array('fields' => array('Vendedor.id', 'Vendedor.venom', 'Vendedor.vecveven')));
		$details = $this->Pedidodet->query("SELECT min(pedido_id) id, min(pedidodet.id) pedidodet_id,
											Pedidodet.articulo_id articulo_id, min(Articulo.arcveart) cveart,
											min(Articulo.ardescrip) descrip, sum(Pedidodet.pedpedido) cant,
											min(Pedidodet.pedprecio) precio,sum(Pedidodet.pedimporte) importe
											FROM Pedidodet Pedidodet
											JOIN Articulo Articulo ON Pedidodet.articulo_id=Articulo.id
											WHERE Pedidodet.pedido_id=".$this->data['Pedido']['tmpid']."
											");
		$this->set(compact('divisas', 'vendedores', 'details'));
		$this->set('lastInsertedTmpID', $tmpData['id']);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_transaction', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pedido->save($this->data)) {
				$this->Session->setFlash(__('transaction_has_been_saved', true), 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Pedido->find(array('id'=>$id),array('created','modified'));
				$this->data['Pedido']['created'] = $dates['Pedido']['created'];
				$this->data['Pedido']['modified'] = $dates['Pedido']['modified'];
				$this->Session->setFlash(__('transaction_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pedido->read(null, $id);
		}
		$divisas = $this->Pedido->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$vendedores = $this->Pedido->Vendedor->find('list', array('fields' => array('Vendedor.id', 'Vendedor.venom', 'Vendedor.vecveven')));
		
		$details = $this->Pedidodet->query("SELECT min(pedido_id) id, min(pedidodet.id) pedidodet_id,
											Pedidodet.articulo_id articulo_id, min(Articulo.arcveart) cveart,
											min(Articulo.ardescrip) descrip, sum(Pedidodet.pedpedido) cant,
											min(Pedidodet.pedprecio) precio,sum(Pedidodet.pedimporte) importe
											FROM Pedidodet Pedidodet
											JOIN Articulo Articulo ON Pedidodet.articulo_id=Articulo.id
											WHERE Pedidodet.pedido_id=$id
											GROUP BY Pedidodet.articulo_id
											");
		$this->set(compact('divisas', 'vendedores', 'details'));
		$this->set('master_id', $id);
	}

	function delete($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_transaction', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		if ($this->Pedido->delete($id)) {
			$this->Session->setFlash(__('transaction_has_been_deleted', true).': '.$id, 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('transaction_was_not_deleted', true).': '.$id, 'error');
				$this->redirect(array('action' => 'index'));
	}

	function cancel($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_transaction', true), 'error');
//				$this->redirect(array('action' => 'index'));
		}
		if ($this->Pedido->cancel($id)) {
			$this->Session->setFlash(__('transaction_has_been_canceled', true).': '.$id, 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('transaction_was_not_deleted', true), 'error');
		$this->redirect( array('action' => 'edit', 'id'=>$id) );
	}

	function autoriza($id=null) {
		if(!$id && isset($this->data['PedidoAutoriza']) &&
		 	isset($this->data['PedidoAutoriza']['id']) && 
			!empty($this->data['PedidoAutoriza']['id'])
		) {
		$id=$this->data['PedidoAutoriza']['id'];	
		}
		$this->Pedido->recursive = 0;
		if($id) {
			$this->autoRender=false;
			if($this->Pedido->Autoriza($id)) {
				e($this->Pedido->transactionResult);
			}
			else {
				e($this->Pedido->transactionResult);
			}
			return false;
		}
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Pedido.pefvence' => 'desc'),
								'fields' => array('id','perefer','pefecha','pefvence',
								'peauto', 'pesurtido', 'pefauto', 'pet', 'pest','petotal',
								'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
								'Pedido.vendedor_id','Vendedor.vecveven','Vendedor.venom',
								'divisa_id', 'Divisa.dicve',
								'crefec', 'modfec',
								"(SELECT SUM(cmcargo)-SUM(cmabono) FROM ctemov WHERE cmcvecli=Pedido.pecvecli AND cmtda=Pedido.petda) saldo"
								),
								'conditions' => array('Pedido.crefec >' => date('Y-m-d', strtotime("-12 months")),
								 					'Pedido.pest'=>'A', 'Pedido.peauto'=>'0', 'Pedido.pesurtido'=>'0'),
								);
		$filter = $this->Filter->process($this);
		$this->set('pedidos', $this->paginate($filter));
	}

	function Monitor() {
		$this->layout='monitor';
		$this->Pedido->recursive = 0;
		$this->set('pedidos', $this->Pedido->find('all', array(
								'limit'=>20,
								'order' => array('Pedido.crefec' => 'desc'),
								'fields' => $this->tableFields,
								'conditions' => array("Pedido.crefec >" => date('Y-m-d', strtotime("-30 days")) ),
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								))
				);
	}

	function Exporta($id=null) {
		$this->layout='plain';
		$this->autoRender=false;
		$this->Pedido->recursive = 1;

		
		$this->data = $this->Pedido->read(null, $id);
		
  		$rs = $this->Pedido->query("SELECT Pedidodet.pedido_id pedido_id, Pedido.perefer folio, 
										Pedido.pefecha, Pedido.pefvence pefvence,
										Cliente.clcvecli, Vendedor.vecveven pecveven,
										Pedido.pest, Pedido.pet,
										Articulo.arcveart pedcveart, Articulo.talla_id,
										Pedidodet.id, 
										Pedidodet.articulo_id,
										Pedidodet.color_id,
										Pedidodet.pedcolor,
										Pedidodet.pedprecio, 
										Pedidodet.peddesc1,
										Pedidodet.peddesc1,
										Pedidodet.pedpt0, Pedidodet.pedpt1, Pedidodet.pedpt2,
										Pedidodet.pedpt3, Pedidodet.pedpt4, Pedidodet.pedpt5,
										Pedidodet.pedpt6, Pedidodet.pedpt7, Pedidodet.pedpt8,
										Pedidodet.pedpt9
										FROM Pedido Pedido
										JOIN Pedidodet Pedidodet ON Pedidodet.pedido_id=Pedido.id
										JOIN Articulos Articulo ON Articulo.id=Pedidodet.articulo_id
/*										JOIN Colores Color ON Color.id=Pedidodet.color_id*/
										JOIN Tallas Talla ON Talla.id=Articulo.talla_id
										JOIN Clientes Cliente ON Cliente.id=Pedido.cliente_id
										JOIN Vendedores Vendedor ON Vendedor.id=Pedido.vendedor_id
										WHERE Pedidodet.pedido_id=$id
										ORDER BY Pedidodet.id ASC, Pedidodet.pedcolor ASC;
										");

		$response = array();
 		$header=$this->data['Pedido'];
		$detail=array();
		$i=0;
		foreach($rs as $item) {
   			$detail[]=$item['Pedidodet'];
			$i++;
 		}

		$response=array('axbos' => array('encabezado'=>$header,
										 'detalle'=>$detail
						)
						);
						
		echo json_encode($response);										
	}

	function tallacolordata($id=null) {
		$this->layout = 'empty';

		if(!$id && !isset($this->params['named']['master_id'])) {
				$this->Session->setFlash(__('invalid_item', true),'default');
				die("NO SE RECIBIO ID");
		}

		$master_id=isset($this->params['named']['master_id'])?$this->params['named']['master_id']:$id;
		$child_id=isset($this->params['named']['child_id'])?$this->params['named']['child_id']:0;
 		$result = $this->Pedido->query("SELECT Articulo.id, Articulo.arcveart, Articulo.talla_id,
										Color.cve color_cve,
										Talla.tadescrip,
										Pedidodet.id child_id, Pedidodet.articulo_id articulo_id,
										Pedidodet.color_id color_id,
										Pedidodet.pedprecio precio, Pedidodet.pedimporte,
										Pedidodet.pedpt0 t0, Pedidodet.pedpt1 t1, Pedidodet.pedpt2 t2,
										Pedidodet.pedpt3 t3, Pedidodet.pedpt4 t4, Pedidodet.pedpt5 t5,
										Pedidodet.pedpt6 t6, Pedidodet.pedpt7 t7, Pedidodet.pedpt8 t8,
										Pedidodet.pedpt9 t9
										FROM Pedidodet Pedidodet
										JOIN Articulos Articulo ON Articulo.id=Pedidodet.articulo_id
										JOIN Colores Color ON Color.id=Pedidodet.color_id
										JOIN Tallas Talla ON Talla.id=Articulo.talla_id
										WHERE Pedidodet.pedido_id=$master_id AND Pedidodet.articulo_id=$child_id
										ORDER BY Pedidodet.id ASC, Color.cve ASC;
										");										
		$this->set('result', $result);	
		$this->set('master_id',$this->params['named']['master_id']);
		$this->set('child_id',$this->params['named']['child_id']);
		
	}

	function Importa() {
		private $ok=true;
		private $message="";

		if(isset($_SERVER['HTTP_USER_AGENT']) && stristr($_SERVER['HTTP_USER_AGENT'], 'admii')) {
			$isWeb=false;
			$this->layout='empty';
			$this->autoRender=false;
		}
		else {
			$isWeb=true;
			$this->layout='plain';
			$this->autoRender=true;
		}

		if( isset($this->data['PedidoImporta']['data']) ) {// && !empty($this->params['query']['data'])) {
			$this->Axfile->StringToFile('/home/www/junior20cake/app/files/tmp/pedido.importa.json', $this->data['PedidoImporta']['data']);
			$documentData=json_decode($this->data['PedidoImporta']['data']);
		
			if(!isset($documentData) || !is_object($documentData)) {
				if($isWeb) {
					$this->Session->setFlash(__('invalid_data', true), 'error');
					$this->redirect(array('action' => 'importa'));
				}
				else {
					echo "ERROR::La estructura JSON es incorrecta \n".$this->data['PedidoImporta']['data']."\n";					
				}
				exit;
			}

			// Decode de json string to objects
			$theHeader=$documentData->axbos->encabezado;
			$theDetail=$documentData->axbos->detalle;
			if(!isset($theHeader) || !isset($theDetail) ||
				!is_object($theHeader) || is_object($theDetail) ) {
				if($isWeb) {
					$this->Session->setFlash(__('invalid_json_structure', true), 'error');
					$this->redirect(array('action' => 'importa'));
				}
				else {
					echo "ERROR::La estructura JSON es incorrecta en el Encabezado o el Detalle ";
				}
				exit;
			}
			
			$theHeader=get_object_vars($theHeader);
			
			//Clean unused fields from the Hhader
			unset($theHeader['id']);
			unset($theHeader['uuid']);
			unset($theHeader['pedido_id']);
			unset($theHeader['cliente_id']);
			unset($theHeader['vendedor_id']);

			// Create the Master record array from the Header object
			$folio=$this->Pedido->getNextFolio('B', 1);
			$theHeader['perefer']=$folio;
			$theHeader['fecenv']=date('Y-m-d H:i:s');
			$theHeader['peimpu']=16;
			$theHeader['pest']='B';
			$theHeader['pet']=0;
	//		$uuid=(isset($theHeader['uuid'])?$theHeader['uuid']:0);
			$this->data=array('Pedido'=>$theHeader);
				
			// Check if the transaction already exists
//			$this->Pedido->read(null, "uuid=${uuid}");
 
			// Process the child's objects to create the Detail array
			$this->Articulo->recursive=-1;
			$partidas=array();
			foreach($theDetail as $item) {
				$partida=get_object_vars($item);
				if(!is_array($partida) || empty($partida)) {
					$ok=false;
					die("ERROR EN PARTIDA".$partida['pedcveart'] );					
				}
				$partida['articulo_id']=$folio;
				$partida['pedrefer']=$folio;
				if(isset($partida['id'])) unset($partida['id']);
				if(isset($partida['pedpedido'])) unset($partida['pedpedido']);
				$articuloid=$this->Articulo->field('id', array('Articulo.arcveart'=>$partida['pedcveart'] ));
				if(!$articuloid || !($articuloid>0)) {
					$ok=false;
					die("EL ARTICULO".$partida['pedcveart'] );
				}
				$partida['articulo_id']=$articuloid;
				$partidas[]=$partida;	
			}

			$this->data['Pedidodet']=$partidas;

			// Create Pedido Record
			$this->Pedido->recursive=2;
			$this->Pedido->create();
			$this->Pedido->set($this->data);
			if(!$this->Pedido->validates($this->data) ) {
				$ok=false;
				$message.="Error de Validacion en los Campos".WCR;
			}
			if ($ok && $this->Pedido->saveAll($this->data, array('validate'=>'first') )) {
				
			}
			else {
				$ok=false;
				$message.="Error al guardar el pedido".WCR;
			}
			
			// Send the saved Order's data to the user-agent

			if($isWeb) {
				// When the Request comes from an User-Agent
				if(!$ok) {
					$this->Session->setFlash(__('transaction_could_not_be_saved', true).' ['.$message.']');
					$this->redirect(array('action' => 'importa'));
				}
				else {
					$this->Session->setFlash(__('transaction_has_been_saved', true).' (Folio: '.$folio.')');
					$this->redirect(array('action' => 'importa'));
				}
			}
			else {
				// When the Request comes from an Application
				if($ok) {
					echo json_encode(
						array('axbos' => array('resultado'=>'OK',
												'pedido_id'=>$this->Pedido->id,
												'pedido_folio'=>$folio,
												'created'=>$this->Pedido->fecenv,
												'timestamp'=>date('Y-m-d H:i:s'),
												'client_ip'=>$this->RequestHandler->getClientIP()
										)
							)
						).CR;
				}
				else {
					echo json_encode(
						array('axbos' => array(	'resultado'=>'ERROR',
												'descripcionError'=>$message,
												'timestamp'=>date('Y-m-d H:i:S'),
												'client_ip'=>$this->RequestHandler->getClientIP()
											)
							)
						).CR;
				}		
	 		}


		}
	}

}
