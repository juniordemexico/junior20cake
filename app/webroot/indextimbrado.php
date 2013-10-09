<?php
	require_once('clsTimbrado.php');
	
	$data = '{
   "Divisa":{
      "id":1,
      "dicve":"MN",
      "ditcambio":"1.0000",
      "dinom":"PESOS"
   },
   "Cliente":{
      "clnom":"COMERCIAL POZA RICA, SA DE CV (TUXPAN)",
      "clrfc":"CPR741118S31",
      "clsuc":"      ",
      "clbancocta":"NO IDENTIFICADO",
      "clcalle":"CALLE 6",
      "clnoext":"SN",
      "clnoint":"NA",
      "clcolonia":"COL. OBRERA",
      "cllocalidad":"",
      "clreferencia":"",	
      "clciu":"POZA RICA",
      "cledo":"VERACRUZ",
      "clpais":"MEXICO",
      "clcp":"93260"
   },
   "Empresa":{
      "emnom":"JUNIOR DE MEXICO, S.A. de C.V.",
      "emrfc":"JME910405B83",
      "emcalle":"AV PASEO DE LA REFORMA",
      "emnoext":"2654",
      "emnoint":"1501",
      "emcolonia":"LOMAS ALTAS",	
      "emciu":"MIGUEL HIDALGO",
      "emedo":"DISTRITO FEDERAL",
      "empais":"MEXICO",
      "emcp":"11950",
	  "vlocalidad":"",
	  "vref":""
   },
   "Master":{
      "id":5969846,						// Identificador unico de la factura (solo uso interno)
      "farefer":"A0083571",				// Folio de la Factura
      "fafecha":"2013-09-20 00:00:00",
      "faplazo":60,
      "formapago":"TRANSFERENCIA",
      "comprobante_tipo":"ingreso",
      "metodopago":"PAGO EN UNA SOLA EXHIBICION",
      "fasuma":"9627.52",
      "fadesc1":"0.00",					// Porcentaje de Descto Global en la Factura
      "faimpu_cve":"IVA",				// Descripcion o nombre del impuesto aplicado a la Fac
      "faimpu1":"16.00",				// Porcentaje del impuesto aplicado a la Fac
      "faimpoimpu":"1492.4032",			// Importe resultante del impuesto de la factura (fasuma*(faimpu1/100))
      "fatotal":"11119.9232",			// Total de la factura con impuesto incluido (fadsuma+fadimpoimpu)
      "regegfis":"Regimen General de ley Personas Morales",
	  "pcta":"NO IDENTIFICADO",
	  "lugar_expedicion":"DISTRITO FEDERAL"
   },
   "Details":[
      {
        "Detail": {
  	    "id": 5969847,				// Identificador unico de la partida (solo uso interno)
  	    "articulo_id": 106634,		// Identificador unico del producto (solo uso interno)
  	    "color_id": 942,			// Identificador unico del color (solo uso interno)
  	    "fadprecio": "240.68",       // Precio Unitario
  	    "fadcant": "40.00",			 // Cantidad (en unidades, generalmente PZAS)
  	    "fadimporte": "9627.52"		 // Importe de la partida (fadcant * fadprecio)
	},
         "Articulo":{
            "id":106634,
            "arcveart":"POWERINGINK",        		// $NOIDENTIFICACION   (Clave o Codigo del Producto)
            "ardescrip":"PANTALON POWER RING INK",	// (Descripcion del Producto)
            "armarca":"OGGI",						// (Marca del producto)
            "arunidad":"PZAS"						// (Unidad de Medida del producto)
         }
      }
   ]
}';
	$fac = new timbradoCFDi();
	$fac->setData($data);

	echo $fac->printXML()."<br>";
	$cadena= $fac->obtenerCadenaOriginal();
	$cfdi= $fac->generarSello($cadena);
	$fac->timbrarComprobanteFiscal($cfdi);
