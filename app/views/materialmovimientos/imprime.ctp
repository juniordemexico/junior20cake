<div id="divLayout" style="width: 8in; height: 5in; border:0px none; font-size: 9pt; margin: 0px; padding: 0px;">

<header>
<div id="divHeader" style="width: 100%; text-align: left; height: 2in; max-height: 2in;">
	
	<div id="divCompanyData" style="float: left; width: 40%; text-align: left; vertical-align: top; padding: 4px; margin: 4px; font-size: 7pt; line-height: 9pt;">
		<ul style="list-style-type: none;">
			<li><img style="width: 1in; height: 0.5882;" src="/img/logos/oggi_logo_tiny.png" border="0"/></li>
			<li style="font-weight: bold; font-size: 10pt; line-height: 12pt;">JUNIOR DE MEXICO, S.A. DE C.V.</li>
			<li>JME910405B83</li>
			<li>Av. Paseo de la Reforma, No. 2654 Piso15 Int. 1501</li>
			<li>Constituyentes, Col. Lomas Altas Del. Miguel Hidalgo.</li>
			<li>C.P. 11950 México D.F.</li>
		</ul>
	</div> <!-- #divCompanyData -->				
	<div id="divDocumentData" style="width: 55%; float: right; text-align: left; vertical-align: middle; background-color: #D0D0D0; vertical-align: top; padding: 4px; margin: 0px; border: 1px solid #000;">
		<table style="font-size: 9pt; line-height: 11pt; background-color: #D0D0D0; text-align: left;" cellspacing="0" cellpadding="0">
			<tbody>
				<tr><td style="text-align: right; width: 33%; padding: 2pt; font-size: 10pt;">Folio: </td>
					<td style="font-weight: bold; padding: 2pt; font-size: 10pt;"><?php echo $data['Master']['esrefer']?></td>
				</tr>
				<tr><td style="10pt; text-align: right; width: 33%; padding: 2pt; font-size: 10pt;">Fecha: </td>
					<td style="font-weight: bold; padding: 2pt; font-size: 10pt;"><?php echo $data['Master']['esfecha']?></td>
				</tr>
				<tr><td style="text-align: right; width: 33%; padding: 2pt;">Almacén: </td>
					<td style="font-weight: bold; padding: 2pt;"><?php echo $data['Almacen']['aldescrip']?></td>
				</tr>
				<tr><td style="text-align: right; width: 33%; padding: 2pt;">Tipo de Mov.: </td>
					<td style="font-weight: bold; padding: 2pt;"><?php echo $data['Tipoartmovbodega']['cve']?></td>
				</tr>
				<tr><td style="text-align: right; width: 33%; padding: 2pt;">Referencia Compra: </td>
					<td style="font-weight: bold; padding: 2pt;"><?php echo $data['Master']['ocompra_refer']?></td>
				</tr>
				<tr><td style="text-align: right; width: 33%; padding: 2pt;">Referencia Orden de Prod.: </td>
					<td style="font-weight: bold; padding: 2pt;"><?php echo $data['Master']['oproduce_refer']?></td>
				</tr>
				<tr rowspan="2"><td style="text-align: right; width: 33%; padding: 2pt; vertical-align: top;">Concepto: </td>
					<td style="font-weight: bold; padding: 2pt; text-align: left;"><?php echo $data['Master']['esconcep']?></td>
				</tr>
				<tr><td style="text-align: right; width: 33%; padding: 2pt;">Estatus: </td>
					<td style="font-weight: bold; padding: 2pt;">&nbsp;	<?php //echo ($data['Master']['st'] == "C") ? 'CANCELADO' : (($data['Master']['st'] == "A")? 'ACTIVO' : $data['Master']['st']);?></td>
				</tr>
			</tbody>
		</table>
	</div> <!-- #divDocumentData -->

</div> <!-- #divHeader -->
</header>

<section>
<div id="divBody" style="width: 100%; text-align: left; min-height: 2.1in;">

	<table style="font-size: 8pt; width: 100%; margin: 0px; padding: 0px; border: 1px solid #000;" cellspacing="0" cellpadding="0">

	<thead>
		<tr style="text-align:center; background-color: #D0D0D0;">
			<th style="width: 2in;">CÓDIGO</th>
			<th style="width: 1.5in;">COLOR</th>
			<th style="">DESCRIPCIÓN</th>
			<th style="width: 1in;">CANTIDAD</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total=0;
			foreach($data['Details'] as $item):
				$total += $item['Detail']['esdcant'];
		?>
		<tr style="text-align: left;">
			<td style=""><?php echo $item['Articulo']['arcveart']?></td>
			<td style=""><?php echo $item['Color']['cve']?></td>
			<td style=""><?php echo $item['Articulo']['ardescrip']?></td>
			<td style="text-align: right;"><?php echo $item['Detail']['esdcant']?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr style="background-color: #D0D0D0;font-size: 10pt; font-weight: bold;text-align:right;">
			<td style="" colspan="3" style="">TOTAL UNIDADES:</td>
			<td style=""><?php echo $total?></td>
		</tr>
	</tfoot>

	</table>

</div> <!-- #divBody -->
</section>

<footer>
<div id="divFooter" style="width: 100%; height: 1.55in; max-height: 1.55in; border:1px solid #000;">
	<div id="divObservaciones" style="font-size: 8pt; height:0.75in; font-weight: bold; width: 100%; text-align: left;">
		<span style="font-weight: bold;">OBSERVACIONES:</span><br/>
		<?php echo $data['Master']['esobser']?>
	</div>
	<div id="divOtros" style="font-size: 8pt; border-top: 1px solid #000; height:0.75in; font-weight: bold; width: 100%; text-align: left;">
			<span style="font-weight: bold;">OTROS:</span><br/>
	</div>
</div> <!-- divFooter -->
</footer>

</div> <!-- #divLayout -->