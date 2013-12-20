<?php
//EJEMPLO PARA GENERAR EL PDF
//echo APP.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['farefer'].'.png';
//die();
App::import('Vendor','tcpdf');
$tcpdf = new TCPDF('P');
$tcpdf->SetCreator('AxBOS IDD');
$tcpdf->SetAuthor('Junior de Mexico, SA de CV');
$tcpdf->SetTitle('FACTURA Folio: '.$data['Master']['farefer'].' UUID:'.$data['Master']['uuid']);
$tcpdf->SetSubject('COMPROBANTE FISCAL CFDI INGRESO. FACTURA '.$data['Master']['farefer'].'.');
$tcpdf->SetKeywords("JUNIOR DE MEXICO, OGGI, CFDI, PDF, COMPROBANTE FISCAL, INGRESO, FACTURA, FACTURA ELECTRONICA, ".$data['Master']['farefer']);
$tcpdf->setPrintHeader(false);
$tcpdf->setPrintFooter(false);

$tcpdf->setMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$tcpdf->SetFont('Helvetica', '', 7);

$tcpdf->AddPage();

$head_left='
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr><td>
			<img style="width: 90px; height: 45px; border: 0px;" border="0" src="'.APP.'webroot/img/logos/oggi_logo_tiny.png'.'" />
	</td></tr>
	<tr><td><font size="+1"><b><u>E M I S O R</u></b></font></td></tr>
	<tr><td><font size="+1"><b>JUNIOR DE MEXICO, S.A. DE C.V.</b></font></td></tr>
	<tr><td><b>JME910405B83</b></td></tr>
	<tr><td><font size="-1">Régimen General de Ley Personas Morales.</font></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>Domicilio Físcal:</b></td></tr>
	<tr><td>
		Av. Paseo de la Reforma #2654 Piso 15 Interior 1501<br />
		Col. Lomas Altas. Delegación Miguel Hidalgo.<br />
		México D.F., C.P. 11950.
	</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>Lugar de Emisión:</b></td></tr>
	<tr><td>
		Av. Viaducto Rio de la Piedad #525A.<br />
		Colonia Granjas México. Delegación Iztacalco.<br/>
		México D.F., C.P. 08400.
	</td></tr>
	<tr><td><b>Tipo de Comprobante:</b> ingreso.</td></tr>
</table>
';

$head_right='
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: transparent;">
	<tr><td style="text-align: right;"><b>Expedido en: México, D.F. a '. $data['Master']['fafecha'].'</font></td></tr>
	<tr><td style="text-align: right;"><font size="+3"><b>FACTURA '.$data['Master']['farefer'].'</b></font></td></tr>
	<tr><td style="text-align: right;"><font size="-1"><b>( UUID: '.$data['Master']['uuid'].' )</b></font></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><font size="+1"><b><u>R E C E P T O R</u></b></font></td></tr>
	<tr><td><font size="+1"><b>'.$data['Cliente']['clnom'].'</b></font></td></tr>
	<tr><td><b>'.$data['Cliente']['clrfc'].'.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>Domicilio:</b></td></tr>
	<tr><td>'.
		'<b>Calle:</b> '.$data['Clientesdireccion']['clcalle'].'.<br />'.
		'<b>Núm Exterior:</b> '.$data['Clientesdireccion']['clnumext'].'.&nbsp;&nbsp;&nbsp;&nbsp;'.'<b>Núm Interior:</b> '.$data['Clientesdireccion']['clnumint'].'.<br />'.
		'<b>Colonia:</b> '.$data['Clientesdireccion']['clcolonia'].'.<br />'.
		'<b>Delegación:</b> '.$data['Clientesdireccion']['cldelegacion'].'.<br />'.
		'<b>Ciudad y Estado:</b> '.$data['Clientesdireccion']['clciu'].', '.$data['Clientesdireccion']['cledo'].'.<br/ > '.
		'<b>País:</b> '.$data['Clientesdireccion']['clpais'].',&nbsp;&nbsp;&nbsp;&nbsp;'.' <b>C.P.:</b> '.$data['Clientesdireccion']['clcp'].'.<br />'.
		'
	</td></tr>
	<tr><td><b>Enviar a:</b><br/ >'.$data['Cliente']['clenviara'].'</td></tr>
	<tr><td><b>Pedido:</b> '.$data['Master']['fapedido'].'.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Divisa:</b> '.$data['Divisa']['dicve'].'.&nbsp;&nbsp;<b>Tipo de Cambio:</b> '.$data['Master']['fatcambio'].'</td></tr>
</table>
';

$head=	'<table cellspacing="4" cellpadding="0" border="0" width="100%"><tr><td width="50%">'.
		$head_left.'</td><td º>'.
		$head_right.
		'</td></tr></table>';
$tcpdf->writeHTML($head, true, false, true, false, '');


$body='
	<table style="font-size: 7pt; width: 100%; border: 1px solid #000000;" border="1">
		<tr style="text-align:center; background-color: #D0D0D0; font-weight: bold;">
			<td style="text-align: right; width: 0.5in;">Cantidad</td>
			<td style="width: 0.5in;">Unidad</td>
			<td style="width: 4in;">Descripción</td>
			<td style="text-align: right; width: 0.75in;">Precio</td>
			<td style="text-align: right; width: 1.25in;">Importe</td>
		</tr>
';
		
			$ptotal=0;
			foreach($data['Details'] as $item):
				$ptotal += $item['Detail']['fadcant'];
				$body.='<tr>
				<td style="text-align: right; width: 0.5in;">'.number_format(($item['Detail']['fadcant']), 0).'</td>
				<td style="width: 0.5in;">'.$item['Articulo']['arunidad'].'</td>
				<td style="width: 4in;">'.$item['Articulo']['ardescrip'].'</td>
				<td style="text-align: right; width: 0.75in;">'.$item['Detail']['fadprecio'].'</td>
				<td style="text-align: right; width: 1.25in;">'.$item['Detail']['fadimporteneto'].'</td>
			</tr>
			';
			endforeach;
			
$body.='
	</table>';

$tcpdf->writeHTML($body, true, false, true, false, '');

$totales='
	<table style="width: 100%; border: 1px none;" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>SUMA:</b> </td>
				<td style="text-align: right; width: 1.25in;"><b>'. $data['Master']['fasuma'].'</b></td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>DESCTO: '.$data['Master']['fadesc1'].'</b></td>
				<td style="text-align: right; width: 1.25in;"><b>'. number_format($data['Master']['fasuma']*($data['Master']['fadesc1']/100),4).'</b></td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;"> &nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>SUBTOTAL:</td>
				<td style="text-align: right; width: 1.25in;"><b>'.number_format($data['Master']['factura__faimporte'], 4).'</b></td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>IVA '.$data['Master']['faimpu'].'%:</td>
				<td style="text-align: right; width: 1.25in;"><b>'.number_format($data['Master']['factura__faimpoimpu'], 4).'</b></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>TOTAL:</td>
				<td style="text-align: right; width: 1.25in;"><b>'.number_format($data['Master']['factura__fatotal'],4).'</b></td>
			</tr>
	</table>';

$tcpdf->writeHTML($totales, true, false, true, false, '');


$avisos='
	<div style="text-align: center; border: 1px solid #000000; padding: 8px; margin: 8px; background: transparent;">
		<font size="+0"><b><i>Este documento es una representación impresa de un CFDI versión 3.2</i></b></font><br />
		<font size="-1"><b>Consulte nuestro aviso de privacidad en <i>http://www.oggi.com.mx/aviso-de-privacidad.html</i></b></font><br />
		<font size="-1"><b>HARD, WILD, BIG JOHN, OIL, STATION, OLE JEANS, SIENTE EL AZUL, OGGI STAR, OGGI MAX, OG JEANS, OGGI JEANS, BLURING, <br />OGGI RED, OGGI BLUE <i>Son marcas registradas propiedad de Junior de México, S.A. de C.V.</i></b></font>
	</div>';
	
$tcpdf->writeHTML($avisos, true, false, true, false, '');

$cadena='
	<div style="border: 1px solid #000; width: 100%; padding: 4pt;">
		<font size="-1"><b>CADENA ORIGINAL:</b></font> <br />
		<font size="-2">'. htmlentities($data['Master']['cadenaoriginal']).'<br /></font>
	</div>';

$tcpdf->writeHTML($cadena, true, false, true, false, '');

$sello='
	<div style="border: 1px solid #000; width: 100%; ">
		<font size="-1"><b>SELLO CFDI:</b></font> <br />
		<font size="-1">'. htmlentities($data['Master']['sellocfd']).'</font><br />
	</div>';

$tcpdf->writeHTML($sello, true, false, true, false, '');

$sellosat='
	<div style="border: 1px solid #000; width: 100%; ">
		<font size="-1"><b>SELLO SAT:</b></font> <br />
		<font size="-1">'. htmlentities($data['Master']['sellosat']).'</font><br />
	</div>';

$tcpdf->writeHTML($sellosat, true, false, true, false, '');

$timbre='
	<table style="width: 100%; border: 1px solid #000000; padding: 0px;" border="1" cellpadding="2">
		<tr style="background: transparent; border: 1px none;" border="0">
		<td style="width: 30%;">
			<img style="width: 1.15in; height: 1.15in; border: 0px none #000000;" src="'.(APP.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['farefer'].'.png').'" border="0" />
		</td>
		<td style="width: 70%;">
			<p>
				<font size="+1"><b>FOLIO FISCAL: '. htmlentities($data['Master']['uuid']).'</b></font>
			</p>
			<p>
				<b>NÚMERO DE SERIE DEL CSD EMISOR:</b> '.htmlentities('00001000000200904226').'
			</p>
			<p>
				<br /><br />
			</p>
			<p>
				<b>NÚMERO DE SERIE DEL CERTIFICADO DEL SAT:</b> '.htmlentities($data['Master']['nocertificadosat']).'
			</p>
			<p>
				<b>FECHA Y HORA DE CERTIFICACIÓN:</b> '.htmlentities($data['Master']['fechatimbrado']).'
			</p>
		</td>
		</tr>
	</table>
';

$tcpdf->writeHTML($timbre, true, false, true, false, '');

//$tcpdf->writeHTML($head_left, true, false, false, false, '');
//$tcpdf->writeHTML($head_right, true, false, false, false, '');



$tcpdf->lastPage();

$filename='JME910405B83-'.$data['Master']['farefer'].'.pdf';

//$this->controller->Axfile->StringToFile(APP.DS.'files'.DS.'comprobantesdigitales'.DS.$filename.'.html', $head);
$tcpdf->Output(APP.'files'.DS.'comprobantesdigitales'.DS.$filename , "FI");

/*
			<tr style="text-align:center; font-weight: bold;">
				<td colspan="5">
					Este documento es una representación impresa de un CFDI versión 3.2
				</td>
			</tr>

**/
/*
$subtable2='
	<table style="font-size: 8pt; width: 100%;" border="1px">
		<tr style="text-align:center; background-color: #D0D0D0; font-weight: bold;">
			<td width="10%">Cantidad</td>
			<td width="10%">Unidad</td>
			<td>Descripción</td>
			<td width="15%">Precio</td>
			<td width="15%">Importe</td>
		</tr>
';
		
			$ptotal=0;
			foreach($data['Details'] as $item):
				$ptotal += $item['Detail']['fadcant'];
$subtable2.='<tr>
				<td>'.number_format(($item['Detail']['fadcant']), 0).'</td>
				<td>'.$item['Articulo']['arunidad'].'</td>
				<td>'.$item['Articulo']['ardescrip'].'</td>
				<td>'.$item['Detail']['fadprecio'].'</td>
				<td>'.$item['Detail']['fadimporteneto'].'</td>
			</tr>
			';
			endforeach;
			
$subtable2.='
			<tr style="text-align:center; font-weight: bold;">
				<td colspan="5">
					Este documento es una representación impresa de un CFDI versión 3.2
				</td>
			</tr>
	</table>';
$subtable3= '
		<table style="background-color: #D0D0D0; text-align: right; font-size: 8pt; padding: 1px; padding: 2px;" cellpadding="0" width="100%" border="1px">
			<tr>
				<td>Suma: </td>
				<td>'. $data['Master']['fasuma'].'</td>
			</tr>
			<tr>
				<td>Descuento: </td>
				<td>'. $item['Articulo']['ardesc1'].'</td>
			</tr>
			<tr>
				<td>Sub-Total: </td>
				<td>'. $data['Master']['fasuma'].'</td>
			</tr>
			<tr>
				<td>IVA 16 % </td>
				<td>'. number_format(($data['Master']['factura__faimpoimpu']), 4).'</td>
			</tr>
			<tr>
				<td>Total: </td>
				<td>'. number_format(($data['Master']['factura__fatotal']), 4).'</td>
			</tr>
		</table>';
$subtable4='
	<table style="font-size: 8pt;"  border="1" cellpadding="0">
		<tr style="text-align:center;">
			<td style=" width: 80%; text-align: left;">Prendas Totales:  '.$ptotal.'</td>
			<td style=" width: 20%;" colspan="2">'.$subtable3.'</td>
		</tr>
		<tr>
			<td style="width: 33%;">
				Forma de Pago: TRANSFERENCIA
			</td>
			<td style="width: 33%;">
				Condiciones de Pago: '.$data['Cliente']['clplazo'].' días
			</td>
			<td style="width: 34%;">
				Método de Pago: EN UNA SOLA EXHIBICIÓN
			</td>
		</tr>
	</table>';
$subtable5='
	<table>
		<tr>
		<td style="width: 30%;"><img style="width: 1.25in; height: 1.25in;" src="'.(APP.DS.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['farefer'].'.png').'" border="0"/></td>
<!--	<td style="width: 30%;"><img style="width: 1.25in; height: 1.25in;" src="/app/webroot/img/JME910405B83-B0059875.png" border="0"/></td>-->
			<td style="width: 70%; text-align: left;">
				<ul style="list-style-type: none; font-size: 6pt;">
					<li>
						FOLIO FISCAL: '.$data['Master']['uuid'].'
					</li>
					<li>
						No. DE SERIE DEL CERTIFICADO DEL SAT: '.$data['Master']['nocertificadosat'].'
					</li>
					<li>
						FECHA Y HORA DE CERTIFICACIÓN: '.$data['Master']['fechatimbrado'].'
					</li>
					<li>
						NÚMERO DE SERIE DEL CSD DEL EMISOR: 00001000000200904226
					</li>
				</ul>
			</td>
		</tr>
	</table>
';
*/
/*
$html='
<table style="width: 7.2in; height: 11in; min-height: 11in; border: 1px solid #000; margin: 2px; padding: 2px;">
	<tr style=" width: 100%; margin: 2px; padding: 2px;">
		<td style=" width: 50%; margin: 2px; padding: 2px;">'.$subtable.'</td>
		<td style=" width: 50%; margin: 2px; padding: 2px;">'.$subtable1.'</td>
	</tr>
	<tr>
		<td style=" width: 100%;" colspan="2">
			<div style="height: 2in; min-height: 2in;">'.$subtable2.'</div>
		</td>
	</tr>
	<tr>
		<td style=" width: 100%;" colspan="2">'.$subtable4.'</td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="divObs" style="font-size: 7pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				Observaciones: <br/>
				<span style="font-weight: normal;">
				</span>
			</div>
			<div id="divPrivacidad" style="font-size: 6pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				Consulte nuestro aviso de privacidad en http://www.oggi.com.mx/aviso-de-privacidad.html
			</div>
			<div id="divMarcas" style="font-size: 6pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				Las marcas registradas: HARD, WILD, BIG JOHN, OIL, STATION, OLE JEANS, SIENTE EL AZUL, OGGI STAR, OGGI MAX, OG JEANS, OGGI JEANS, BLURING, OGGI RED, OGGI BLUE. Son propiedad de Junior de México, S.A. de C.V.
			</div>
			<div id="divCadenaOriginal" style="font-size: 6pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				CADENA ORIGINAL: <br />
				'. $data['Master']['cadenaoriginal'].'
			</div>
			<div id="divSelloDigital" style="font-size: 6pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				SELLO DIGITAL DEL CFDI: <br />
				'. $data['Master']['sellocfd'].'
				
			</div>
			<div id="divSelloSAT" style="font-size: 6pt; border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
					SELLO DEL SAT: <br />
					'. $data['Master']['sellosat'].'
			</div>
		</td>
	</tr>
	<tr>
		<td style=" width: 100%;" colspan="2">
			<div id="divQR" style="font-size: 8pt; border-top: 1px solid #000; height:0.75in; font-weight: bold; width: 100%; text-align: left;">
				'.$subtable5.'
			</div>
		</td>
	</tr>
</table>
';

*/
//$tcpdf->writeHTML($html, false, false, false, false, '');
//$tcpdf->Output(APP.DS.'files'.DS.'comprobantesdigitales'.DS.$filename , "FI");

// El PDF ya se genero, pero no lo vamos a enviar al user-agent, solo lo dejamos 
// grabado en nuestro sistema local de archivos.
// Por lo tanto, la accion 'imprimepdf' usa esta vista inicialmente para generar
// el PDF a partir de HTML. Una vez generado, tenemos que devolver al user-agent
// El resultado de la creación, lo haremos interrumpiendo el curso normal de la
// respuesta (incicialmente usando el layout 'media') y cambiamos al layout
// 'default', para poder enviar el resultado de la operacion en formato json.
//$this->controller->layout='default';

//header('content type: application/json');
/*
echo json_encode( array(
		'result'	=>'ok',
		'message'	=> 'El PDF correspondiente al CFDI de la factura '.$data['Master']['farefer'].' se genero correctamente.',
		'data'		=> $data			
	));
//$this->controller->_end();
*/
