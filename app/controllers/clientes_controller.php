<?php


class ClientesController extends MasterDetailAppController {
	var $name='Clientes';

	var $uses = array(
		'Cliente','Pais','Estado','Vendedor','Divisa'
	);

	var $cacheAction = array('view'
							);

	var $tableFields = 	array(
							'id','clcvecli','cltda','clnom','clsuc','clst','clt','clatn',
							'vendedor_id','Vendedor.vecveven','Vendedor.venom',
							'pais_id','Pais.papais','estado_id','Estado.esedo',
							'created','modified');
	var $layout='default';


	function index() {
		$this->Cliente->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Cliente.clcvecli' => 'asc'),
								'fields' => $this->tableFields,
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);
		$filter = $this->Filter->process($this);
		$this->set('clientes', $this->paginate($filter));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	function add() { 
		if (!empty($this->data)) {
			$this->Cliente->recursive=-1;
			$this->Cliente->create();
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Cliente->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		$divisas = $this->Cliente->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$estados = $this->Cliente->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
		$paises = $this->Cliente->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
		$vendedores = $this->Cliente->Vendedor->find('list', array('fields' => array('Vendedor.id', 'Vendedor.venom', 'Vendedor.vecveven')));
		$this->set(compact('vendedores'));
	}

	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Cliente->delete($id)) {
			$this->Session->setFlash(__('item_has_been_deleted', true).': '.$id, 'success');
				$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('item_was_not_deleted', true), 'error');
				$this->redirect(array('action' => 'index'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('invalid_item', true));
				$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Cliente->recursive=-1;
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Cliente->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Cliente->find(array('id'=>$id),array('created','modified'));
				$this->data['Cliente']['created'] = $dates['Cliente']['created'];
				$this->data['Cliente']['modified'] = $dates['Cliente']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cliente->read(null, $id);
		}
		$divisas = $this->Cliente->Divisa->find('list', array('fields' => array('Divisa.id', 'Divisa.dicve')));
		$this->set(compact('divisas'));
		$estados = $this->Cliente->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo','Estado.pais_id')));
		$this->set(compact('estados'));
		$paises = $this->Cliente->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
		$vendedores = $this->Cliente->Vendedor->find('list', array('fields' => array('Vendedor.id', 'Vendedor.venom','Vendedor.vecveven')));
		$this->set(compact('vendedores'));
	}

	function details($id) {
		$this->data = $this->Cliente->read(null, $id);
    	echo json_encode($this->data);
    	exit;		
	}

	function getInfo($clcvecli='') {
		$this->autoRender=false;
		$this->layout='ajax';
		$data=$this->Cliente->find('first', array('conditions'=>array('clcvecli'=>$clcvecli),
		 						'fields'=>array('Cliente.id, Cliente.clcvecli, Cliente.cltda, 
												Cliente.clnom, Cliente.clsuc, Cliente.clcveven, Cliente.vendedor_id, 
												Cliente.cldesc1, Cliente.cldesc2, Cliente.clplazo, 
												Cliente.divisa_id')
								));
		$response = array();
		foreach($data as $field=>$value) {
			$response[]=array($field => $value);			
		}
		/* Send the response in json format */
		echo json_encode($response);
	}
	
	/* Text Field Autocomplete action */
	function autoComplete() {
		$this->autoRender=false;
  		$this->layout = 'ajax';
		
		$field=isset($this->params['named']['field'])?$this->params['named']['field']:'clcvecli';
		/* Validate and Format the search term */
		$term=strtoupper(substr(trim($_GET['term']),0,16));

		$this->Cliente->recursive=0;

		$conditions=array(
					'Cliente.clst'=>'A',
					'Cliente.clt'=>'0'
  					);

		if($field=='clcvecli') {
			$conditions[]=array('Cliente.cltda'=>'',
						 'OR' => array(
    					'Cliente.clcvecli LIKE '=>$term.'%',
    					'Cliente.clnom LIKE'=>'%'.$term.'%'
   						)
						);
		}
		if($field=='cltda') {
			$cvecli=isset($this->params['named']['clcvecli'])?$this->params['named']['clcvecli']:'';
			$conditions[]=array('Cliente.clcvecli'=>$cvecli,
			   					'OR' => array(
    					'Cliente.cltda LIKE '=>$term.'%',
    					'Cliente.clsuc LIKE'=>'%'.$term.'%'
   						)
						);
		}

		/* Configure and Execute the Query */
  		$records = $this->Cliente->find('all', array(
			'fields'=>array('Cliente.id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc','Cliente.clst','Cliente.clt'),
			'order'=>'Cliente.clcvecli ASC, Cliente.cltda ASC',
			'limit'=>32,
			'conditions' => $conditions
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($records as $record) {
			$response[$i]['id']=$record['Cliente']['id'];
			$response[$i]['value']=trim($record['Cliente']['clcvecli']);
			if($field=='clcvecli') {
   				$response[$i]['value']=trim($record['Cliente']['clcvecli']);
   				$response[$i]['label']='('.trim($record['Cliente']['clcvecli']) . ') ' . $record['Cliente']['clnom'];
			}
			if($field=='cltda') {
   				$response[$i]['value']=trim($record['Cliente']['cltda']);
   				$response[$i]['label']='('.trim($record['Cliente']['cltda']) . ') ' . $record['Cliente']['clsuc'];				
			}
  			$i++;
  		}
		/* Send the response in json format */
		echo json_encode($response);
	}
	
	

	function arcante($id=null,$type=null) {
		if (!is_null($id) && $id<=0) {
			$this->set('myMessage','El ID proporcionado es Incorrecto');
			return;
		}

		/* Initialize the query filter conditions */
		$conditions=array('Cliente.clst' => 'A');
		if (!is_null($id) && $id>0) {
			$conditions['Cliente.id']=$id;
		}

		$this->Proveedor->recursive = 1;		
		$myRecords=$this->Cliente->find('all',array(
										'order'=>'Cliente.clcvecli ASC,Cliente.cltda ASC',
										'conditions' => $conditions,
										));

		/* Check if the recordset is filled */
		if(!isset($myRecords) || !is_array($myRecords) || sizeof($myRecords)<1) {
			$this->set('myMessage','El ID proporcionado NO Existe');
			return;
		}

		/* Initialize the required elements to create the export files */
		$myMyUpdateType='MOD';
		$myStringCliDat=''; $myStringCliDir='';
		$myMessage='';
		foreach($myRecords as $myRecord) {
		$myClienteRefer=$myRecord['Cliente']['clcvecli'];
		$myStringCliDat.=
					$myMyUpdateType.ARC_SEP. /* Tipo de Movimiento (ADD,MOD,DEL) */
					$myRecord['Cliente']['clcvecli']."_".$myRecord['Cliente']['cltda'].ARC_SEP. /* Referencia del Cliente (C 20) */
					$myRecord['Cliente']['clnom'].ARC_SEP. /* Descripcion del Cliente (C 50) */
					'N'.ARC_SEP. /* Emitir automaticamente el packing list en la salida (C 1) */
					'S'.ARC_SEP. /* Permitir mezclar pedidos del mismo cte en un palet de preparacion (C 1) */
					'S'.ARC_SEP. /* Permitir enviar pedidos parciales (C 1) */
					'0'.ARC_SEP. /* Porcentaje de aceptacion de sobrante que permite el cliente (N 3) */
					'0'.ARC_SEP. /* Dias minimos de caducidad que acepta el cliente (N 3) */
					$myRecord['Cliente']['clcvetrans'].ARC_SEP. /* Referencia del Transportista habitual (C 15) */
					'N'.ARC_SEP. /* Flag especifico para indicar si el albarán lo sacará Arcante def N (C 1) */
					'N'. /* Indicar si el cliente es cliente propietario de la mercancia def N (C 1) */
					"<br/>\n";
		$myStringCliDir.=
					$myMyUpdateType.ARC_SEP. /* Tipo de Movimiento (ADD,MOD,DEL) */
					$myRecord['Cliente']['clcvecli']."_".$myRecord['Cliente']['cltda'].ARC_SEP. /* Referencia del Cliente (C 20) */
					ARC_SEP. /* DNI o NIF (C 10) */
					'DIR_'.$myRecord['Cliente']['clcvecli']."_".$myRecord['Cliente']['cltda'].ARC_SEP. /* Código del Lugar. Clave unica del ERP (C 13) */
					$myRecord['Cliente']['clnom'].'kaka'.ARC_SEP. /* Razon Social (C 30) */
					$myRecord['Cliente']['cldir'].ARC_SEP. /* Direccion de Entrega (C 150) */
					$myRecord['Cliente']['clciu'].ARC_SEP. /* Poblacion (C 50) */
					$myRecord['Cliente']['cledo'].ARC_SEP. /* Provincia/Ciudad/Estado (C 50) */
					$myRecord['Cliente']['clcp'].ARC_SEP. /* Código Postal (C 10) */
					$myRecord['Cliente']['clpais'].ARC_SEP. /* Pais (C 20) */
					'CL'.ARC_SEP. /* Siglas domicilio. Ejemplo CL, AV (C 2) */
					'NUM EXT/INT'.ARC_SEP. /* Numero domicilio. Ejemplo: Edificio B. Alm. 23 (C 36) */
					$myRecord['Cliente']['clemail'].ARC_SEP. /* Correo Electronico (C 50) */
					'9 a 18'.ARC_SEP. /* Horario de Entrega (C 20) */
					$myRecord['Cliente']['clatn'].ARC_SEP. /* Persona de Contacto (C 20) */
					$myRecord['Cliente']['cltel'].ARC_SEP. /* Telefono 1 (C 20) */
					''.ARC_SEP. /* Telefono 2 (C 20) */
					$myRecord['Cliente']['clfax'].ARC_SEP. /* Fax (C 20) */
					'S'. /* Direccion Predeterminada (C 1) */
					"<br/>\n";

		}
	$this->set('myStringCliDat',$myStringCliDat);
	$this->set('myStringCliDir',$myStringCliDir);
	$this->set('myMessage',$myMessage);
	}

	public function getmovs() {
		return($this->Cliente->getMovs());
	}
}

?>