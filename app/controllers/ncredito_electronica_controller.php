<?php

class NcreditoElectronicaController extends MasterDetailAppController {

	var $uses = array('Ncredito', 'Ncreditodet', 'Cliente','Vendedor','Divisa', 'Factura');

	var $cacheAction = array();

	var $tableFields = 	array(
							'id','ncrefer','ncfecha','nct','ncst','ncsuma','ncimporte','ncimpoimpu','nctotal',
							'ncfactura','ncdevol', 'ncvobo', 'cancelauuid', 'cancelafecha',
							'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
							'vendedor_id','Vendedor.vecveven','Vendedor.venom','ncdivisa',
							'crefec','modfec', 'uuid', 'fechatimbrado');
	var $layout = 'plain';
	
	var $pathDOCS;

	/*
		public function beforeFilter() {
			$this->Auth->autoRedirect = false;
			$this->Auth->allow('imprimepdfold');

			$querystring=''; 
			foreach($this->params['url'] as $key=>$value) {
				$querystring.='::'.$key.'='.$value;
			};

			// Fill a request's data array. Mainly to pass it to çs and views
			$this->set('request', array(
				'querystring' => $querystring,
				'client_ip' => $this->RequestHandler->getClientIP(),
				'client_referer' => $this->RequestHandler->getReferer(),
				'client_accepts' => $this->RequestHandler->accepts(),
				'isSSL' => false,
				'isAjax' => false,
				'isMobile' => false,
				'request_method' => ($this->RequestHandler->isGet()?'GET':($this->RequestHandler->isPost()?'POST':($this->RequestHandler->isDelete()?'DELETE':($this->RequestHandler->isPut()?'PUT':'')))),
				'_timestamp_request'=>date('Y-m-d H:i:s'),
				'_timestamp'=>date('Y-m-d H:i:s'),
			));

			// Initialize the apiResponse structure
			$this->apiResponse=array(
				'_id'=>99999,
				'_parentid'=>88888,
				'_timestamp_request'=>date('Y-m-d H:i:s'),
				'_timestamp'=>date('Y-m-d H:i:s'),
				'result'=>'ok',
				'messages'=>array(),
				'data'=>array(),
				);

			if(isset($this->uses) && is_array($this->uses) && count($this->uses)>0 && is_string($this->uses[0]) ) {
				$this->masterModelName=$this->uses[0];
				$this->masterModelTitle=$this->{$this->masterModelName}->title;
				$this->masterModelPK=$this->{$this->masterModelName}->primaryKey;
				$this->masterModelstField=$this->{$this->masterModelName}->stField;
				$this->masterModeldateField=$this->{$this->masterModelName}->dateField;
			}

			// Set the default page's title
			$this->pageTitle=$this->name;

		}
	*/

	function index() {
//		Configure::write('debug', 2);
		$this->Ncredito->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Ncredito.ncrefer' => 'desc'),
								'fields' => $this->tableFields,
								'conditions' => array("Ncredito.crefec >" => date('Y-m-d', strtotime("-12 months")),'Ncredito.nct'=>'0'),
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);

		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($filter));
	}

	public function imprime( $id = null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		$data=$this->{$this->masterModelName}->getItemWithDetails($id);

		$data['Comprobante']=array(
			'uuid'=>'0749CF42-905C-4419-8095-15A4667B5FD7',
			'sello_emisor'=>'aegaMjno7PYJ512c0OZIxKrsWX0x5xYA7/qbT3Xn//Fby4pyfntTuD+msJXMcB6/TqmEmt1lPKGurCvHgxJg0kAgV3zxTH1H85gJboxSDdv98tp5+BApBIGA0KYm0TdcXnzHR/UAL+5jEKblWCHvoHb+mgW5LZaPDjVk7DxMZpo=',
			'fecha_timbrado'=>'2013-11-19 01:00:00',
			'no_certificado_sat'=>'01000006746677',
			'sello_cfd'=>'aegaMjno7PYJ512c0OZIxKrsWX0x5xYA7/qbT3Xn//Fby4pyfntTuD+msJXMcB6/TqmEmt1lPKGurCvHgxJg0kAgV3zxTH1H85gJboxSDdv98tp5+BApBIGA0KYm0TdcXnzHR/UAL+5jEKblWCHvoHb+mgW5LZaPDjVk7DxMZpo=',
			'sello_sat'=>'5aLqDjNxqBZ8skNBZa03+WHpgwE6lbcEtGJ3EPlUqkndlFDoK9/Ub4GZQS0rheqbcl5A2zlWIzAbtL+GWFdDOXVLzNkL6qNl8VV+OZOcVB6/34sVJyEq4/8fxeIh7UIGKwz9gl7vwHMik0C7F4N622Yv6q7Zcrg5trszkCXvBU4=',
			'codigo_qr'=>'?re=JME910405B83&rr=GOCG650610IXA&tt=0000003336.060000&id=0749CF42-905C-4419-8095-15A4667B5FD7'
);
		$this->layout='print';
		$this->set('result', 'ok' );
		$this->set('data', $data );
		$this->set('title_for_layout', ucfirst($this->name).'::'.
					$data['Master'][$this->masterModelTitle]
				);
	}

	public function imprimepdf( $id = null ) {
		if (!$id || !$id>0) {
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		$docto=$this->{$this->masterModelName}->getDoctoForCFDI( $id );
		$docto_arr=json_decode($docto);

		$this->layout='pdf';
		$this->set('result', 'ok' );
		$this->set('docto', $docto_arr );
		$this->set('title_for_layout', ucfirst($this->name).'::'.
					$docto_arr->Master->folio
				);
	}
//////////////
//Métodos para timbrado, cancelación y generación de pdf's en automático
/*
	public function autogenerapdf() {
		Configure::write('debug', 0);
		$this->layout='default';
		$this->recursive=-1; //B0061829
		$items=$this->Ncredito->find('all', array('conditions'=>array('Ncredito.ncrefer >='=>'B0060000','Ncredito.ncrefer <='=>'B0060050', 'nct'=>0),
							'order'=>array('Ncredito.ncrefer'),
							'fields'=>array('Ncredito.id','Ncredito.ncrefer','Ncredito.ncfecha','Ncredito.cliente_id',
											'Ncredito.nccvecli','Ncredito.nctda','Ncredito.nctotal','Ncredito.ncst','Ncredito.nct')
							));
		$this->set('items', $items);
	}

	public function autocancela() {
		Configure::write('debug', 0);
		$this->layout='default';
		$this->recursive=-1; //D000XXXX
		$items=$this->Ncredito->find('all', array('conditions'=>array('Ncredito.ncrefer >='=>'D0000001','Ncredito.ncrefer <='=>'D0001050', 'nct'=>0, 'ncst'=>'C', 'oldst'=>'A', 'cancelauuid'=>null),
							'order'=>array('Ncredito.ncrefer'),
							'fields'=>array('Ncredito.id','Ncredito.ncrefer','Ncredito.ncfecha','Ncredito.cliente_id',
											'Ncredito.nccvecli','Ncredito.nctda','Ncredito.nctotal','Ncredito.ncst','Ncredito.nct')
							));
		$this->set('items', $items);
	}
*/
	public function autotimbra() {
		Configure::write('debug', 0);
		$this->layout='default';
		$this->recursive=-1; //N0008621 - N0008949
		$items=$this->Ncredito->find('all', array('conditions'=>array('Ncredito.ncrefer >='=>'N0008621','Ncredito.ncrefer <='=>'N0008948', 'nct'=>0, 'ncst'=>'A', 'ncdesc1'=>'0', 'sellosat'=>null),
							'order'=>array('Ncredito.ncrefer'),
							'fields'=>array('Ncredito.id','Ncredito.ncrefer','Ncredito.ncfecha','Ncredito.cliente_id',
											'Ncredito.nccvecli','Ncredito.nctda','Ncredito.nctotal','Ncredito.ncst','Ncredito.nct')
							));
		$this->set('items', $items);
	}

	public function generacfdi($id=null) {
		if (!$id) {
			if(isset($this->params['url']['id'])) {
				$id=$this->params['url']['id'];
			}
			else {
				$this->Session->setFlash(__('invalid_item', true), 'error');
				return;
			}
		}

		if (isset($this->params['mailcfdi'])) {
			$mailcfdi=$this->params['mailcfdi'];
		}
		else {
			$mailcfdi=true;
		}

		$responses=array();

		// Obtenemos los datos de la factura listos para generar XML y PDF
		$docto=$this->Ncredito->getDoctoForCFDI( $id );
		$docto_arr=json_decode($docto);
		$this->set('docto', $docto_arr);

		$estatus=$this->Ncredito->findById($id);
		if(!$estatus || !empty($estatus['Ncredito']['sellosat'])) {
				$this->Session->setFlash(__('Esa Nota de Crédito YA se Timbró. Tiene el UUID: '.$estatus['Ncredito']['uuid'], true), 'error');
				return;			
		}

		if($estatus['Ncredito']['fadesc1']<>0 || 
			$estatus['Ncredito']['fadesc2']<>0 ||
			$estatus['Ncredito']['fadesc3']<>0
		) {
				$this->Session->setFlash(__('Esa Nota de Crédito TIENE DESCUENTO GLOBAL. En este momento no podremos timbrarla. Gracias.', true), 'error');
				return;			
		}

		// Generamos el XML con Cadena Original y Sello

		$this->set('title_for_layout', 'Ncredito CFDI');

		if ( !$this->AxFolioselectronicos->createCFDI( $docto ) ) {
			$this->set('result', "error");
			$this->set('message', "ERROR EN CREATECFDI:".$this->AxFolioselectronicos->message);
			return;
//			$this->Session->setFlash($this->AxFolioselectronicos->message, 'error');
		}
		else {
			$responses[]=array('default','Creación del XML, Cadena Original y Sello Digital',
							$this->AxFolioselectronicos->message);

		}

		// Obtiene el contenido del Timbre Fiscal devuelto por el PAC
//		print_r($docto_arr);

//		die();
		if ( !$this->AxFolioselectronicos->timbrarComprobanteFiscal() ) { 
			$this->set('result', 'error');
			$this->set('message','Error al Timbrar CFDI: ' . $this->AxFolioselectronicos->message);
//			$responses[]=array('info', 'RESPUESTA DEL PAC',
//							$this->AxFolioselectronicos->pacResponse);
//			$this->set('responses', $responses);
			return false;
//			$this->Session->setFlash('Error al Timbrar CFDI: ' . $this->AxFolioselectronicos->message, 'error');
		}

		$documento=$this->AxFolioselectronicos->documento;

		$this->Ncredito->read(null, $id);
		if( !$this->Ncredito->save(
							array('uuid'=>$documento['UUID'], 'fechatimbrado'=>substr($documento['FechaTimbrado'],0,10).' '.substr($documento['FechaTimbrado'],11), 
								'sellosat'=>$documento['selloSAT'], 'sellocfd'=>$documento['selloCFD'],
								'nocertificadosat'=>$documento['noCertificadoSAT'],
								'cadenaoriginal'=>$documento['cadenaoriginal']
								),
							false,
							array('uuid', 'fechatimbrado', 'sellosat', 'sellocfd', 'nocertificadosat', 'cadenaoriginal')
								)
		) {
			$this->set('result', "error");
			$this->set('message','No se pudieron registrar los datos de timbrado');
			return;			
		}

		$responses[]=array('success', 'Timbrado del CFDI con el PAC <small>(conexción al webservice del proveedor)</small>', json_encode($this->AxFolioselectronicos->documento) );
		//					$this->AxFolioselectronicos->pacResponse );


		$this->set('result', 'ok');
		$this->set('message', 'Se generó el comprobante digital CFDI de la Ncredito <strong>'.$this->AxFolioselectronicos->documento['folio'].'</strong> '.
							' (uuid: '.$documento['UUID'].' fecha: '.$documento['FechaTimbrado'].')'); //$docto['Master']['uuid']
		$this->set('title_for_layout', 'Ncredito CFDI::'.$this->AxFolioselectronicos->documento['folio']);
//		$this->set('docto', json_decode($docto));
		$this->set('documento', $documento);
		$this->set('responses', $responses);
	}

//Inicia cancelacfdi
	public function cancelacfdi( $id=null ) {

		if(!$id) {
			$id=$this->params['url']['id'];
		}

		$item=$this->Ncredito->findById($id);
		$UUID = $item['Ncredito']['uuid'];

		// Produccion
		$pac_username='lev@oggi.mx';
		$pac_password='V3rn40gg1cfd2*';
		$pac_url_timbrado='https://facturacion.finkok.com/servicios/soap/stamp.wsdl';
		$pac_url_cancela='https://facturacion.finkok.com/servicios/soap/cancel.wsdl';

		// Pruebas
//		$pac_username='v.islas.padilla@gmail.com';
//		$pac_password='27Marzo!';
//		$pac_url_timbrado='http://demo-facturacion.finkok.com/servicios/soap/stamp.wsdl';
//		$pac_url_cancela='http://demo-facturacion.finkok.com/servicios/soap/cancel.wsdl';

		$this->set('title_for_layout', 'Ncredito CFDI Cancelación :: '.$id);

		$RFC= "JME910405B83";
		$path_CERT=APP.'files'.DS.'SAT'.DS.'SAT_CERT_JME910405B83.pem';
		$path_PKEY=APP.'files'.DS.'SAT'.DS.'SAT_PKEY_JME910405B83.pem';
		$pathDOCS=APP.'files'.DS.'comprobantesdigitales';

		$file_CERT = fopen($path_CERT, "r");
		$content_CERT = base64_encode(fread($file_CERT, filesize($path_CERT)));
		fclose($file_CERT);

		$file_PKEY = fopen($path_PKEY, "r");
		$content_PKEY = base64_encode(fread($file_PKEY, filesize($path_PKEY)));
		fclose($file_PKEY);



		if(!$item && !isset($item['Ncredito'])) {
			$this->set('result', "error");
			$this->set('message', 'Error en el Ensobretado del XML para Cancelacion. Ncredito: '.$item['Ncredito']['ncrefer']. ' (id:'.$item['Factura']['id'].')');
//			$this->Session->setFlash(__('invalid_item', true), 'error');
			return;			
		}
		$this->set('title_for_layout', 'Ncredito CFDI Cancelación :: '.$item['Ncredito']['farefer']);

		$textenv=
		'<?xml version="1.0" encoding="UTF-8"?>
		<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns2="uuid" xmlns:ns3="wis.soap.cacellation" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
		xmlns:ns1="http://facturacion.finkok.com/cancel" xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/"> 
		<SOAP-ENV:Header/> <ns0:Body> <ns1:cancel>
		<ns1:UUIDS><ns2:uuids><ns3:string>'.$UUID.'</ns3:string></ns2:uuids></ns1:UUIDS>
		<ns1:username>'.$pac_username.'</ns1:username>
		<ns1:password>'.$pac_password.'</ns1:password>
		<ns1:taxpayer_id>'.$RFC.'</ns1:taxpayer_id>
		<ns1:cer>'.$content_CERT.'</ns1:cer>
		<ns1:key>'.$content_PKEY.'</ns1:key>
		</ns1:cancel>
		</ns0:Body>
		</SOAP-ENV:Envelope>';

		$env = new DOMDocument();

		if( !$env->loadXML($textenv) ) {
			$this->set('result', "error");
			$this->set('message', 'Error en el Ensobretado del XML para Cancelacion. Ncredito: '.$item['Ncredito']['ncrefer'].' (id:'.$id.')');
			return;
		}

		// Envia XML dentro de un sobre SOAP
		$env->saveXML();
		$process = curl_init($pac_url_cancela);
		curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: text/xml', 'charset=utf-8'));
		curl_setopt($process, CURLOPT_POSTFIELDS, $env->saveXML());
		curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($process, CURLOPT_POST, true);
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);

		$res = curl_exec($process);
		if (!$res) {
			curl_close($process);
			$this->set('result', "error");
			$this->set('message', 'Error de comunicación al Webservice: '.curl_errno($process)." - ".curl_error($process));
			return;
		}
		curl_close($process);

//Guarda canceluuid y cancelfecha
		$findUUID = ':UUID>';
		$ini= strpos($res, $findUUID) + strlen($findUUID);
		if ($ini<= strlen($findUUID)){
//			echo "no hay UUID";
		}
		else{
		$cancelauuid = substr($res, $ini, 36);

		$findFecha = ':Fecha>';
		$iniF = strpos($res, $findFecha, $ini) + strlen($findFecha);
		$finF = strpos($res, ".", $iniF);
		$tam = $finF - $iniF;
		$cancelafecha = substr($res, $iniF, $tam);
		$cancelafecha = substr($cancelafecha,0,10).' '.substr($cancelafecha,11);


		$this->Ncredito->read(null, $id);
		if( !$this->Ncredito->save(
							array('cancelauuid'=> $cancelauuid, 'cancelafecha'=> $cancelafecha,
								),
							false,
							array('cancelauuid', 'cancelafecha',)
								)
		) {
			$this->set('result', "error");
			$this->set('message','No se pudieron registrar los datos de timbrado');
			return;			
		}
		}
//
		$myXML="";
		$xml = new DOMDocument();
		if (!$xml->loadXML($res)) {
			$this->set('result', "error");
			$this->set('message', 'Error al leer respuesta del PAC al Cancelar Ncredito '.$item['Ncredito']['ncrefer'].' (id: '.$id.')');
			$this->set('docto', $item);
			return false;
		}

		$searchNode = $xml->getElementsByTagName('xml');
		foreach($searchNode as $searchNode) {
			$myXML= $searchNode->nodeValue;
		}

		$myXML=str_replace('&gt;','>',$myXML);
		$myXML=str_replace('&lt;','<',$myXML);

		$filename= $RFC.'-'.$item['Ncredito']['ncrefer'].'.cancelada.xml';
		$xml->save($pathDOCS.DS.$filename);

		$this->set('result', 'ok' );
		$this->set('message', 'La Ncredito '.$item['Ncredito']['ncrefer'].' se canceló correctamente (id: '.$id.')');
		$this->set('data', $item);
		$this->set('textenv', $textenv);	
		$this->set('response', $this->Axfile->FileToString( $pathDOCS.DS.$filename ));	
	}

//Fin cancelacfdi	
	public function enviacorreo( $id=null ) {
		if(isset($this->params['url']['id'])) {
			$id=$this->params['url']['id'];
		}
		$data=null;

//		if( !$data || !is_array($data) || !isset($data['Master']['id']) ) {
		$data=json_decode($this->Ncredito->getDoctoForCFDI( $id ), TRUE);
//		}

		$sender = array(
			'subject'=>'Comprobante Digital.'.' Junior de Mexico'.'. '.
								'Ncredito: '.$data['Master']['folio'].' (uuid: '.
					$data['Master']['uuid']. '). '.	//$data['Master']['uuid']
								' ['.$data['Master']['fecha'].']',
			'from'=>'Comprobantes (Junior de Mexico) <comprobantes@oggi.com.mx>',
		);
		$receipt = array(
			'to'=>'comprobantes@oggi.mx, lev@oggi.mx',
//			'to'=>'lev@oggi.mx, azeron@oggi.mx, comprobantes@oggi.mx, almacen@oggi.mx, sera@oggi.mx',
			'replyTo'=>'comprobantes@oggi.com.mx',
		);

		$params = array(
			'template'=>'comprobantesdigitales',
			//Send as 'html', 'text' or 'both' (default is 'text')
			'sendAs'=>'text',
			'delivery'=>'smtp',
			'attachFiles'=>array(
								APP.DS.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['folio'].'.xml',
								APP.DS.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['folio'].'.pdf'
								)
		);

		$this->_sendemail($sender, $receipt, $params);

		$this->set('result', 'ok');
		$this->set('message', 'Se enviaron por correo los archivos XML y PDF al buzón <strong>'.$receipt['to'].'</strong>');
		$this->set('documento', $data);

		return json_encode(array(
					'result'=>'ok',
					'message'=>'Se enviaron por correo los archivos XML y PDF al buzón '.$receipt['to'].'.',
					));
	}

//Send EMail using SMTP 

function _sendemail($sender = array(), $receipt = array(), $params = array(), $body=null) {
//		$this->autoRender=false;

	$this->Email->smtpOptions = array(
		'port'=>'465',
		'timeout'=>'60',
		'host' => 'ssl://smtp.gmail.com',
		'username'=>'comprobantes@oggi.mx',
		'password'=>'micfdijunior',
	);

	if(!$body) $body='';

	$this->Email->to = $receipt['to'];
	$this->Email->subject = $sender['subject'];
	$this->Email->replyTo = $receipt['replyTo'];
	$this->Email->from = $sender['from'];
	$this->Email->template = $params['template'];
	$this->Email->attachments = $params['attachFiles'];
	//Send as 'html', 'text' or 'both' (default is 'text')
	$this->Email->sendAs = $params['sendAs']; // because we like to send pretty mail
	//Set view variables as normal
	$this->set('data', $body);
	//Do not pass any args to send()
	$this->Email->delivery = $params['delivery'];	
	$this->Email->send();
	return true;
}

	public function qrcode($id=null) {
		if(!$id) {
			$id=$this->params['url']['id'];
		}

		$appPath=APP.DS.'files/comprobantesdigitales/';
		$filename='JME910405B83-'.$id.'.png';
		$format='png';

		$this->view = 'Media';
		$params = array('id' => $filename,
						'name' => $filename,
						'download' => false,
						'extension' => $format,
						'path' => $appPath.DS);
		$this->set($params);
	}


	function download($id=null, $format='pdf') {
		if ( isset($params['named']['format']) && !empty($params['named']['format']) ) {
			$format=strtolower(trim($params['named']['format']));
		}
		if ( isset($params['url']['format']) && !empty($params['url']['format']) ) {
			$format=strtolower(trim($params['url']['format']));
		}

//		$appPath=APP;
		$appPath='/home/www/junior20cake/app/';

		$this->Ncredito->Recursive=0;
		$result=$this->Ncredito->read(null, $id);
		// The Requested ID doesn't exists
		if(!$result) { 
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		if($format=='pdf') {
			// Search the related media file
			$folder='pdf';
			$filename=trim($result['Ncredito']['ncrefer']).'.'.$format;
			if(!file_exists($appPath.'files'.DS.'facturaselectronicas'.DS.$folder.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$appPath.'files'.DS.'facturaselectronicas'.DS.$folder.DS.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
		}
		elseif ($format=='xml') {
			// Search the related media file
			$folder='xml';
			$filename='JME910405B83-'.trim($result['Ncredito']['ncrefer']).'.'.$format;
			if(!file_exists($appPath.'files'.DS.'facturaselectronicas'.DS.$folder.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
		}

		// Send the requested media file
		$this->view = 'Media';
		$params = array('id' => $filename,
						'name' => 'JME910405B83'.'-'.trim($result['Ncredito']['ncrefer']),
						'download' => true,
						'extension' => $format,
						'path' => $appPath . 'files'.DS.'facturaselectronicas'.DS.$folder.DS);
		$this->set($params);
	}

	function ver($id=null, $format='pdf') {

		if ( isset($params['named']['format']) && !empty($params['named']['format']) ) {
			$format=strtolower(trim($params['named']['format']));
		}
		if ( isset($params['url']['format']) && !empty($params['url']['format']) ) {
			$format=strtolower(trim($params['url']['format']));
		}

		$this->Ncredito->Recursive=0;
		$result=$this->Ncredito->read(null, $id);
		// The Requested ID doesn't exists
		if(!$result) { 
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

//		$appPath=APP;
//antes del 2014 buscar en APP.DS.'files'.DS.'facturaelectronica/xml' y 
//APP.DS.'files'.DS.'facturaelectronica/pdf'
		if($result['Ncredito']['ncfecha']>='2014-01-01') {
			$appPathPDF=APP.'files'.DS.'comprobantesdigitales';
			$appPathXML=APP.'files'.DS.'comprobantesdigitales';			
		}
		else {
			$appPathPDF=APP.'files'.DS.'facturaselectronicas'.DS.'pdf';
			$appPathXML=APP.'files'.DS.'facturaselectronicas'.DS.'xml';
		}

		if($format=='pdf') {
			// Search the related media file		
			$filename='JME910405B83-'.trim($result['Ncredito']['ncrefer']).'.'.$format;
			if(!file_exists($appPathPDF.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$appPathPDF.DS.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
		}
		elseif ($format=='xml') {
			// Search the related media file
			$filename='JME910405B83-'.trim($result['Ncredito']['ncrefer']).'.'.$format;
			if(!file_exists($appPathXML.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$appPathXML.DS.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}

		}

		// Send the requested media file
		$this->view = 'Media';
		$params = array('id' => $filename,
						'name' => 'JME910405B83-'.trim($result['Ncredito']['ncrefer']),
						'download' => true,
						'extension' => $format,
						'path' => ($format=='pdf'?$appPathPDF:$appPathXML).DS);
		$this->set($params);
	}

	public function getAllXmlByCliente($cliente_str=null) {
		if(!$cliente_str) {
			die("El formato de la URL debe ser: http://servidor.com/NcreditoElectronica/getAllXmlByCliente/XXXXXX/filename:archivo.zip\n<br/>XXXXX=Nombre o RFC del Cliente<br/>archivo.zip=Nombre del Archivo ZIP donde se empacaran los documentos encontrados");
		}
		if(isset($this->params['named']['filename'])) {
			$zipfilename=$this->params['named']['filename'];
		}
		elseif( isset($this->params['url']['filename']) ) {
			$zipfilename=$this->params['url']['filename'];
		}
		else {
			$zipfilename=''.date('Ymd').'.zip';
		}
		$cmd='sudo find . -type f  -name "JME910405B83*.xml" \( -name "*B00*" -or -name "*B-*" \) -exec grep -il "'.$cliente_str.'" "{}" \; |sort | zip /home/www/junior20cake/app/files/tmp/nuevomundo.xml.zip \@';

	}


		public function procesaxml() {
			$this->autoRender=false;
			$this->layout='ajaxclean';
			$theNcreditos=$this->Ncredito->find('all', array(
											'conditions'=>array('Ncredito.ncfecha >='=>'2012/01/01', 
																'Ncredito.ncfecha <='=>'2013/08/01',
																'Ncredito.ncrefer LIKE'=>'B%',
																'Ncredito.nct'=>0,
																'Ncredito.ncst'=>'A',
																),
											'fields'=>array('Ncredito.id','Ncredito.ncrefer','Ncredito.ncfecha',
															'Ncredito.crefec','Ncredito.modfec','Ncredito.ncst'),
											'order'=>'Ncredito.ncfecha ASC, Ncredito.id ASC'
											)
										);
			$xmlPath='/home/www/junior20cake/app/files/facturaselectronicas/xml';
			$pdfPath='/home/www/junior20cake/app/files/facturaselectronicas/pdf';
			$logPath='/home/www/junior20cake/app/files/facturaselectronicas';
			$folios_no_encontrados=array();
			$folios_renombrados=array();

			echo "\n\n<table style='width: 75%; border: 1px solid #000; padding: 2px; margin:0px;font-family: courier;font-size:10px;' >\n\n";
			ECHO "<thead><tr><th>RESULTADO</th><th>FOLIO</th><th>FECHA</th><th>ARCHIVO</th><th>NUEVO NOMBRE</th></tr></thead>";
			foreach($theNcreditos as $item) {
				$id=$item['Ncredito']['id'];
				$folio=$item['Ncredito']['ncrefer'];
				$folio_serie=substr($folio,0,1);
				$folio_numero=substr($folio,1,7);
				$fecha=$item['Ncredito']['ncfecha'];
				if($folio_numero && is_numeric($folio_numero)) $folio_numero=(int)$folio_numero;

				$filename='JME910405B83-'.$folio.'.xml';
				$filename2='JME910405B83 '.$folio_serie.'-'.$folio_numero.'.xml';
		//		echo "Factura: $folio  Serie::$folio_serie  Numero::$folio_numero Filename::$filename Full-Path::$xmlPath / $filename<br/>\n\n";
				if(file_exists($xmlPath.DS.$filename)) {
	//				echo "El Archivo $xmlPath".DS."$filename Existe! <br/>\n\n"; 
				}
				elseif(file_exists($xmlPath.DS.$filename2)) {
			//		echo "<li>RENOMBRE: #FOLIO:$folio #FECHA:$fecha #FILENAME: $filename</li>";
					echo "<tr><td>RENOMBRADO</td><td style='font-weigth: bold;'>$folio</td><td>$fecha</td><td>$filename2</td><td>$filename</td></tr>";
		//			echo "El Archivo $xmlPath".DS."$filename2 Existe y se RENOMBRO! <br/> \n\n";
		//			rename($xmlPath.DS.$filename2, $xmlPath.DS.$filename);
					$folios_renombrados[]=array('id'=>$id,'ncrefer'=>$folio,'ncfecha'=>$fecha,'oldName'=>$filename2,'newName'=>$filename);
				}
				else {
					echo "<tr><td>FALTA</td><td style='font-weigth: bold;'>$folio</td><td>$fecha</td><td>$filename</td><td></td></tr>";
					$folios_no_encontrados[]=array('id'=>$id,'ncrefer'=>$folio,'ncfecha'=>$fecha);
				}
			}
			echo "\n\n<table/>\n\n";
			echo "TOTAL DE FOLIOS RENOMBRADOS: ".count($folios_renombrados)." <br/>\n\n";
			echo "TOTAL DE FOLIOS NO ENCONTRADOS: ".count($folios_no_encontrados)." <br/>\n\n";
			$this->Axfile->StringToFile($logPath.'/folios_no_encontrados.20130801.json', json_encode($folios_no_encontrados) );
			$this->Axfile->StringToFile($logPath.'/folios_renombrados.20130801.json', json_encode($folios_renombrados) );
			die();
		}

	public function generacfdi2($id=null) {
		if (!$id) {
			if(isset($this->params['url']['id'])) {
				$id=$this->params['url']['id'];
			}
			else {
				$this->Session->setFlash(__('invalid_item', true), 'error');
				return;
			}
		}

		if (isset($this->params['mailcfdi'])) {
			$mailcfdi=$this->params['mailcfdi'];
		}
		else {
			$mailcfdi=true;
		}

		$responses=array();

		// Generamos el XML con Cadena Original y Sello
		$docto=$this->Ncredito->getDoctoForCFDI( $id );

		$docto_arr=json_decode($docto);

		$this->set('title_for_layout', 'Ncredito CFDI');

		if ( !$this->AxFolioselectronicos->createCFDI2( $docto ) ) {
			$this->set('result', "error");
			$this->set('message', "ERROR EN CREATECFDI:".$this->AxFolioselectronicos->message);
			return;
//			$this->Session->setFlash($this->AxFolioselectronicos->message, 'error');
		}
		else {
			$responses[]=array('default','Creación del XML, Cadena Original y Sello Digital',
							$this->AxFolioselectronicos->message);

		}
		die();

		$responses[]=array('success', 'Timbrado del CFDI con el PAC <small>(conexción al webservice del proveedor)</small>', json_encode($this->AxFolioselectronicos->documento) );
		//					$this->AxFolioselectronicos->pacResponse );


		$this->set('result', 'ok');
		$this->set('message', 'Se generó el comprobante digital CFDI de la Ncredito <strong>'.$this->AxFolioselectronicos->documento['folio'].'</strong> '.
							' (uuid: '.$documento['UUID'].' fecha: '.$documento['FechaTimbrado'].')'); //$docto['Master']['uuid']
		$this->set('title_for_layout', 'Ncredito CFDI::'.$this->AxFolioselectronicos->documento['folio']);
		$this->set('docto', json_decode($docto));
		$this->set('documento', $documento);
		$this->set('responses', $responses);
	}

}