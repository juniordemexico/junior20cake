<?php


class ContactosController extends MasterDetailAppController {
	var $name='Contactos';

	var $uses = array(
		'Contacto','Pais','Estado'
	);

	var $cacheAction = array('view'
							);
	
	var $layout='default';

	function index() {
		$this->Contacto->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
								'order' => array('Contacto.nom' => 'asc'),
								);
		$filter = $this->Filter->process($this);
		$this->set('contactos', $this->paginate($filter));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
				$this->redirect(array('action' => 'index'));
		}
		$this->set('contacto', $this->Contacto->read(null, $id));
	}

	function add() { 
		if (!empty($this->data)) {
			if ($this->Contacto->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Contacto->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		$estados = $this->Contacto->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo')));
		$this->set(compact('estados'));
		$paises = $this->Contacto->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
	}

	function delete($id) {
		if (!$id) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Contacto->delete($id)) {
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
			if ($this->Contacto->save($this->data)) {
				$this->Session->setFlash(__('item_has_been_saved', true).' ('.$this->Contacto->id.')', 'success');
				$this->redirect(array('action' => 'index'));
			} else {
				$dates = $this->Contacto->find(array('id'=>$id),array('created','modified'));
				$this->data['Contacto']['created'] = $dates['Contacto']['created'];
				$this->data['Contacto']['modified'] = $dates['Contacto']['modified'];
				$this->Session->setFlash(__('item_could_not_be_saved', true), 'error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Contacto->read(null, $id);
		}
		$estados = $this->Contacto->Estado->find('list', array('fields' => array('Estado.id', 'Estado.esedo','Estado.pais_id')));
		$this->set(compact('estados'));
		$paises = $this->Contacto->Pais->find('list', array('fields' => array('Pais.id', 'Pais.papais')));
		$this->set(compact('paises'));
	}

	function details($id) {
		$this->data = $this->Contacto->read(null, $id);
    	echo json_encode($this->data);
    	exit;		
	}

	function getInfo($cve='') {
		$this->autoRender=false;
		$this->layout='ajax';
		$data=$this->Contacto->find('first', array('conditions'=>array('cve'=>$cve),
		 						'fields'=>array('Contacto.id, Contacto.cve, Contacto.nom,
		 										`Contacto.clsuc, Contacto.clcveven,
												Contacto.vendedor_id, 
												Contacto.cldesc1, Contacto.cldesc2, Contacto.clplazo, 
												Contacto.divisa_id')
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

		$this->Contacto->recursive=0;

		$conditions=array(
  					);

		if($field=='cve') {
			$conditions[]=array(
    					'Contacto.cve LIKE '=>$term.'%',
    					'Contacto.nom LIKE'=>'%'.$term.'%'
   						
						);
		}

		/* Configure and Execute the Query */
  		$records = $this->Contacto->find('all', array(
			'fields'=>array('Contacto.id','Contacto.clcvecli','Contacto.cltda','Contacto.clnom','Contacto.clsuc','Contacto.clst','Contacto.clt'),
			'order'=>'Contacto.clcvecli ASC, Contacto.cltda ASC',
			'limit'=>32,
			'conditions' => $conditions
			));

		/* Create the dataset to be returned */
		$response = array();
		$i=0;
		foreach($records as $record) {
			$response[$i]['id']=$record['Contacto']['id'];
			$response[$i]['value']=trim($record['Contacto']['clcvecli']);
			if($field=='clcvecli') {
   				$response[$i]['value']=trim($record['Contacto']['clcvecli']);
   				$response[$i]['label']='('.trim($record['Contacto']['clcvecli']) . ') ' . $record['Contacto']['clnom'];
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
		$conditions=array('Contacto.clst' => 'A');
		if (!is_null($id) && $id>0) {
			$conditions['Contacto.id']=$id;
		}

		$this->Proveedor->recursive = 1;		
		$myRecords=$this->Contacto->find('all',array(
										'order'=>'Contacto.clcvecli ASC,Contacto.cltda ASC',
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
		$myContactoRefer=$myRecord['Contacto']['clcvecli'];
		$myStringCliDat.=
					$myMyUpdateType.ARC_SEP. /* Tipo de Movimiento (ADD,MOD,DEL) */
					$myRecord['Contacto']['clcvecli']."_".$myRecord['Contacto']['cltda'].ARC_SEP. /* Referencia del Contacto (C 20) */
					$myRecord['Contacto']['clnom'].ARC_SEP. /* Descripcion del Contacto (C 50) */
					'N'.ARC_SEP. /* Emitir automaticamente el packing list en la salida (C 1) */
					'S'.ARC_SEP. /* Permitir mezclar pedidos del mismo cte en un palet de preparacion (C 1) */
					'S'.ARC_SEP. /* Permitir enviar pedidos parciales (C 1) */
					'0'.ARC_SEP. /* Porcentaje de aceptacion de sobrante que permite el contacto (N 3) */
					'0'.ARC_SEP. /* Dias minimos de caducidad que acepta el contacto (N 3) */
					$myRecord['Contacto']['clcvetrans'].ARC_SEP. /* Referencia del Transportista habitual (C 15) */
					'N'.ARC_SEP. /* Flag especifico para indicar si el albarán lo sacará Arcante def N (C 1) */
					'N'. /* Indicar si el contacto es contacto propietario de la mercancia def N (C 1) */
					"<br/>\n";
		$myStringCliDir.=
					$myMyUpdateType.ARC_SEP. /* Tipo de Movimiento (ADD,MOD,DEL) */
					$myRecord['Contacto']['clcvecli']."_".$myRecord['Contacto']['cltda'].ARC_SEP. /* Referencia del Contacto (C 20) */
					ARC_SEP. /* DNI o NIF (C 10) */
					'DIR_'.$myRecord['Contacto']['clcvecli']."_".$myRecord['Contacto']['cltda'].ARC_SEP. /* Código del Lugar. Clave unica del ERP (C 13) */
					$myRecord['Contacto']['clnom'].'kaka'.ARC_SEP. /* Razon Social (C 30) */
					$myRecord['Contacto']['cldir'].ARC_SEP. /* Direccion de Entrega (C 150) */
					$myRecord['Contacto']['clciu'].ARC_SEP. /* Poblacion (C 50) */
					$myRecord['Contacto']['cledo'].ARC_SEP. /* Provincia/Ciudad/Estado (C 50) */
					$myRecord['Contacto']['clcp'].ARC_SEP. /* Código Postal (C 10) */
					$myRecord['Contacto']['clpais'].ARC_SEP. /* Pais (C 20) */
					'CL'.ARC_SEP. /* Siglas domicilio. Ejemplo CL, AV (C 2) */
					'NUM EXT/INT'.ARC_SEP. /* Numero domicilio. Ejemplo: Edificio B. Alm. 23 (C 36) */
					$myRecord['Contacto']['clemail'].ARC_SEP. /* Correo Electronico (C 50) */
					'9 a 18'.ARC_SEP. /* Horario de Entrega (C 20) */
					$myRecord['Contacto']['clatn'].ARC_SEP. /* Persona de Contacto (C 20) */
					$myRecord['Contacto']['cltel'].ARC_SEP. /* Telefono 1 (C 20) */
					''.ARC_SEP. /* Telefono 2 (C 20) */
					$myRecord['Contacto']['clfax'].ARC_SEP. /* Fax (C 20) */
					'S'. /* Direccion Predeterminada (C 1) */
					"<br/>\n";

		}
	$this->set('myStringCliDat',$myStringCliDat);
	$this->set('myStringCliDir',$myStringCliDir);
	$this->set('myMessage',$myMessage);
	}

}

?>