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
	<tr><td><font size="-1">Regimen General de Ley Personas Morales.</font></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>Domicilio Fiscal:</b></td></tr>
	<tr><td>
		Av. Paseo de la Reforma #2654 Piso 15 Interior 1501<br />
		Col. Lomas Altas. Delegacion Miguel Hidalgo.<br />
		Mexico D.F., C.P. 11950.
	</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>Lugar de Emision:</b></td></tr>
	<tr><td>
		Av. Viaducto Rio de la Piedad #525A.<br />
		Colonia Granjas Mexico. Delegacion Iztacalco.<br/>
		Mexico D.F., C.P. 08400.
	</td></tr>
	<tr><td><b>Tipo de Comprobante:</b> ingreso.</td></tr>
</table>
';

$head_right='
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: transparent;">
	<tr><td style="text-align: right;"><b>Expedido en: Mexico, D.F. a '. $data['Master']['fafecha'].'</font></td></tr>
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
		'<b>Num Exterior:</b> '.htmlentities($data['Direccioncte']['clnumext']).'.&nbsp;&nbsp;&nbsp;&nbsp;'.'<b>Num Interior:</b> '.$data['Direccioncte']['clnumint'].'.<br />'.
		'<b>Colonia:</b> '.htmlentities($data['Direccioncte']['clcolonia']).'.<br />'.
		'<b>Delegacion:</b> '.htmlentities($data['Direccioncte']['cldelegacion']).'.<br />'.
		'<b>Ciudad y Estado:</b> '.htmlentities($data['Direccioncte']['clciu']).', '.htmlentities($data['Direccioncte']['cledo']).'.<br/>'.
		'<b>Pais:</b> '.htmlentities($data['Direccioncte']['clpais']).',&nbsp;&nbsp;&nbsp;&nbsp;'.' <b>C.P.:</b> '.$data['Direccioncte']['clcp'].'.<br />'.
		'
	</td></tr>
	<tr><td><b>Enviar a:</b><br/ >'.htmlentities($data['Cliente']['clenviara']).'</td></tr>
	<tr><td><b>Pedido:</b> '.htmlentities($data['Master']['fapedido']).'.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Divisa:</b> '.$data['Divisa']['dicve'].'.&nbsp;&nbsp;<b>Tipo de Cambio:</b> '.$data['Master']['fatcambio'].'</td></tr>
</table>
';

$head=	'<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="50%" style="padding: 4pt;">'.
		$head_left.'</td><td style="padding: 4pt;">'.
		$head_right.
		'</td></tr></table>';
$tcpdf->writeHTML($head, true, false, true, false, '');
$tcpdf->Ln();


$body='
	<table style="font-size: 6pt; width: 100%; border: 1px solid #000000;" border="1">
		<tr style="font-weight: bold;">
			<td style="text-align: right; width: 0.5in; background-color: #E0E0E0;">Cantidad</td>
			<td style="width: 0.5in; background-color: #E0E0E0;">Unidad</td>
			<td style="width: 1.6in; background-color: #E0E0E0;">Codigo</td>
			<td style="width: 2.8in; background-color: #E0E0E0;">Descripcion</td>
			<td style="text-align: right; width: 0.6in; background-color: #E0E0E0;">Precio</td>
			<td style="text-align: right; width: 1in; background-color: #E0E0E0;">Importe</td>
		</tr>
';
		
			$ptotal=0;
			foreach($data['Details'] as $item):
				$ptotal += $item['Detail']['fadcant'];
				$body.='<tr>
				<td style="text-align: right; width: 0.5in;">'.number_format(($item['Detail']['fadcant']), 0).'</td>
				<td style="width: 0.5in;">'.htmlentities($item['Articulo']['arunidad']).'</td>
				<td style="width: 1.6in;"><b>'.htmlentities($this->AxUI->cleanSpecialChars($item['Articulo']['arcveart'])).'</b></td>
				<td style="width: 2.8in;">'.htmlentities($this->AxUI->cleanSpecialChars($item['Articulo']['ardescrip'])).'</td>
				<td style="text-align: right; width: 0.6in;">'. number_format($item['Detail']['fadimporteneto']/$item['Detail']['fadcant'],4).'</td>
				<td style="text-align: right; width: 1in;">'. number_format($item['Detail']['fadimporteneto'],4).'</td>
			</tr>
			';
			endforeach;
			
$body.='
	</table>';

$tcpdf->writeHTML($body, true, false, true, false, '');
$tcpdf->Ln();

$totales='
	<table style="width: 100%; border: 1px solid #000; background-color: #E0E0E0;" cellspacing="0" cellpadding="0">
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>SUMA:</b> </td>
				<td style="text-align: right; width: 1in; background-color: #E0E0E0;"><b>'. round($data['Master']['fasuma'],4).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in; background-color: #E0E0E0;"><b>DESC '. number_format($data['Master']['fadesc1'],1).' %:</b></td>
				<td style="text-align: right; width: 1in; background-color: #E0E0E0;"><b>'. number_format(round($data['Master']['fasuma']*($data['Master']['fadesc1']/100),2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;"> &nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>SUBTOTAL:</b></td>
				<td style="text-align: right; width: 1in;"><b>'.number_format(round($data['Master']['factura__faimporte'], 2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>IVA '.number_format($data['Master']['faimpu'],1).' %:</b></td>
				<td style="text-align: right; width: 1in;"><b>'.number_format(round($data['Master']['factura__faimpoimpu'], 2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>TOTAL:</b></td>
				<td style="text-align: right; width: 1in;"><b>'.number_format(round($data['Master']['factura__fatotal'],2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
	</table>';

$tcpdf->writeHTML($totales, true, false, true, false, '');

$pago='
	<div style="border: 1px solid #000; width: 100%; background-color: #E0E0E0;">
		<font size="-1"><b> Prendas totales: </b>'.$ptotal.'</font>&nbsp;&nbsp;
		<font size="-1"><b> Forma de pago: </b>TRANSFERENCIA</font>&nbsp;&nbsp;
		<font size="-1"><b> Condiciones de pago: </b>'.$data['Master']['faplazo'].' dias</font>&nbsp;&nbsp;
		<font size="-1"><b> Metodo de pago: </b>EN UNA SOLA EXHIBICION</font>&nbsp;&nbsp;
		<font size="-1"><b> Num. cta. pago: </b>NO IDENTIFICADA</font>
		<br />
	</div>
';
$tcpdf->writeHTML($pago, true, false, true, false, '');

$avisos='
	<div style="text-align: center; border: 1px solid #000000; padding: 8px; margin: 8px; background: transparent;">
		<font size="+0"><b><i>Este documento es una representacion impresa de un CFDI version 3.2</i></b></font><br />
		<font size="-1"><b>Consulte nuestro aviso de privacidad en <i>http://www.oggi.com.mx/aviso-de-privacidad.html</i></b></font><br />
		<font size="-1"><b>HARD, WILD, BIG JOHN, OIL, STATION, OLE JEANS, SIENTE EL AZUL, OGGI STAR, OGGI MAX, OG JEANS, OGGI JEANS, BLURING, <br />OGGI RED, OGGI BLUE <i>Son marcas registradas propiedad de Junior de Mexico, S.A. de C.V.</i></b></font>
	</div>';
	
$tcpdf->writeHTML($avisos, true, false, true, false, '');
$tcpdf->Ln();

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
$tcpdf->Ln();

$timbre='
	<table style="width: 100%; border: 1px solid #000000; padding: 0px;" border="1" cellspacing="2" cellpadding="2">
		<tr style="border: 1px none;" border="0">
		<td style="width: 30%;">
			<img style="width: 1.15in; height: 1.15in; border: 0px none #000000;" src="'.(APP.DS.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['farefer'].'.png').'" border="0" />
		</td>
		<td style="width: 70%;">
			<div>
				<font size="+1"><b>FOLIO FISCAL: '. htmlentities($data['Master']['uuid']).'</b></font>
			</div>
			<div>
				<b>NUMERO DE SERIE DEL CSD EMISOR:</b> '.htmlentities('00001000000200904226').'
			</div>
			<div>
				<br /><br />
			</div>
			<div>
				<b>NUMERO DE SERIE DEL CERTIFICADO DEL SAT:</b> '.htmlentities($data['Master']['nocertificadosat']).'
			</div>
			<div>
				<b>FECHA Y HORA DE CERTIFICACION:</b> '.htmlentities($data['Master']['fechatimbrado']).'
			</div>
		</td>
		</tr>
	</table>
';

$tcpdf->writeHTML($timbre, true, false, true, false, '');
$tcpdf->Ln();

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
// El resultado de la creacion, lo haremos interrumpiendo el curso normal de la
// respuesta (incicialmente usando el layout 'media') y cambiamos al layout
// 'default', para poder enviar el resultado de la operacion en formato json.
$this->controller->layout='json';

//header('content type: application/json');

echo json_encode( array(
		'result'	=>'ok',
		'message'	=> 'El PDF correspondiente al CFDI de la factura '.$data['Master']['farefer'].' se genero correctamente.',
		'data'		=> $data['Master']			
	));
$this->controller->_end();

/*
header('content type: application/json');
echo json_encode( array(
		'result'	=>'ok',
		'message'	=> 'El PDF correspondiente al CFDI de la factura '.$data['Master']['farefer'].' se genero correctamente.',
		'data'		=> $data			
	));
$this->controller->_end();


*
**/
