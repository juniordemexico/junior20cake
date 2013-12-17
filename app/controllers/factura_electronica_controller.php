<?php

class FacturaElectronicaController extends MasterDetailAppController {

	var $uses = array('Factura','Cliente','Vendedor','Divisa');

	var $cacheAction = array();

	var $tableFields = 	array(
							'id','farefer','fafecha','fat','fast','fasuma','faimporte','faimpoimpu','fatotal',
							'fapedido',
							'cliente_id','Cliente.clcvecli','Cliente.cltda','Cliente.clnom','Cliente.clsuc',
							'vendedor_id','Vendedor.vecveven','Vendedor.venom','fadivisa',
							'crefec','modfec');
	var $layout = 'plain';
	
	var $pathDOCS;
	
	function index() {
		$this->Factura->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 20,
								'order' => array('Factura.farefer' => 'desc'),
								'fields' => $this->tableFields,
								'conditions' => array("Factura.crefec >" => date('Y-m-d', strtotime("-36 months")),'Factura.faT'=>'0'),
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);

		$filter = $this->Filter->process($this);
		$this->set('facturas', $this->paginate($filter));
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
		$this->layout='pdf';
		$this->set('result', 'ok' );
		$this->set('data', $data );
		$this->set('title_for_layout', ucfirst($this->name).'::'.
					$data['Master'][$this->masterModelTitle]
				);
	}


	public function generacfdi($id=null) {
		if (!$id) {
			if(isset($this->params['url']['id'])) {
				$id=$this->params['url']['id'];
			}
			else {
			$this->set('result', "error");
			$this->set('message', "Item Invalido");
			return;
//				$this->Session->setFlash(__('invalid_item', true), 'error');
//				$this->redirect(array('action' => 'index'));
			}
		}

//ini_set('error_reporting', E_ALL & ~E_WARNING & ~E_NOTICE );
//error_reporting( E_ALL & ~E_WARNING & ~E_NOTICE );

		if (isset($this->params['mailcfdi'])) {
			$mailcfdi=$this->params['mailcfdi'];
		}
		else {
			$mailcfdi=true;
		}
		
		$responses=array();
//		$this->set('responses', $responses);

		// Generamos el XML con Cadena Original y Sello
		$docto=$this->Factura->getDoctoForCFDI( $id );

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

		if ( !$this->AxFolioselectronicos->timbrarComprobanteFiscal() ) { 
			$this->set('result', "error");
			$this->set('message','Error al Timbrar CFDI: ' . $this->AxFolioselectronicos->message);
			$responses[]=array('info', 'RESULTADO MAL DEL TIMBREADO',
							$this->AxFolioselectronicos->message);
			return;
//			$this->Session->setFlash('Error al Timbrar CFDI: ' . $this->AxFolioselectronicos->message, 'error');
		}

		// Pasa los datos obtenidos a la vista
//		$responses[]=array('success', 'Timbrado del CFDI con el PAC <small>(conexción al webservice del proveedor)</small>',
//							$this->AxFolioselectronicos->message);

	//	$responses[]=array('success', 'Respuesta del PAC',
	//						);
		
		$responses[]=array('success', 'Timbrado del CFDI con el PAC <small>(conexción al webservice del proveedor)</small>', json_encode($this->AxFolioselectronicos->documento) );
		//					$this->AxFolioselectronicos->pacResponse );

//		$pdfResult=$this->requestAction('/FacturaElectronica/imprimepdf/'+$id);
//		$responses[]=array('info', 'El archivo PDF se generó :: '.$pdfResult );

//		$this->_enviacorreo($id);

//		$mailResult=$this->requestAction('/FacturaElectronica/enviacorreo/'+$id.'.json');
//		if($mailResult && is_array($mailResult) && count($mailResult)>0) {
//			$responses[]=array('success', $mailResult['message']);
//		}
//		else {
//			$responses[]=array($mailResult['result']=='ok'?'success':'error', 'Envio de XML y PDf por Email al Cliente', $mailResult['message']);			
//		}

		$this->set('result', 'ok');
		$this->set('message', 'Se generó el comprobante digital CFDI de la Factura <strong>'.$this->AxFolioselectronicos->documento['folio'].'</strong>');
							//	' (uuid: '.'99999.999999-777-55'.')'); //$docto['Master']['uuid']
		$this->set('docto', json_decode($docto));
		$this->set('documento', $this->AxFolioselectronicos->documento);
		$this->set('responses', $responses);

//		$this->render("generacfdi");
	}

	
	public function enviacorreo( $id=null ) {
//		$this->autoRender=false;
		if(isset($this->params['url']['id'])) {
			$id=$this->params['url']['id'];
		}
		$data=null;
//		if( !$data || !is_array($data) || !isset($data['Master']['id']) ) {
			$data=json_decode($this->Factura->getDoctoForCFDI( $id ), TRUE);
//		}

		$sender = array(
			'subject'=>'Comprobante Digital.'.' Junior de Mexico'.'. '.
								'Factura: '.$data['Master']['folio'].'. '.
					'99999-87777-444-33'. '. '.	//$data['Master']['uuid']
								' ['.$data['Master']['fecha'].']',
			'from'=>'Comprobantes Oggi <azeron@oggi.mx>',
		);
		$receipt = array(
//			'to'=>'azeron@oggi.mx, lev@oggi.mx',
			'to'=>'lev@oggi.mx, azeron@oggi.mx, aperez@oggi.mx, sera@oggi.mx',
			'replyTo'=>'azeron@oggi.mx',
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
//					'data'=>$data
					));
	}

//Send EMail using SMTP 

	function _sendemail($sender = array(), $receipt = array(), $params = array(), $body=null) {
//		$this->autoRender=false;
	
		$this->Email->smtpOptions = array(
			'port'=>'465',
			'timeout'=>'60',
			'host' => 'ssl://smtp.gmail.com',
			'username'=>'azeron.oggi@gmail.com',
			'password'=>'S0p0r1f3R022',
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
		
		$this->Factura->Recursive=0;
		$result=$this->Factura->read(null, $id);
		// The Requested ID doesn't exists
		if(!$result) { 
			$this->Session->setFlash(__('invalid_item', true), 'error');
			$this->redirect(array('action' => 'index'));
		}

		if($format=='pdf') {
			// Search the related media file
			$folder='pdf';
			$filename=trim($result['Factura']['farefer']).'.'.$format;
			if(!file_exists($appPath.'files'.DS.'facturaselectronicas'.DS.$folder.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$appPath.'files'.DS.'facturaselectronicas'.DS.$folder.DS.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
		}
		elseif ($format=='xml') {
			// Search the related media file
			$folder='xml';
			$filename='JME910405B83-'.trim($result['Factura']['farefer']).'.'.$format;
			if(!file_exists($appPath.'files'.DS.'facturaselectronicas'.DS.$folder.DS.$filename)) {
				$this->Session->setFlash(__('file does not exist', true).': '.$filename, 'error');
				$this->redirect(array('action' => 'index'));			
			}
			
		}

		// Send the requested media file
		$this->view = 'Media';
		$params = array('id' => $filename,
						'name' => 'JME910405B83'.'-'.trim($result['Factura']['farefer']),
						'download' => true,
						'extension' => $format,
						'path' => $appPath . 'files'.DS.'facturaselectronicas'.DS.$folder.DS);
		$this->set($params);
	}

	public function getAllXmlByCliente($cliente_str=null) {
		if(!$cliente_str) {
			die("El formato de la URL debe ser: http://servidor.com/FacturaElectronica/getAllXmlByCliente/XXXXXX/filename:archivo.zip\n<br/>XXXXX=Nombre o RFC del Cliente<br/>archivo.zip=Nombre del Archivo ZIP donde se empacaran los documentos encontrados");
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
		$theFacturas=$this->Factura->find('all', array(
										'conditions'=>array('Factura.fafecha >='=>'2012/01/01', 
															'Factura.fafecha <='=>'2013/08/01',
															'Factura.farefer LIKE'=>'B%',
															'Factura.fat'=>0,
															'Factura.fast'=>'A',
															),
										'fields'=>array('Factura.id','Factura.farefer','Factura.fafecha',
														'Factura.crefec','Factura.modfec','Factura.fast'),
										'order'=>'Factura.fafecha ASC, Factura.id ASC'
										)
									);
		$xmlPath='/home/www/junior20cake/app/files/facturaselectronicas/xml';
		$pdfPath='/home/www/junior20cake/app/files/facturaselectronicas/pdf';
		$logPath='/home/www/junior20cake/app/files/facturaselectronicas';
		$folios_no_encontrados=array();
		$folios_renombrados=array();

		echo "\n\n<table style='width: 75%; border: 1px solid #000; padding: 2px; margin:0px;font-family: courier;font-size:10px;' >\n\n";
		ECHO "<thead><tr><th>RESULTADO</th><th>FOLIO</th><th>FECHA</th><th>ARCHIVO</th><th>NUEVO NOMBRE</th></tr></thead>";
		foreach($theFacturas as $item) {
			$id=$item['Factura']['id'];
			$folio=$item['Factura']['farefer'];
			$folio_serie=substr($folio,0,1);
			$folio_numero=substr($folio,1,7);
			$fecha=$item['Factura']['fafecha'];
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
				$folios_renombrados[]=array('id'=>$id,'farefer'=>$folio,'fafecha'=>$fecha,'oldName'=>$filename2,'newName'=>$filename);
			}
			else {
				echo "<tr><td>FALTA</td><td style='font-weigth: bold;'>$folio</td><td>$fecha</td><td>$filename</td><td></td></tr>";
				$folios_no_encontrados[]=array('id'=>$id,'farefer'=>$folio,'fafecha'=>$fecha);
			}
		}
		echo "\n\n<table/>\n\n";
		echo "TOTAL DE FOLIOS RENOMBRADOS: ".count($folios_renombrados)." <br/>\n\n";
		echo "TOTAL DE FOLIOS NO ENCONTRADOS: ".count($folios_no_encontrados)." <br/>\n\n";
		$this->Axfile->StringToFile($logPath.'/folios_no_encontrados.20130801.json', json_encode($folios_no_encontrados) );
		$this->Axfile->StringToFile($logPath.'/folios_renombrados.20130801.json', json_encode($folios_renombrados) );
		die();
	}

}


/*
		$this->Email->smtpOptions = array(
						'port'=>'465',
						'timeout'=>'60',
						'host' => 'ssl://smtp.gmail.com',
						'username'=>'lev@oggi.mx',
						'password'=>'3l3ctr0n35',
		);

		$this->Email->to = 'lev@oggi.mx';
		$this->Email->bcc = array('lev@oggi.com.mx');
		$this->Email->subject = 'Comprobante Digital.'.' Junior de Mexico'.'. '.
								'Factura: '.$docto['Master']['folio'].'. '.
								$docto['Master']['uuid'].'. '.
								' ['.$docto['Master']['fecha'].']';
		$this->Email->replyTo = 'lev@oggi.mx';
		$this->Email->from = 'Comprobantes Oggi <lev@oggi.mx>';
		$this->Email->template = 'comprobantesdigitales'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'text'; // because we like to send pretty mail
		//Set view variables as normal
		$this->set('data', $docto);
		//Do not pass any args to send()
		$this->Email->delivery = 'smtp';	
		$this->Email->send();
		*
		*
	http://erpdev.oggi.net.mx/FacturaElectronica/generacfdi/6312150
*/
