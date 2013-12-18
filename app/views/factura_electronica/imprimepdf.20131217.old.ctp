<?php
//EJEMPLO PARA GENERAR EL PDF
App::import('Vendor','tcpdf');
$tcpdf = new TCPDF();
$tcpdf->SetCreator('AxBOS IDD');
$tcpdf->SetAuthor('Junior de Mexico, SA de CV');
$tcpdf->SetTitle('FACTURA '.$data['Master']['farefer']);
$tcpdf->SetSubject('COMPROBANTE FISCAL CFDI INGRESO. FACTURA '.$data['Master']['farefer'].'.');
$tcpdf->SetKeywords("JUNIOR, CFDI, PDF, COMPROBANTE FISCAL, FACTURA, FACTURA ELECTRONICA, ".$data['Master']['farefer']);
$tcpdf->setPrintHeader(false);
$tcpdf->setPrintFooter(false);
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$tcpdf->AddPage();
$subtable='
	<table cellpadding="0" style="font-size: 8pt; ">
		<tr style="text-align:center;">
			<td>
				<img style="width: 1in; height: 0.6in;" src="/app/webroot/img/logos/oggi_logo_tiny.png" border="0"/>
			</td>
		</tr>
		<tr style="text-align:center; font-weight: bold;">
			<td>EMISOR</td>
		</tr>
		<tr style="font-size: 10pt; font-weight: bold;">
			<td>JUNIOR DE MEXICO, S.A. DE C.V.</td>
		</tr>
		<tr>
			<td>
				<br>JME910405B83
				<br>Av. Paseo de la Reforma, No. 2654 Piso15 Int. 1501
				<br>Constituyentes, Col. Lomas Altas Del. Miguel Hidalgo.
				<br>C.P. 11950 México D.F.
			</td>
		</tr>
		<tr>
			<td>
				<span style="font-weight: bold;">Lugar de Emisión:</span><br/>
				<span>Av. Viaducto rio de la piedad No. 525 A Granjas México<br/>
				 	C.P.: 08400<br/>
				 	Iztacalco, Distrito Federal<br/>
				 	México
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<span style="font-weight: bold;">Regimen Fiscal: </span>
				<span>Regimen General de ley Personas Morales</span>
			</td>
		</tr>
		<tr>
			<td>
				<span style="font-weight: bold;">Método de Pago: </span> 
				<span>'. $data['Cliente']['clmtdopago'].'</span>
			</td>
		</tr>
		<tr>
			<td>
				<span style="font-weight: bold;">No. Cuenta Pago: </span>
			</td>
		</tr>
	</table>';
	
$subtable1='<table style="font-size: 8pt; background-color: #D0D0D0; height: 100%;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align: left; width: 70%; font-weight: bold;" colspan="2">México, D.F. a '. $data['Master']['fafecha'].'</td>
						<td style="text-align: middle; width: 30%; font-weight: bold;" colspan="2">'. $data['Master']['farefer'].'</td>
				</tr>
				<tr>
					<td style="text-align: center; font-weight: bold" colspan="4">RECEPTOR</td>
				</tr>
				<tr height="100">
					<td style="text-align: left;" colspan="4">'. $data['Cliente']['clnom'].'
					<br>'. $data['Cliente']['cldir'].'
					<br>'. $data['Cliente']['clciu'].' , 
						'. $data['Cliente']['cledo'].' C.P. 
						'. $data['Cliente']['clcp'].'
						<br>Tels. '. $data['Cliente']['cltel'].'
						<br>'. $data['Cliente']['clrfc'].'
					</td>
				</tr>
				<tr>
					<td colspan="4">Enviar a:
						<p>'. $data['Cliente']['clenviara'].'</p>
					</td>
				</tr>
				<tr height="50">
					<td style="text-align: left;" colspan="2">
					Pedido: '. $data['Master']['pedido_id'].'
					<p>Su Pedido:</p>
					</td>
					<td style="text-align: left;" colspan="2">
					Prov.:
					<p>Depto:</p>
					</td>
				</tr>
				<tr>
					<td style="text-align: left;" height="50" colspan="4">Año de Aprobación:	
						<br>Num. Aprobación:
						<br>	
						<br>Certificado:
					</td>
				</tr>
				<tr>
					<td style="text-align: left;">Divisa: '. $data['Divisa']['dicve'].'</td>
					<td style="text-align: left;">Tipo de Cambio: '.number_format(($data['Divisa']['ditcambio']), 0).'</td>
				</tr>
			</table>
';
$subtable2='
	<table style="font-size: 8pt; width: 100%;" border="1px">
		<tr style="text-align:center; background-color: #D0D0D0; font-weight: bold;">
			<td width="10%">Cantidad</td>
			<td width="10%">Unidad</td>
			<td width="50%">Descripción</td>
			<td width="15%">Precio</td>
			<td width="15%">Importe</td>
		</tr>
		<tbody>';
		
			$ptotal=0;
			foreach($data['Details'] as $item):
				$ptotal += $item['Detail']['fadcant'];
$subtable2.='<tr style="text-align:center;">
				<td>'.number_format(($item['Detail']['fadcant']), 0).'</td>
				<td>'.$item['Articulo']['arunidad'].'</td>
				<td>'.$item['Articulo']['ardescrip'].'</td>
				<td>'.$item['Detail']['fadprecio'].'</td>
				<td>'.$item['Detail']['fadimporteneto'].'</td>
			</tr>
			';
			endforeach;
			
$subtable2.='
		</tbody>
		<tfoot>
			<tr style="text-align:center; font-weight: bold;">
				<td colspan="5">
					Este documento es una representación impresa de un CFD
				</td>
			</tr>
		</tfoot>
	</table>';
$subtable3= '
		<table style="text-align: right; font-size: 8pt; padding: 1px; font-weight: bold; padding: 2px;" cellpadding="0" width="100%" border="1px">
			<tr>
				<td style="background-color: #D0D0D0;">Suma: </td>
				<td style="font-weight: normal;">'. $data['Master']['fasuma'].'</td>
			</tr>
			<tr>
				<td style="background-color: #D0D0D0;">Descuento: </td>
				<td style="font-weight: normal;">'. $item['Articulo']['ardesc1'].'</td>
			</tr>
			<tr>
				<td style="background-color: #D0D0D0;">Sub-Total: </td>
				<td style="font-weight: normal;">'. $data['Master']['fasuma'].'</td>
			</tr>
			<tr>
				<td style="background-color: #D0D0D0;">IVA 16 % </td>
				<td style="font-weight: normal;">'. number_format(($data['Master']['factura__faimpoimpu']), 4).'</td>
			</tr>
			<tr>
				<td style="background-color: #D0D0D0;">Total: </td>
				<td style="font-weight: normal;">'. number_format(($data['Master']['factura__fatotal']), 4).'</td>
			</tr>
		</table>';
$subtable4='
	<table style="font-size: 8pt;"  border="1" cellpadding="0">
		<tr style="text-align:center;">
			<td style=" width: 80%; text-align: left;">Prendas Totales:  '.$ptotal.'</td>
			<td style=" width: 20%;" rowspan="2">'.$subtable3.'</td>
		</tr>
		<tr>
			<th align="left" valign="top" colspan="2">Importe con letra: </th>
		</tr>
		<tr>
			<td style="width: 33%;">N.Cajas: 7</td>
			<td style="width: 67%;">Transporte: </td>
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
		<tr style="width: 100%;">
			<td style="width: 30%;"><img style="width: 2in; height: 2in;" src="'.(APP.DS.'files'.DS.'comprobantesdigitales'.DS.'JME910405B83-'.$data['Master']['farefer'].'.png').'" border="0"/></td>
			<td style="width: 70%; text-align: left;">
				<ul style="list-style-type: none; font-size: 8pt">
					<li style="font-weight: bold;">
						FOLIO FISCAL: 
						<span style="font-weight: normal;">'.$data['Comprobante']['uuid'].'</span>
					</li>
					<li style="font-weight: bold;"><br/>
						No. DE SERIE DEL CERTIFICADO DEL SAT: 
						<span style="font-weight: normal;">'.$data['Comprobante']['no_certificado_sat'].'</span>
					</li>
					<li style="font-weight: bold;"><br/>
						FECHA Y HORA DE CERTIFICACIÓN: 
						<span style="font-weight: normal;">'.$data['Comprobante']['fecha_timbrado'].'</span>
					</li>
					<li style="font-weight: bold;"><br/>NÚMERO DE SERIE DEL CSD DEL EMISOR: 
						<span style="font-weight: normal;"><!--'.$data['Comprobante']['fecha_timbrado'].'--></span>
					</li>
				</ul>
			</td>
		</tr>
	</table>
';

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
			<div id="divObs" style="font-size: 8pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				Observaciones: <br/>
				<span style="font-weight: normal;">
					<!--'. $data['Comprobante']['sello_cfd'].'--><br/>
				</span>
			</div>
			<div id="divPrivacidad" style="font-size: 8pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				Consulte nuestro aviso de privacidad en http://www.oggi.com.mx/aviso-de-privacidad.html
			</div>
			<div id="divMarcas" style="font-size: 8pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				Las marcas registradas: HARD, WILD, BIG JOHN, OIL, STATION, OLE JEANS, SIENTE EL AZUL, OGGI STAR, OGGI MAX, OG JEANS, OGGI JEANS, BLURING, OGGI RED, OGGI BLUE. Son propiedad de Junior de México, S.A. de C.V.
				<!--<span style="font-weight: normal;">'. $data['Comprobante']['sello_cfd'].'</span>-->
			</div>
			<div id="divSelloDigital" style="font-size: 8pt;  border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
				SELLO DIGITAL DEL CFDI: <br/>
				<span style="font-weight: normal;">'. $data['Comprobante']['sello_cfd'].'
				</span>
			</div>
			<div id="divSelloSAT" style="font-size: 8pt; border-top: 1px solid #000; font-weight: bold; width: 100%; text-align: left;">
					SELLO DEL SAT: <br/>
					<span style="font-weight: normal;">'. $data['Comprobante']['sello_sat'].'
					</span>
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
$filename='JME910405B83-'.$data['Master']['farefer'].'.pdf';
$tcpdf->writeHTML($html, false, false, false, false, '');
$tcpdf->Output(APP.DS.'files'.DS.'comprobantesdigitales'.DS.$filename , "F");

// El PDF ya se genero, pero no lo vamos a enviar al user-agent, solo lo dejamos 
// grabado en nuestro sistema local de archivos.
// Por lo tanto, la accion 'imprimepdf' usa esta vista inicialmente para generar
// el PDF a partir de HTML. Una vez generado, tenemos que devolver al user-agent
// El resultado de la creación, lo haremos interrumpiendo el curso normal de la
// respuesta (incicialmente usando el layout 'media') y cambiamos al layout
// 'default', para poder enviar el resultado de la operacion en formato json.
//$this->controller->layout='default';

header('content type: application/json');
echo json_encode( array(
		'result'	=>'ok',
		'message'	=> 'El PDF correspondiente al CFDI de la factura '.$data['Master']['farefer'].' se genero correctamente.',
		'data'		=> $data			
	));
//$this->controller->_end();
