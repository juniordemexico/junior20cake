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
	
	function index() {
		$this->Factura->recursive = 0;
		$this->paginate = array(
								'update' => '#content',
								'evalScripts' => true,
								'limit' => 10,
								'order' => array('Factura.farefer' => 'desc'),
								'fields' => $this->tableFields,
								'conditions' => array("Factura.crefec >" => date('Y-m-d', strtotime("-36 months")),'Factura.faT'=>'0'),
								'doJoinUservendedor'=>true,
								'session' => $this->Auth->User(),
								);

		$filter = $this->Filter->process($this);
		$this->set('facturas', $this->paginate($filter));
	}
	
	public function generaxml($id=null) {
		if (!$id) {
			if(isset($this->params['url']['id'])) {
				$id=$this->params['url']['id'];
			}
			else {
				die("ERROR. NO PASA EL ID");
			}
		}
		
		$docto=$this->Factura->getDoctoForCFDI( $id );		// Obtenemos los datos del documento desde el Modelo Factura
		
		if (!$this->AxFolioselectronicos->createCFDI( $docto )) echo "NO PUS NO SE CREO NADA";		// Pasamos el documento en formato json
//		$this->AxFolioselectronicos->generaXML();
//		echo '<pre>getXML():: '.$this->AxFolioselectronicos->getXML()."</pre>";	// Devuelve el XML
		echo "<br/>\n\r";
//		$cadena= $this->AxFolioselectronicos->generaCadenaOriginal();	// Devuelve la Cadena Original
//		echo '<pre>generaCadenaOriginal():: '.$cadena.'</pre>';
//		$cfdi= $this->AxFolioselectronicos->generaSello();		// Devuelve el Sello Digital
		echo '<pre>getSello()::'.$this->AxFolioselectronicos->getSello().'</pre>';
		echo '<pre>getCadenaOriginal()::'.$this->AxFolioselectronicos->getCadenaOriginal().'</pre>';
//		echo '<pre>getXML()::'.$this->AxFolioselectronicos->getXML().'</pre>';
		$cfdi= $this->AxFolioselectronicos->getCFDI();		// Devuelve el Sello Digital
		echo 'getCFDI()::<br/><br/>'; echo htmlspecialchars($cfdi);
//		$this->AxFolioselectronicos->timbrarComprobanteFiscal($cfdi); // Envia el documento a timbrar por medio del Webservice
		
/*
		$fac = new timbradoCFDi();
		$fac->setData($data);

		echo $fac->getXML()."<br>";
		$cadena= $fac->obtenerCadenaOriginal();
		$cfdi= $fac->generarSello($cadena);
		$fac->timbrarComprobanteFiscal($cfdi);
*/
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
//		echo json_encode($theFacturas);
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
