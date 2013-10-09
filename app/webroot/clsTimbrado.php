<?php

class timbradoCFDi {
	public $json_dec;
	public $cadena_original;
	public $cfdi;
	public $envtext;
	public $data;
	public $xml;
	public $c;

	public function __construct() {
		echo "Instanciado";
	}

	public function setData($data)
	{
		echo "Entre a setData()";
		
		$this->data=json_decode($data);


		// Esta parte por algun motivo (tal vez el SPL) no ejecuta
/*
		$jsonIterator = new RecursiveIteratorIterator(
    	new RecursiveArrayIterator(json_decode($this->data, TRUE)),
    	RecursiveIteratorIterator::SELF_FIRST);
*/
		echo "Pase el jsonIterator";

		// La parte $jsonIterator podria adaptarse mas o menos asi:
		$encabezado=$this->data['Master'];
		$detalles=$this->data['Details'];
		
		// Y luego hacer un foreach($encabezado as $key=>$value);
		// y otro foreach($detalles as $key=>$values);
		
		
		$Conceptos="<cfdi:Conceptos>";


		foreach ($jsonIterator as $key => $val) 
		{

				if(is_array($val)) 
				{
					if($key=="Details:")
					{
						foreach ($val as $subkey => $subval) 
						{
							if(is_array($subval)) 
							{
								foreach ($subval as $ssubkey => $ssubval) 
								{
								    if(is_array($ssubval)) 
									{
										//echo "$ssubkey: <br />";
									} else {
										//echo "$ssubkey => $ssubval <br />";
										if(trim($ssubkey)=="fadcant")		{$CANTIDAD=$ssubval;}
										if(trim($ssubkey)=="arunidad")		{$UNIDAD=$ssubval;} 
										if(trim($ssubkey)=="arcveart")		{$NOIDENTIFICACION=$ssubval;} 
										if(trim($ssubkey)=="ardescrip")     {$DESCRIPCION=$ssubval;}
										if(trim($ssubkey)=="fadprecio")		{$VALORUNITARIO=$ssubval;}               
										if(trim($ssubkey)=="fadimporte")	{$IMPORTE=$ssubval;}
									}
								}
								
							}

						}
						$Conceptos.='<cfdi:Concepto cantidad="'.$CANTIDAD.'" unidad="'.$UNIDAD.'" descripcion="'.$DESCRIPCION.'" valorUnitario="'.$VALORUNITARIO.'" fadimporte="'.$IMPORTE.'"/>';
					}
				}

				$VERSION="3.2";
				if(trim($key)=="id")				$SERIE=$val;      // ???? (sera es el prefijo del folio??? ej: 'A')
				if(trim($key)=="id")				$FOLIO=$val;      // ???? (sera lo mismo que farefer? ej: A0010345 )
				if(trim($key)=="formapago")			$FORMAPAGO=$val;  // ???? (cual es el dato aqui?, la llave 'farefer' contiene el folio de la factura, ej: A0010345)  
				if(trim($key)=="faplazo")			$CONDICIONESPAGO=$val;
				if(trim($key)=="fasuma")			$SUBTOTAL=$val;
				if(trim($key)=="fadesc1")			$DESCUENTO=$val;
				if(trim($key)=="fatotal")			$TOTAL=$val;
				if(trim($key)=="dicve")				$MONEDA=$val;
				if(trim($key)=="comprobante_tipo")	$TIPOCOMPROBANTE=$val;
				if(trim($key)=="ditcambio")			$TIPOCAMBIO=$val;
				if(trim($key)=="pcta")				$NUMCTA=$val;
				if(trim($key)=="formapago")      $METODOPAGO=$val;
				if(trim($key)=="lugar_expedicion") $LUGEXP=$val;
				if(trim($key)=="fafecha")         $LUGEXP=$val;
				
				//Todos estos datos con prefijo 'em' (antes 've'), son los datos de la empresa???
				if(trim($key)=="emrfc")              {$RFC=$val;}
				if(trim($key)=="emnom")           {$NOMBRE=$val;}
				if(trim($key)=="emcalle")            {$CALLE=$val;}
				if(trim($key)=="emnoext")            {$NOEXT=$val;}
				if(trim($key)=="emnoint")            {$NOINT=$val;}
				if(trim($key)=="emcolonia")          {$COLONIA=$val;}
				if(trim($key)=="emciu")        {$MUNICIPIO=$val;}
				if(trim($key)=="emedo")           {$ESTADO=$val;}
				if(trim($key)=="empais")             {$PAIS=$val;}
				if(trim($key)=="emcp")               {$CP=$val;}
				if(trim($key)=="vlocalidad")          {$LOCALIDAD_E=$val;}
	            if(trim($key)=="vref" )                {$REFERENCIA_E=$val;}

				if(trim($key)=="clrfc")			{$RFC_E=$val;}
				if(trim($key)=="clnom")			{$NOMBRE_E=$val;}
				if(trim($key)=="clcalle")		{$CALLE_E=$val;}
				if(trim($key)=="clnoext")		{$NOEXT_E=$val;}
				if(trim($key)=="clnoint")		{$NOINT_E=$val;}
				if(trim($key)=="clcolonia")		{$COLONIA_E=$val;}
				if(trim($key)=="cllocalidad")	{$LOCALIDAD_E=$val;}
				if(trim($key)=="clreferencia")	{$REFERENCIA_E=$val;}
				if(trim($key)=="clciu")			{$MUNICIPIO_E=$val;}
				if(trim($key)=="cledo")			{$ESTADO_E=$val;} 
				if(trim($key)=="clpais")		{$PAIS_E=$val;} 
				if(trim($key)=="clcp")			{$CP_E=$val;}
				if(trim($key)=="regegfis")		{$REGFISL_E=$val;} 
				
				if(trim($key)=="faimpu_cve")	{$IMPUESTO=$val;}
				if(trim($key)=="faimpu1")		{$TASA=$val;} 
				if(trim($key)=="faimpoimpu")	{$IMPORTE=$val;} 
				if(trim($key)=="faimpoimpu")	{$totalTrasladados=$val;}

		}


		$comprobante='<?xml version="1.0" encoding="utf-8"?><cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 		http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd" version="'.$VERSION.'" serie="'.$SERIE.'" folio="'.$FOLIO.'" fecha="'.date("Y-m-d").'T'.date("H:i:s").'" sello="" NumCtaPago="'.$NUMCTA.'" TipoCambio="'.$TIPOCAMBIO.'" Moneda="'.$MONEDA.'" formaDePago="'.$FORMAPAGO.'" noCertificado="" certificado="" condicionesDePago="'.$CONDICIONESPAGO.'" subTotal="'.$SUBTOTAL.'" total="'.$TOTAL.'" tipoDeComprobante="'.$TIPOCOMPROBANTE.'" metodoDePago="'.$METODOPAGO.'" LugarExpedicion="'.$LUGEXP.'" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">';
		$rec='<cfdi:Receptor rfc="'.$RFC.'" nombre="'.$NOMBRE.'"><cfdi:Domicilio calle="'.$CALLE.'" noExterior="'.$NOEXT.'" colonia="'.$COLONIA.'" municipio="'.$MUNICIPIO.'" estado="'.$ESTADO.'" pais="'.$PAIS.'" codigoPostal="'.$CP.'"/></cfdi:Receptor>'; 
		$emisor=' <cfdi:Emisor rfc="'.$RFC_E.'" nombre="'.$NOMBRE_E.'"><cfdi:DomicilioFiscal calle="'.$CALLE_E.'" noExterior="'.$NOEXT_E.'" colonia="'.$COLONIA_E.'" municipio="'.$MUNICIPIO_E.'" estado="'.$ESTADO_E.'" pais="'.$PAIS_E.'" codigoPostal="'.$CP_E.'"/><cfdi:RegimenFiscal Regimen="'.$REGFISL_E.'" /></cfdi:Emisor> ';
		$traslados='<cfdi:Impuestos><cfdi:Traslados><cfdi:Traslado fadimporte="'.$IMPORTE.'" impuesto="'.$IMPUESTO.'" tasa="'.$TASA.'"/></cfdi:Traslados></cfdi:Impuestos>';
		$this->xml=$comprobante.$emisor.$rec.$Conceptos."</cfdi:Conceptos>".$traslados.'</cfdi:Comprobante>';
	}

  	function printXML()
	{
		return htmlspecialchars($this->xml);
	}

	function obtenerCadenaOriginal()
	{
		$myDom = new DOMDocument();
		$myDom->loadXML($this->xml);
		$xslt = new XSLTProcessor();
		$XSL = new DOMDocument();
		$XSL->load('complementos/cadenaoriginal_3_2.xslt', LIBXML_NOCDATA);
		$xslt->importStylesheet($XSL);
		$c = $myDom->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
		$cadena_original = $xslt->transformToXML( $c );
		return $cadena_original;
	}


	function generarSello($cadena)
	{
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
		$cert509 = openssl_x509_read($cert) or die("\nNo se puede leer el certificado\n");
		$data = openssl_x509_parse($cert509);
		$serial1 = $data['serialNumber'];
		$serial2 = gmp_strval($serial1, 16);
		$serial3 = explode("\n", chunk_split($serial2, 2, "\n"));
		$serial = "";
		foreach ($serial3 as $serialt) {
			if (2 == strlen($serialt))
				$serial .= chr('0x' . $serialt);
		}
		$noCertificado = $serial;
		unset($serial1, $serial2, $serial3, $serialt, $data, $cert509);
		preg_match('/-----BEGIN CERTIFICATE-----(.+)-----END CERTIFICATE-----/msi', $cert, $matches) or die("No certificado\n");
		$algo = $matches[1];
		$algo = preg_replace('/\n/', '', $algo);
		$certificado = preg_replace('/\r/', '', $algo);
		$key = openssl_pkey_get_private($cert) or die("No llave privada\n");
		$crypttext = "";
		openssl_sign($cadena, $crypttext, $key);
		$sello = base64_encode($crypttext);
		$myDom = new DOMDocument();
		$myDom->loadXML($this->xml);
		$c = $myDom->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0);
		$c->setAttribute('certificado', $certificado);
		$c->setAttribute('sello', $sello);
		$c->setAttribute('noCertificado', $noCertificado);
		$cfdi = $myDom->saveXML();
		return $cfdi;
	}


	function timbrarComprobanteFiscal($miCFDI)
	{
	echo htmlspecialchars($miCFDI);
	$envtext = '<?xml version="1.0" encoding="UTF-8"?>
	<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
	xmlns:ns1="http://facturacion.finkok.com/stamp" xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/"> 
	<SOAP-ENV:Header/> <ns0:Body> <ns1:stamp> 
	<ns1:xml>'.base64_encode($miCFDI).'</ns1:xml>
	<ns1:username>v.islas.padilla@gmail.com</ns1:username>
	<ns1:password>27Marzo!</ns1:password>
	</ns1:stamp>
	</ns0:Body>
	</SOAP-ENV:Envelope>';


	echo "<h1>REQUEST</h1>".htmlspecialchars($envtext);
	$env = new DOMDocument();
	$env->loadXML($envtext) or die("\n\n\nError interno en el sobre");
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
	if (!$timbre) {
		return "Error: ".curl_errno($process)." - ".curl_error($process)."<br>";
		curl_close($process);
		die("Error en comunicacion\n");
	}
	curl_close($process);
	echo "<h1>RESPONSE</h1>".htmlspecialchars($timbre);
	$myXML="";
	$xml = new DOMDocument();
	$xml->loadXML($timbre) or die("\n\n\nSurgió un error y no fue posible timbrar el documento");
	$searchNode =   $xml->getElementsByTagName('xml');
	foreach ( $searchNode as $searchNode) {
		$myXML= $searchNode->nodeValue;
	}
	$myXML=str_replace('&gt;','>',$myXML);
	$myXML=str_replace('&lt;','<',$myXML);
	$xml2 = new DOMDocument();
	$xml2->loadXML($myXML) or die("\n\n\nSurgió un error y no fue posible timbrar el documento");
	$cfdi = $xml2->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', '*');

	foreach ( $cfdi as $cfdi) {
    		$SelloSat = $cfdi->getAttribute('selloSAT');
    		$certificado = $cfdi->getAttribute('noCertificadoSAT');
    		$selloCFD = $cfdi->getAttribute('selloCFD');
    		$FecTim = $cfdi->getAttribute('FechaTimbrado');
    		$UUID = $cfdi->getAttribute('UUID');
	}
	$xml2->save("fe/facturas/".$UUID.".xml");

	if($SelloSat=="")
	{
		echo "Surgió un error y no fue posible timbrar el documento";
	}
	else
	{
		echo "se creo el CFDi ".$UUID.".xml";
	}
  }
 
	}
