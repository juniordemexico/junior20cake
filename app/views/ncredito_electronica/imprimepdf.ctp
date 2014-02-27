<?php

define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | ENT_XHTML);

function html($string) {
    return htmlspecialchars($string, REPLACE_FLAGS, CHARSET);
}

//echo html("ñ"); // works

//EJEMPLO PARA GENERAR EL PDF
App::import('Vendor','tcpdf');
$tcpdf = new TCPDF('P');
$tcpdf->SetCreator('AxBOS IDD');
$tcpdf->SetAuthor('Junior de Mexico, SA de CV');
$tcpdf->SetTitle('NCREDITO '.$docto->Master->folio);
$tcpdf->SetSubject('COMPROBANTE FISCAL CFDI INGRESO. NCREDITO '.$docto->Master->folio.'.');
$tcpdf->SetKeywords("JUNIOR, CFDI, PDF, COMPROBANTE FISCAL, NCREDITO, NOTA DE CREDITO, ".$docto->Master->folio);
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
	<tr><td><b>Tipo de Comprobante:</b> '.html($docto->Master->comprobante_tipo).'.</td></tr>
</table>
';

$head_right='
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: transparent;">
	<tr><td style="text-align: right;"><b>Expedido en: Mexico, D.F. a '.html($docto->Master->fecha).'</font></td></tr>
	<tr><td style="text-align: right;"><font size="+3"><b>NOTA DE CREDITO '.html($docto->Master->folio).'</b></font></td></tr>
	<tr><td style="text-align: right;"><font size="-1"><b>( UUID: '.html($docto->Master->uuid).' )</b></font></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><font size="+1"><b><u>R E C E P T O R</u></b></font></td></tr>
	<tr><td><font size="+1"><b>'.html($docto->Receptor->clnom).'</b></font></td></tr>
	<tr><td><b>'.html($docto->Receptor->clrfc).'.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>Domicilio:</b></td></tr>
	<tr><td>'.
		'<b>Calle:</b> '.html($docto->Receptor->clcalle).'.<br />'.
		'<b>Num Exterior:</b> '.html($docto->Receptor->clnumext).'.&nbsp;&nbsp;&nbsp;&nbsp;'.'<b>Num Interior:</b> '.html($docto->Receptor->clnumint).'.<br />'.
		'<b>Colonia:</b> '.html($docto->Receptor->clcolonia).'.<br />'.
		'<b>Delegacion:</b> '.html($docto->Receptor->cldelegacion).'.<br />'.
		'<b>Ciudad y Estado:</b> '.html($docto->Receptor->clciu).', '.html($docto->Receptor->cledo).'.<br/>'.
		'<b>Pais:</b> '.html($docto->Receptor->clpais).',&nbsp;&nbsp;&nbsp;&nbsp;'.' <b>C.P.:</b> '.html($docto->Receptor->clcp).'.<br />'.
		'
	</td></tr>
	<tr><td><b>Enviar a:</b><br/ >'. html($docto->Receptor->clenviara).'</td></tr>
	<tr><td><b>Devolucion:</b> '.html($docto->Master->ncdevol).'.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Factura:</b> '.html($docto->Master->ncfactura).'<br /><b>Divisa:</b> '.html(trim($docto->Master->divisa_cve)=='MN'?'MXP':$docto->Master->divisa_cve).'.&nbsp;&nbsp;<b>Tipo de Cambio:</b> '.html($docto->Master->tcambio).'</td></tr>
</table>
';

$head=	'<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="50%" style="padding: 4pt;">'.
		$head_left.'</td><td style="padding: 4pt;">'.
		$head_right.
		'</td></tr></table>';
$tcpdf->writeHTML($head, true, false, true, false, '');
$tcpdf->Ln();


$body='
	<table style="font-size: 7pt; width: 100%; border: 1px solid #000000;" border="1">
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
			foreach($docto->Details as $item):
				$ptotal += $item->cant;
				$body.='<tr>
				<td style="text-align: right; width: 0.5in;">'.number_format(($item->cant), 0).'</td>
				<td style="width: 0.5in;">'.html($item->unidad_cve).'</td>
				<td style="width: 1.6in;"><b>'.html($this->AxUI->cleanSpecialChars($item->arcveart)).'</b></td>
				<td style="width: 2.8in;">'.html($this->AxUI->cleanSpecialChars($item->ardescrip)).'</td>
				<td style="text-align: right; width: 0.6in;">'. number_format($item->importe/$item->cant,2).'</td>
				<td style="text-align: right; width: 1in;">'. number_format($item->importe,2).'</td>
			</tr>
			';
			endforeach;
			
$body.='
	</table>';

$tcpdf->writeHTML($body, true, false, true, false, '');
//$tcpdf->Ln();

$totales='
	<table style="width: 100%; border: 1px solid #000; background-color: #E0E0E0;" cellspacing="0" cellpadding="0">
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>SUMA:</b> </td>
				<td style="text-align: right; width: 1in; background-color: #E0E0E0;"><b>'. number_format(round($docto->Master->suma,2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;"> &nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>SUBTOTAL:</b></td>
				<td style="text-align: right; width: 1in;"><b>'.number_format(round($docto->Master->total, 2)-round($docto->Master->impoimpu, 2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>IVA '.number_format($docto->Master->impuesto_tasa,1).' %:</b></td>
				<td style="text-align: right; width: 1in;"><b>'.number_format(round($docto->Master->impoimpu, 2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align: right; width: 0.5in;">&nbsp;</td>
				<td style="width: 0.5in;">&nbsp;</td>
				<td style="width: 4.4in;">&nbsp;</td>
				<td style="text-align: right; width: 0.6in;"><b>TOTAL:</b></td>
				<td style="text-align: right; width: 1in;"><b>'.number_format(round($docto->Master->total,2),2).'</b>&nbsp;&nbsp;</td>
			</tr>
	</table>';

$tcpdf->writeHTML($totales, true, false, true, false, '');

$pago='
	<div style="border: 1px solid #000; width: 100%; background-color: #E0E0E0;">
		<font size="-1"><b> Prendas totales:</b> '.$ptotal.'</font>&nbsp;&nbsp;
		<font size="-1"><b> Forma de pago:</b> EN UNA SOLA EXHIBICION</font>&nbsp;&nbsp;
		<font size="-1"><b> Metodo de pago:</b> '.html($docto->Master->metodo_pago).'</font>&nbsp;&nbsp;
		<font size="-1"><b> Num. cta. pago:</b> '.html($docto->Master->num_cta_pago).'</font>
		<br />
	</div>
';
$tcpdf->writeHTML($pago, true, false, true, false, '');

$observaciones='
	<div style="text-align: left; border: 1px solid #000000; padding: 8px; margin: 8px; background: transparent;">
		<font size="+0"><b>Observaciones:</b> &nbsp;&nbsp;&nbsp;<i>'.html($docto->Master->observaciones).'</i></font><br />
	</div>';
	
$tcpdf->writeHTML($observaciones, true, false, true, false, '');
//$tcpdf->Ln();

$avisos='
	<div style="text-align: center; border: 1px solid #000000; padding: 8px; margin: 8px; background: transparent;">
		<font size="+0"><b><i>Este documento es una representacion impresa de un CFDI version 3.2</i></b></font><br />
		<font size="-1"><b>Consulte nuestro aviso de privacidad en <i>http://www.oggi.com.mx/aviso-de-privacidad.html</i></b></font><br />
		<font size="-1"><b>HARD, WILD, BIG JOHN, OIL, STATION, OLE JEANS, SIENTE EL AZUL, OGGI STAR, OGGI MAX, OG JEANS, OGGI JEANS, BLURING, <br />OGGI RED, OGGI BLUE <i>Son marcas registradas propiedad de Junior de Mexico, S.A. de C.V.</i></b></font>
	</div>';
	
$tcpdf->writeHTML($avisos, true, false, true, false, '');
//$tcpdf->Ln();

$cadena='
	<div style="border: 1px solid #000; width: 100%; padding: 4pt;">
		<font size="-1"><b>CADENA ORIGINAL:</b></font> <br />
		<font size="-2">'. html($docto->Master->cadenaoriginal).'<br /></font>
	</div>';

$tcpdf->writeHTML($cadena, true, false, true, false, '');

$sello='
	<div style="border: 1px solid #000; width: 100%; ">
		<font size="-1"><b>SELLO DIGITAL:</b></font> <br />
		<font size="-1">'. html($docto->Master->sellocfd).'</font><br />
	</div>';

$tcpdf->writeHTML($sello, true, false, true, false, '');

$sellosat='
	<div style="border: 1px solid #000; width: 100%; ">
		<font size="-1"><b>SELLO SAT:</b></font> <br />
		<font size="-1">'. html($docto->Master->sellosat).'</font><br />
	</div>';

$tcpdf->writeHTML($sellosat, true, false, true, false, '');
$tcpdf->Ln();

$timbre='
	<table style="width: 100%; border: 1px solid #000000; padding: 0px;" border="1" cellspacing="2" cellpadding="2">
		<tr style="border: 1px none;" border="0">
		<td style="width: 30%;">
			<img style="width: 1.15in; height: 1.15in; border: 0px none #000000;" src="'.(APP.DS.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$docto->Master->folio.'.png').'" border="0" />
		</td>
		<td style="width: 70%;">
			<div>
				<font size="+1"><b>FOLIO FISCAL: '. html($docto->Master->uuid).'</b></font>
			</div>
			<div>
				<b>NUMERO DE SERIE DEL CSD EMISOR:</b> '.html('00001000000200904226').'
			</div>
			<div>
				<b>NUMERO DE SERIE DEL CERTIFICADO DEL SAT:</b> '.html($docto->Master->nocertificadosat).'
			</div>
			<div>
				<b>FECHA Y HORA DE CERTIFICACION:</b> '.html($docto->Master->fechatimbrado).'
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

$filename='JME910405B83-'.$docto->Master->folio.'.pdf';

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
		'message'	=> 'El PDF correspondiente al CFDI de la nota de credito '.$docto->Master->folio.' se genero correctamente.',
		'data'		=> $docto->Master
	));

//echo '<script> window.close();</script>'."\n\r";
//die();
$this->controller->_end();