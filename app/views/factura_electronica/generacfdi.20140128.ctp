<div class="span8 generacfdi-form">

<header>
<div class="page-header">
<h3><strong>Timbrado de CFDI</strong> &nbsp;&nbsp;&nbsp;&nbsp; <em class="text-info">Factura <?php echo $docto->Master->folio; ?> (<?php echo $docto->Master->fecha; ?>)</em></h3>
</div>
</header>

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<button type="button" class="btn btn-primary" onclick="javascript: location.reload();" title="Reintentar el timbrado una vez más.">
			<i class="icon icon-white icon-envelope"></i> Reintentar
		</button>
		<button type="button" class="btn btn-warning" onclick="javascript: window.close();" title="Cerrar esta ventana">
			<i class="icon icon-white icon-envelope"></i> Cerrar
		</button>
	</div>

	<div class="btn-group pull-right">	
		<button type="button" class="btn btn-warning" onclick="viewXML(<?php echo $docto->Master->id;?>);" title="Ver el archivo XML.">
			<i class="icon icon-white icon-envelope"></i>XML
		</button>
		<button type="button" class="btn btn-danger" onclick="imprimePDF(<?php echo $docto->Master->id;?>);"  title="Generar o Regenerar el Archivo PDF">
			<i class="icon icon-white icon-envelope"></i>Genera PDF
		</button>
		<button type="button" class="btn btn-danger" onclick="viewPDF(<?php echo $docto->Master->id;?>);"  title="Ver el archivo PDF">
			<i class="icon icon-white icon-envelope"></i>PDF
		</button>
		<button type="button" class="btn btn-info" onclick="shareCFDI(<?php echo $docto->Master->id;?>);" title="Enviar archivos XML y PDF por Email al Cliente.">
			<i class="icon icon-white icon-envelope"></i>Mail
		</button>
	</div>
</div>

<div class="alert alert-success">
<?php echo $message;?>	
</div>	

<?php if( isset($responses)): ?>
<?php foreach($responses as $item): ?>
	<h3 class="text-<?php echo $item[0];?>"><?php echo $item[1];?></h3>
	<div class="well">
		<pre style="height: 32px; min-height: 32px; max-height: 32px; overflow: scroll;">
		<?php echo $item[2];?>
		</pre>
	</div>

<hr/>
<?php
if($item[0]=='error') $ok=false; $ok=true;
?>
<?php endforeach;?>
<?php endif;?>

	<h3 class="text-info">Creación del PDF <small>(representación impresa del xml)</small></h3>
	<div class="well">
		<pre style="height: 32px; min-height: 32px; max-height: 32px; overflow: scroll;">
<?php //if( isset($response) && isset($response['result']) && $response['result']=='ok'): ?>
		<iframe style="height: 48px; max-height: 48px; overflow: scroll;" src="/FacturaElectronica/imprimepdf/<?php echo $docto->Master->id; ?>"></iframe>
<?php //endif;?>
		</pre>
<?php
/*
	if($ok) {
		$aca=$this->requestAction('/FacturaElectronica/imprimepdf/'.$docto->Master->id, array('return'));
		print_r($aca);
	}
*/
?>
	</div>

	<h3 class="text-info">Envio de Correo <small>(con archivos XML y PDF adjuntos)</small></h3>
	<div class="well">
		<pre style="height: 32px; min-height: 32px; max-height: 32px; overflow: scroll;">
<?php if( false && isset($response) && isset($response['result']) && $response['result']=='ok'): ?>
		<iframe style="height: 48px; max-height: 48px; overflow: scroll;" src="/FacturaElectronica/enviacorreo/<?php echo $docto->Master->id; ?>"></iframe>
<?php endif;?>
		</pre>
<?php
/*
		<iframe style="height: 48px; max-height: 48px; overflow: scroll;" src="/FacturaElectronica/enviacorreo/<?php echo <?php echo $docto->Master->id; ?>?>"></iframe>
if ($ok) {
	$joe=$this->requestAction('/FacturaElectronica/enviacorreo/'.$docto->Master->id);
	print_r($joe);
}
**/
?>
	</div>

<hr />



</div> <!-- ENDS .generacfdi-form -->


<script>

var generaCFDI = function(id) {
	window.open('/FacturaElectronica/generacfdi/'+id);
}

var downloadXML = function(id) {
	location.replace('/FacturaElectronica/download/'+id+'/xml');
}

var downloadPDF = function(id) {
	location.replace('/FacturaElectronica/download/'+id+'/pdf');
}

var shareCFDI = function(id) {
	window.open('/FacturaElectronica/enviacorreo/'+id);
}

var verXML = function(id) {
	location.replace('/FacturaElectronica/ver/'+id+'/xml');
}

var verPDF = function(id) {
	location.replace('/FacturaElectronica/ver/'+id+'/pdf');
}

var imprimePDF = function(id) {
	location.replace('/FacturaElectronica/imprimepdf/'+id);
}

</script>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
