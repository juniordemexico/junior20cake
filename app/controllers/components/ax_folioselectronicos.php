<?php

class AxFolioselectronicosComponent extends Component {

	public $json_dec;
	public $envtext;
	public $version;

	public $_cert;
	public $_pkey;
	public $certificado;
	public $certificadoSerial;
	
	public $_data;

	public $xml;
	public $cfdi;
	public $cfdiSigned;
	public $pacResponse=null;
	public $cadenaoriginal;
	public $sello;

	public $documento= array();

	public $message='';


	function startup( &$controller ) {
		$this->controller =& $controller;
		$this->version='3.2';
		$this->pathCERT=APP.'files'.DS.'SAT'.DS.'SAT_CERT_JME910405B83.pem';
		$this->pathPKEY=APP.'files'.DS.'SAT'.DS.'SAT_PKEY_JME910405B83.pem';
//		$this->pathCERT=APP.'files'.DS.'SAT'.DS.'aad990814bp7_1210261233s.cer.pem';
//		$this->pathPKEY=APP.'files'.DS.'SAT'.DS.'aad990814bp7_1210261233s.key.pem';
		$this->pathDOCS=APP.'files'.DS.'comprobantesdigitales';
		$this->pathTEMP=APP.'files'.DS.'comprobantesdigitales'.DS.'tmp';
		$this->pathXSLT=APP.'files'.DS.'SAT'.DS.'cadenaoriginal_3_2.local.xslt';
							
		// Carga el certificado y llave privada
		if( !$this->loadCert() ) {
			$this->message='Error cargando Certificado y Llave Privada';
			return false;
		}

	}

	public function initCFDI() {
		$this->_data=array();
		$this->sello=null;
		$this->cadenaoriginal=null;
		$this->xml='';
		$this->documento=array(
							'id'=>null,
							'uuid'=>null,
							'tipo'=>null,
							'folio'=>null,
							'serie'=>null,
							'consecutivo'=>null,
							'fecha'=>null,
							'emisor_rfc'=>null,
							'receptor_rfc'=>null,
							'cadenaoriginal'=>null
							);		
	}

	public function createCFDI( $data = null ) {

		// Inicializa los datos del documento
		$this->initCFDI();

		// Si nos pasan los datos en json, los ponemos en la propiedad _data en forma de arreglo
		if($data && is_string($data) && !empty($data)) $this->setData($data);
		
		// Genera el XML basico, sin sello, ni cadena original
		if( !$this->generaXML() ) {
			$this->message='Error generando el XML inicial';
			return false;
		}
		
		// Genera la Cadena Original a partir del XML generado en primer termino
		if( !$this->generaCadenaOriginal() ) return false;
				
		// Genera el Sello para el XML usando el Certificado y Llave Privada
		if( !$this->generaSello() ) return false;

		return true;
	}


	public function loadCert($fileCERT = null, $filePKEY = null) {
		if($fileCERT && !empty($fileCERT)) { $this->pathCERT=$fileCERT; }
		if($filePKEY && !empty($filePKEY)) { $this->pathPKEY=$filePKEY; }

		$this->_cert = $this->controller->Axfile->FileToString( $this->pathCERT );
		$this->_pkey = $this->controller->Axfile->FileToString( $this->pathPKEY );

		if ( !($this->_cert && !empty($this->_cert) && $this->_pkey && !empty($this->_pkey)) ) {
			$this->message='Error al cargar Certificado';
			return false;
		}

		if( !( $cert509 = openssl_x509_read( $this->_cert . $this->_pkey )) ) {
			$this->message='El Certificado NO se pudo leer.';
			return false;
		}
		
		$_data = openssl_x509_parse($cert509);
		$serial1 = $_data['serialNumber'];
		$serial2 = gmp_strval($serial1, 16);
		$serial3 = explode("\n", chunk_split($serial2, 2, "\n"));
		$serial = "";
		foreach ($serial3 as $serialt) {
			if (2 == strlen($serialt))
				$serial .= chr('0x' . $serialt);
		}

		$serial="00001000000200904226";
//		$serial='20001000000200000293';
		$this->certificadoSerial = $serial;

		unset($serial1, $serial2, $serial3, $serialt, $_data, $cert509);
		preg_match('/-----BEGIN CERTIFICATE-----(.+)-----END CERTIFICATE-----/msi', $this->_cert, $matches) or die("No certificado\n");
		$algo = $matches[1];
		$algo = preg_replace('/\n/', '', $algo);
		$this->certificado = preg_replace('/\r/', '', $algo);

		return true;
	}

	public function setData($data)
	{
		$this->_data=json_decode($data, TRUE);
		$this->documento['id']=$this->_data['Master']['id'];
		$this->documento['fecha']=substr($this->_data['Master']['fecha'],0,10).'T'.substr($this->_data['Master']['fecha'],11,8);
		$this->documento['folio']=$this->_data['Master']['folio'];
		$this->documento['serie']=substr($this->_data['Master']['folio'],0,1);
		$this->documento['consecutivo']=substr($this->_data['Master']['folio'],1,8);
		$this->documento['total']=round($this->_data['Master']['total'],2);
//		$this->documento['emisor_rfc']='AAD990814BP7';
		$this->documento['emisor_rfc']=$this->_data['Emisor']['emrfc'];
		$this->documento['receptor_rfc']=$this->_data['Receptor']['clrfc'];

		$this->documento['fecha']=date('Y-m-d').'T'.date('H:i:s',time()-300);

		return true;
	}

	public function generaXML() {

		$m=$this->_data['Master'];
		$d=$this->_data['Details'];
		$e=$this->_data['Emisor'];
		$r=$this->_data['Receptor'];

		if(!isset($this->documento['fecha']) || !$this->documento['fecha']) {
			$this->documento['fecha']=date("Y-m-d").'T'.date("H:i:s");
		}
		
		// Datos del Comprobante Digital
		$comprobante=
		'serie="'.$this->documento['serie'].'" '.
		'folio="'.$this->documento['consecutivo'].'" '.
		'fecha="'.$this->documento['fecha'].'" '.
		'sello="" '.
		'NumCtaPago="'.$m['pago_numcta'].'" '.
		'TipoCambio="'.(isset($m['tcambio']) && $m['tcambio']<>0 ? round($m['tcambio'],4):'1').'" '.
		'Moneda="'.trim($m['divisa_cve']).'" '.
		'formaDePago="'.'TRANSFERENCIA'.'" '.
		'noCertificado="'.$this->certificadoSerial.'" '.
		'certificado="'.$this->certificado.'" '.
		'condicionesDePago="'.(isset($m['plazo']) && $m['plazo']<>0 ? $m['plazo']:'0').'" '.
		'subTotal="'.round($m['importe'],2).'" '.
		'total="'.round($m['total'],2).'" '.
		'tipoDeComprobante="'.$m['comprobante_tipo'].'" '.
		'metodoDePago="'.$m['metodo_pago'].'" '.
		'LugarExpedicion="'.$e['emedo'].'" '.
		'xmlns:cfdi="http://www.sat.gob.mx/cfd/3"> ';

		// Datos del Emisor del Comprobante 
		// (nuestra razon social: direccion fiscal y direccion de expedicion)
		$emisor=
		'<cfdi:Emisor rfc="'.$e['emrfc'].'" '.
		'nombre="'.$e['emnom'].'">'.
		'<cfdi:DomicilioFiscal '.
		'calle="'.$e['emcalle'].'" '.
		'noExterior="'.$e['emnumext'].'" '.
//		'noInterior="'.$e['emnumint'].'" '.
		'colonia="'.$e['emcol'].'" '.
		'municipio="'.$e['emciu'].'" '.
		'estado="'.$e['emedo'].'" '.
		'pais="'.$e['empais'].'" '.
		'codigoPostal="'.$e['emcp'].'" '.
		'/>'.
		'<cfdi:ExpedidoEn '.
		'calle="Av. Viaducto La Piedad" '.
		'noExterior="11111" '.
		'localidad="Distrito Federal" '.
		'municipio="Gustavo A Madero" '.
		'estado="Distrito Federal" '.
		'pais="Mexico" '.
		'codigoPostal="06000" '.
		'/>'.		
		'<cfdi:RegimenFiscal Regimen="'.$e['regimen_fiscal'].'" />'.
		'</cfdi:Emisor>';

		// Datos del receptor (cliente al que se le expide el comprobante)
		$receptor=
		'<cfdi:Receptor rfc="'.$r['clrfc'].'" '.'nombre="'.$r['clnom'].'">'.
		'<cfdi:Domicilio calle="'.(!empty($r['clcalle'])?$r['clcalle']:'NA').'" '.
		'noExterior="'.(!empty($r['clnumext'])?$r['clnumext']:'NA').'" '.
		'colonia="'.(!empty($r['clcolonia'])?$r['clcolonia']:'NA').'" '.
		'municipio="'.(!empty($r['clciu'])?$r['clciu']:'NA').'" '.

		'estado="'.(!empty($r['cledo'])?$r['cledo']:'NA').'" '.
		'pais="'.(!empty($r['clpais'])?$r['clpais']:'NA').'" '.
		'codigoPostal="'.(!empty($r['clcp'])?$r['clcp']:'NA').'" '.
		'/>'.
		'</cfdi:Receptor> ';

		// Total y translados de Impuestos que aplican al Comprobante
		$traslados=
		'<cfdi:Impuestos>'.
		'<cfdi:Traslados>'.
		'<cfdi:Traslado importe="'.round($m['impoimpu'],2).'" impuesto="'.$m['impuesto_cve'].'" tasa="'.$m['impuesto_tasa'].'"/>'.
		'</cfdi:Traslados>'.
		'</cfdi:Impuestos>';


		// Seccion de Conceptos (son las partidas o items que el comprobante contiene)
		$conceptos="<cfdi:Conceptos>";
		foreach($d as $detalle) {
			$conceptos.=
			'<cfdi:Concepto '.
			'cantidad="'.floor($detalle['cant']).'" '.
			'unidad="'.trim($detalle['unidad_cve']).'" '.
			'descripcion="('.trim($detalle['arcveart']).') '.trim($detalle['ardescrip']).'" '.
			'valorUnitario="'.round($detalle['precio'],2).'" '.
			'importe="'.round($detalle['importe'],2).'" '.
			'/>';
		}
		$conceptos=$conceptos."</cfdi:Conceptos>";

		// Ensambla el XML (todavia sin cadena original, ni sello)
		$this->xml='<?xml version="1.0" encoding="utf-8"?>'.
					'<cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 '.
					'http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" version="'.$this->version.'" '.
					$comprobante.$emisor.$receptor.$conceptos.$traslados.
					'</cfdi:Comprobante>';
//		$this->controller->Axfile->StringToFile($this->pathDOCS.DS.$this->documento['emisor_rfc'].'-'.$this->documento['folio'].'.fuente.xml', $this->xml);

		return true;
	}


	function generaCadenaOriginal()
	{

		$myDom = new DOMDocument();
		$myDom->loadXML($this->xml);

//ini_set('error_reporting', E_ALL & ~E_WARNING & ~E_NOTICE );
//error_reporting( E_ALL & ~E_WARNING & ~E_NOTICE );
		Configure::write('debug', 0);

		$xslt = new XSLTProcessor();
		$XSL = new DOMDocument();
		$XSL->load($this->pathXSLT, LIBXML_NOCDATA);
		$c = $myDom->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);

		ob_start();
		
		$xslt->importStylesheet($XSL);
		ob_end_clean();
		$this->cadenaoriginal = $xslt->transformToXML( $c );

		if( !$this->cadenaoriginal || empty($this->cadenaoriginal) ) {
			$this->message='Error al generar la cadena original ('.xslt_error($xslt).')';
			return false;
		}

		$this->documento['cadenaoriginal'] = $this->cadenaoriginal;

		$this->message='La cadena original se genero correctamente';
		return true;
	}

	function generaSello()
	{
		$key = openssl_pkey_get_private($this->_cert . $this->_pkey);
		if( !$key ) {
			$this->message='La llave privada NO se identifico';
			return false;
		}
		$crypttext = "";
		openssl_sign($this->cadenaoriginal, $crypttext, $key, OPENSSL_ALGO_SHA1); // "sha1"
		$this->sello = base64_encode($crypttext);

		$myDom = new DOMDocument();

		$myDom->loadXML($this->xml);
		$c = $myDom->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);

		$c->setAttribute('sello', $this->sello);

		$this->cfdi = $myDom->saveXML();
		if( !$this->cfdi || !isset($this->cfdi) || empty($this->cfdi) ) {
			$this->message='Error al generar el archivo XML para timbrado.';
			return false;
		}
		
		$this->controller->Axfile->StringToFile($this->pathDOCS.DS.$this->documento['emisor_rfc'].'-'.$this->documento['folio'].'.fuente.xml', $this->cfdi);
//		echo "<div><h3>XML sellado</h3><pre>"; echo htmlspecialchars($this->cfdi); echo "</pre></div>";

		$this->message='Se generó el XML sellado para timbrar';
		return true; 
	}


	function timbrarComprobanteFiscal() {
		$envtext = 
		'<?xml version="1.0" encoding="UTF-8"?>
		<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
		xmlns:ns1="http://facturacion.finkok.com/stamp" xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/"> 
		<SOAP-ENV:Header/> <ns0:Body> <ns1:stamp> 
		<ns1:xml>'.base64_encode($this->cfdi).'</ns1:xml>
		<ns1:username>v.islas.padilla@gmail.com</ns1:username>
		<ns1:password>27Marzo!</ns1:password>
		</ns1:stamp>
		</ns0:Body>
		</SOAP-ENV:Envelope>';



		$env = new DOMDocument();
		
		if( !$env->loadXML($envtext) ) {
			$this->message='Error en el Ensobretado del XML. No se pudo timbrar.';
			return false;
		}
//		echo "<div><h3>XML sellado y ensobretado</h3><pre>"; echo htmlspecialchars($envtext); echo "</pre></div>";
		
		// Hacemos peticion al Webservice del PAC. Enviando el XML dentro de un sobre SOAP
		$env->saveXML();
		$process = curl_init('http://demo-facturacion.finkok.com/servicios/soap/stamp.wsdl');
		curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: text/xml', 'charset=utf-8'));
		curl_setopt($process, CURLOPT_POSTFIELDS, $env->saveXML());
		curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($process, CURLOPT_POST, true);
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($process, CURLOPT_SSLCERTPASSWD, 'AAAI8204261TA');
		$timbre = curl_exec($process);
//		echo "<h3>Timbre::</h3>";
//		pr($timbre);
		if (!$timbre) {
			$this->message='Error de comunicación al Webservice: '.curl_errno($process)." - ".curl_error($process);
			curl_close($process);
			return false;
		}
		curl_close($process);

//		echo "<h1>RESPONSE</h1>"."<pre style='width: 400px;'>".htmlspecialchars($timbre)."</pre>";
		
		$this->pacResponse=$timbre;

		$myXML="";
		$xml = new DOMDocument();
		if ( !$xml->loadXML($timbre) ) {
			$this->message='Error al leer la respuesta del PAC';
			return false;
		}

		$searchNode = $xml->getElementsByTagName('xml');
		foreach ( $searchNode as $searchNode) {
			$myXML= $searchNode->nodeValue;
		}
		$myXML=str_replace('&gt;','>',$myXML);
		$myXML=str_replace('&lt;','<',$myXML);
		$xml2 = new DOMDocument();
		if ( !$xml2->loadXML($myXML) ) {
			$this->message='Se presento un error en el documento a timbrar.';
			return false;
		}

		$cfdi = $xml2->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', '*');

		foreach ( $cfdi as $cfdi) {
			$this->documento['noCertificadoSAT'] = $cfdi->getAttribute('noCertificadoSAT');
			$this->documento['selloSAT'] = $cfdi->getAttribute('selloSAT');
			$this->documento['selloCFD'] = $cfdi->getAttribute('selloCFD');
			$this->documento['FechaTimbrado'] = $cfdi->getAttribute('FechaTimbrado');
			$this->documento['UUID'] = $cfdi->getAttribute('UUID');
		}

		if($this->documento['selloSAT']=='' || $this->documento['UUID']=='' ) {
			$this->message="Surgió un error y no fue posible timbrar el documento ".$this->documento['folio'];
			return false;
		}

		$this->documento['filename']=$this->documento['emisor_rfc'].'-'.$this->documento['folio'].'.xml';
		$xml2->save($this->pathDOCS.DS.$this->documento['filename']);
	//	$this->cfdiSigned=;
		
		// Generamos el Codigo QR del documento y lo guardamos en un archivo
		if( !$this->generaqr() ) {
			return false;
		}

		$this->message='Se creó el CFDi '.$this->documento['folio'].' ('.$this->documento['filename'].')';
		return true;
	}

	public function generaqr() {
		$total=str_pad((int)$this->_data['Master']['total'], 10, '0', STR_PAD_LEFT);
		$decimal=''.$this->_data['Master']['total']-(int)$total;
		$decimal=str_pad($decimal, 6, '0', STR_PAD_RIGHT);
		$total=$total.'.'.$decimal; //'0000050456.450000';
		$data=	'?re='.$this->documento['emisor_rfc'].
				'&rr='.$this->documento['receptor_rfc'].
				'&tt='.$total.
				'&id='.$this->documento['UUID'];
		$filename=$this->documento['emisor_rfc'].'-'.$this->documento['folio'].'.png';
		QRcode::png($data, $this->pathDOCS.DS.$filename, 'M', 4, 2);
		if (!file_exists($this->pathDOCS.DS.$filename)) {
			$this->message='Error NO se pudo generar el código QR';
			return false;
		}
		$this->message='Se generó el Código QR para el CFDi '.$this->documento['folio'].' ('.$data.')';
		return true;
	}

/*
GENERAR SELLO DE UN SOLO PASO
sed -i -e 's:sello=\"\":sello=\"'$(xsltproc cadenaoriginal_2_0.xslt factura.xml | openssl dgst -sha1 -sign aaa010101aaa_csd_08.key.pem | openssl enc -base64 -A)'":' factura.xml

*/

/*
	public function pem2der($param_type, $param_value) {
		if ($param_type==AX_PARAM_FILE) {				// If the cert file's path is passed
			$pem_data = file_get_contents($param_value);
		}
		else {											// If the cert is passed as a string
			$pem_data = $param_value;
		}
		$begin = "CERTIFICATE-----";
		$end   = "-----END";
		$der = substr($pem_data, strpos($pem_data, $begin)+strlen($begin));    
		$der = substr($pem_data, 0, strpos($pem_data, $end));
		$der = base64_decode($param_value);
		return $der;
	}

	function der2pem($param_type, $param_value) {
		if ($param_type==AX_PARAM_FILE) {				// If the cert file's path is passed
			$der_data = file_get_contents($param_value);
		}
		else {											// If the cert is passed as a string
			$der_data = $param_value;
		}
		$pem = chunk_split(base64_encode($der_data), 64, "\n");
		$pem = "-----BEGIN CERTIFICATE-----\n".$pem."-----END CERTIFICATE-----\n";
		return $pem;
	}
*/
}

/*
//Extract the Certificate Serial Number
$serial = $this->x509_parsed['serialNumber'] . "";
                    $base = bcpow("2", "32");
                    $counter = 100;
                    $res = "";
                    $val = $serial;

                    while($counter > 0 && $val > 0) {
                            $counter = $counter - 1;
                            $tmpres = dechex(bcmod($val, $base)) . "";
                            // adjust for 0's
                            for ($i = 8-strlen($tmpres); $i > 0; $i = $i-1) {
                                    $tmpres = "0$tmpres";
                            }
                            $res = $tmpres .$res;
                            $val = bcdiv($val, $base);
                    }
                    if ($counter <= 0) {
                            return false;
                    }
                    return strtoupper($res);
*/
/*

*Option #3: OpenSSL

Serial Number:
-> openssl x509 -in CERTIFICATE_FILE -serial -noout

Thumbprint:
-> openssl x509 -in CERTIFICATE_FILE -fingerprint -noout


*/
/*
		$cert = <<<TEXT
-----BEGIN CERTIFICATE-----
MIIE2jCCA8KgAwIBAgIUMjAwMDEwMDAwMDAyMDAwMDAyOTMwDQYJKoZIhvcNAQEF
BQAwggFcMRowGAYDVQQDDBFBLkMuIDIgZGUgcHJ1ZWJhczEvMC0GA1UECgwmU2Vy
dmljaW8gZGUgQWRtaW5pc3RyYWNpw7NuIFRyaWJ1dGFyaWExODA2BgNVBAsML0Fk
bWluaXN0cmFjacOzbiBkZSBTZWd1cmlkYWQgZGUgbGEgSW5mb3JtYWNpw7NuMSkw
JwYJKoZIhvcNAQkBFhphc2lzbmV0QHBydWViYXMuc2F0LmdvYi5teDEmMCQGA1UE
CQwdQXYuIEhpZGFsZ28gNzcsIENvbC4gR3VlcnJlcm8xDjAMBgNVBBEMBTA2MzAw
MQswCQYDVQQGEwJNWDEZMBcGA1UECAwQRGlzdHJpdG8gRmVkZXJhbDESMBAGA1UE
BwwJQ295b2Fjw6FuMTQwMgYJKoZIhvcNAQkCDCVSZXNwb25zYWJsZTogQXJhY2Vs
aSBHYW5kYXJhIEJhdXRpc3RhMB4XDTEyMTAyNjE5MjI0M1oXDTE2MTAyNjE5MjI0
M1owggFTMUkwRwYDVQQDE0BBU09DSUFDSU9OIERFIEFHUklDVUxUT1JFUyBERUwg
RElTVFJJVE8gREUgUklFR08gMDA0IERPTiBNQVJUSU4gMWEwXwYDVQQpE1hBU09D
SUFDSU9OIERFIEFHUklDVUxUT1JFUyBERUwgRElTVFJJVE8gREUgUklFR08gMDA0
IERPTiBNQVJUSU4gQ09BSFVJTEEgWSBOVUVWTyBMRU9OIEFDMUkwRwYDVQQKE0BB
U09DSUFDSU9OIERFIEFHUklDVUxUT1JFUyBERUwgRElTVFJJVE8gREUgUklFR08g
MDA0IERPTiBNQVJUSU4gMSUwIwYDVQQtExxBQUQ5OTA4MTRCUDcgLyBIRUdUNzYx
MDAzNFMyMR4wHAYDVQQFExUgLyBIRUdUNzYxMDAzTURGUk5OMDkxETAPBgNVBAsT
CFNlcnZpZG9yMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDlrI9loozd+UcW
7YHtqJimQjzX9wHIUcc1KZyBBB8/5fZsgZ/smWS4Sd6HnPs9GSTtnTmM4bEgx28N
3ulUshaaBEtZo3tsjwkBV/yVQ3SRyMDkqBA2NEjbcum+e/MdCMHiPI1eSGHEpdES
t55a0S6N24PW732Xm3ZbGgOp1tht1wIDAQABox0wGzAMBgNVHRMBAf8EAjAAMAsG
A1UdDwQEAwIGwDANBgkqhkiG9w0BAQUFAAOCAQEAuoPXe+BBIrmJn+IGeI+m97Ol
P3RC4Ct3amjGmZICbvhI9BTBLCL/PzQjjWBwU0MG8uK6e/gcB9f+klPiXhQTeI1Y
KzFtWrzctpNEJYo0KXMgvDiputKphQ324dP0nzkKUfXlRIzScJJCSgRw9ZifKWN0
D9qTdkNkjk83ToPgwnldg5lzU62woXo4AKbcuabAYOVoC7owM5bfNuWJe566UzD6
i5PFY15jYMzi1+ICriDItCv3S+JdqyrBrX3RloZhdyXqs2Htxfw4b1OcYboPCu4+
9qM3OV02wyGKlGQMhfrXNwYyj8huxS1pHghEROM2Zs0paZUOy+6ajM+Xh0LX2w==
-----END CERTIFICATE-----

-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDlrI9loozd+UcW7YHtqJimQjzX9wHIUcc1KZyBBB8/5fZsgZ/s
mWS4Sd6HnPs9GSTtnTmM4bEgx28N3ulUshaaBEtZo3tsjwkBV/yVQ3SRyMDkqBA2
NEjbcum+e/MdCMHiPI1eSGHEpdESt55a0S6N24PW732Xm3ZbGgOp1tht1wIDAQAB
AoGBAN9Ut6+dq5rhHbZ2xyPBEIaC3EUopCwVET9psgxmZLiutbt3JHpeAmmNMvzt
sgQMYjNH8kFC6Qk1xJBZVMyNy5iqI/y9HEpZOfMX/IQfN+/35/27pZwE1kmoyp/6
eHnF6QZT08kn/TD8KMjcF3co489G0HOqKNVONlcm0ETYL1hhAkEA/27P2g48qXfQ
BlFRZ+pes6EBBUYzS3r7B1BL3g/O9VFJnZBPQFzclEdZPVvjh9Ve+HktvbKTaYRJ
5wlVewDVRwJBAOYvG18Wu4Ok7ntvzZDoxSuYueEU2hj247z3INTdVqvKXsNJcdJW
N6uwPqh91Y4iR8EkYn2O5/ds5MbrUqheKvECQQCHKKWHJn1m1uUWUrUWnWda+VjG
56yAxiRKbGyYphjGqiqf2xp0Xi7BrzdDRnoRCBBmvgg8Fl/2N2+7dq7qlThFAkBF
YMNmOKrR9d8vczZJS+9JwaGc1rUZuyhPJ0lM/12FL9y6DaPx2qyy4c8w56R7T5fC
/h11bKI78CVQU1M5jhBxAkAG29ost7UTXCFo++9Puvvao+Xyir4TTbQaIea87u/T
wPVJ/KcRMuzk0lUCfh7cKEc1K8StOyGKfSvUm8stMqpH
-----END RSA PRIVATE KEY-----
TEXT;
*/



/*

GENERAR SELLO CON OPENSSL (SHA1 hash)
openssl dgst -sha1 -out sign.bin -sign KEY.PEM CadOri.txt


**/


/*
		$cert=
		$this->controller->Axfile->FileToString($this->pathCERT).
		$this->controller->Axfile->FileToString($this->pathPKEY);

		$cert509 = openssl_x509_read($cert) or die("\nNo se puede leer el certificado\n");
		$_data = openssl_x509_parse($cert509);
		$serial1 = $_data['serialNumber'];
		$serial2 = gmp_strval($serial1, 16);
		$serial3 = explode("\n", chunk_split($serial2, 2, "\n"));
		$serial = "";
		foreach ($serial3 as $serialt) {
			if (2 == strlen($serialt))
				$serial .= chr('0x' . $serialt);
		}
		$serial="00001000000200904226";
		$this->certificadoSerial = $serial;

		unset($serial1, $serial2, $serial3, $serialt, $_data, $cert509);
		preg_match('/-----BEGIN CERTIFICATE-----(.+)-----END CERTIFICATE-----/msi', $this->_cert, $matches) or die("No certificado\n");
		$algo = $matches[1];
		$algo = preg_replace('/\n/', '', $algo);
		$certificado = preg_replace('/\r/', '', $algo);
*/
