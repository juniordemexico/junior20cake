<?php
//EJEMPLO PARA GENERAR EL PDF
App::import('Vendor','tcpdf');
$tcpdf = new TCPDF('P');
$tcpdf->SetCreator('AxBOS IDD');
$tcpdf->SetAuthor('Junior de Mexico, SA de CV');
$tcpdf->SetTitle('FACTURA '.$data['Master']['farefer']);
$tcpdf->SetSubject('COMPROBANTE FISCAL CFDI INGRESO. FACTURA '.$data['Master']['farefer'].'.');
$tcpdf->SetKeywords("JUNIOR, CFDI, PDF, COMPROBANTE FISCAL, FACTURA, FACTURA ELECTRONICA, ".$data['Master']['farefer']);
$tcpdf->setPrintHeader(false);
$tcpdf->setPrintFooter(false);

$tcpdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
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
	<tr><td><font size="+1"><b>'.htmlentities($data['Cliente']['clnom']).'</b></font></td></tr>
	<tr><td><b>'.$data['Cliente']['clrfc'].'.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>Domicilio:</b></td></tr>
	<tr><td>'.
		'<b>Calle:</b> '.htmlentities($data['Direccioncte']['clcalle']).'.<br />'.
		'<b>Núm Exterior:</b> '.$data['Direccioncte']['clnumext'].'.&nbsp;&nbsp;&nbsp;&nbsp;'.'<b>Núm Interior:</b> '.$data['Direccioncte']['clnumint'].'.<br />'.
		'<b>Colonia:</b> '.$data['Direccioncte']['clcolonia'].'.<br />'.
		'<b>Delegación:</b> '.htmlentities($data['Direccioncte']['cldelegacion']).'.<br />'.
		'<b>Ciudad y Estado:</b> '.htmlentities($data['Direccioncte']['clciu']).', '.htmlentities($data['Direccioncte']['cledo']).'.<br/>'.
		'<b>País:</b> '.$data['Direccioncte']['clpais'].',&nbsp;&nbsp;&nbsp;&nbsp;'.' <b>C.P.:</b> '.$data['Direccioncte']['clcp'].'.<br />'.
		'
	</td></tr>
	<tr><td><b>Enviar a:</b><br/ >'.htmlentities($data['Cliente']['clenviara']).'</td></tr>
	<tr><td><b>Pedido:</b> '.htmlentities($data['Master']['fapedido']).'.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Divisa:</b> '.$data['Divisa']['dicve'].'.&nbsp;&nbsp;<b>Tipo de Cambio:</b> '.$data['Master']['fatcambio'].'</td></tr>
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
				<td style="text-align: right; width: 0.75in;">'. number_format($item['Detail']['fadprecio'],4).'</td>
				<td style="text-align: right; width: 1.25in;">'. number_format($item['Detail']['fadimporteneto'],4).'</td>
			</tr>
			';
			endforeach;
			
$body.='
	</table>';

$tcpdf->writeHTML($body, true, false, true, false, '');

$totales='
	<table style="width: 100%; border: 1px solid #000;" cellspacing="0" cellpadding="0">
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>SUMA:</b> </td>
				<td style="text-align: right; width: 1.25in;"><b>'. number_format($data['Master']['fasuma'],4).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>DESCTO '. number_format($data['Master']['fadesc1'],1).'%:</b></td>
				<td style="text-align: right; width: 1.25in;"><b>'. number_format($data['Master']['fasuma']*($data['Master']['fadesc1']/100),4).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;"> &nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>SUBTOTAL:</b></td>
				<td style="text-align: right; width: 1.25in;"><b>'.number_format($data['Master']['factura__faimporte'], 4).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>IVA '.number_format($data['Master']['faimpu'],1).'%:</b></td>
				<td style="text-align: right; width: 1.25in;"><b>'.number_format($data['Master']['factura__faimpoimpu'], 4).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="width: 4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.75in;"><b>TOTAL:</b></td>
				<td style="text-align: right; width: 1.25in;"><b>'.number_format($data['Master']['factura__fatotal'],4).'</b>&nbsp;&nbsp;</td>
			</tr>
	</table>';

$tcpdf->writeHTML($totales, true, false, true, false, '');

$pago='
	<div style="border: 1px solid #000; width: 100%;">
		<font size="-1"><b> Prendas totales: </b>'.$ptotal.'</font>&nbsp;&nbsp;
		<font size="-1"><b> Forma de pago: </b>TRANSFERENCIA</font>&nbsp;&nbsp;
		<font size="-1"><b> Condiciones de pago: </b>'.$data['Master']['faplazo'].' días</font>&nbsp;&nbsp;
		<font size="-1"><b> Método de pago: </b>EN UNA SOLA EXHIBICIÓN</font>&nbsp;&nbsp;
		<font size="-1"><b> Núm. cta. pago: </b>NO IDENTIFICADA</font>
	</div>
';
$tcpdf->writeHTML($pago, true, false, true, false, '');

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
		<font size="-1"><b>SELLO DIGITAL:</b></font> <br />
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
			<img style="width: 1.15in; height: 1.15in; border: 0px none #000000;" src="'.(APP.DS.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['farefer'].'.png').'" border="0" />
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
$tcpdf->Output(APP.'files'.DS.'comprobantesdigitales'.DS.$filename , "F");

// El PDF ya se genero, pero no lo vamos a enviar al user-agent, solo lo dejamos 
// grabado en nuestro sistema local de archivos.
// Por lo tanto, la accion 'imprimepdf' usa esta vista inicialmente para generar
// el PDF a partir de HTML. Una vez generado, tenemos que devolver al user-agent
// El resultado de la creación, lo haremos interrumpiendo el curso normal de la
// respuesta (incicialmente usando el layout 'media') y cambiamos al layout
// 'default', para poder enviar el resultado de la operacion en formato json.
//$this->controller->layout='default';

//header('content type: application/json');

echo json_encode( array(
		'result'	=>'ok',
		'message'	=> 'El PDF correspondiente al CFDI de la factura '.$data['Master']['farefer'].' se genero correctamente.',
		'data'		=> $data			
	));
//$this->controller->_end();

/*
header('content type: application/json');
echo json_encode( array(
		'result'	=>'ok',
		'message'	=> 'El PDF correspondiente al CFDI de la factura '.$data['Master']['farefer'].' se generó correctamente.',
		'data'		=> $data			
	));
$this->controller->_end();


*
**/
