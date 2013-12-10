<div class="span8 generacfdi-form">

<header>
<div class="page-header">
<h1><small>Generación y Timbrado de CFDI <strong class="text-info">Factura <?php echo $data['Master']['folio']?> (<?php echo $data['Master']['fecha']?>)</strong></small></h1>
</div>
</header>

<div class="alert alert-error">
<?php echo $message;?>	
</div>	

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group pull-right">	
		<button type="button" class="btn btn-warning btn-small" onclick="downloadXML(<?php echo $data['Master']['id'];?>);" title="Descargar el archivo XML.">
			<i class="icon icon-white icon-envelope"></i>XML
		</button>
		<button type="button" class="btn btn-danger btn-small" onclick="downloadPDF(<?php echo $data['Master']['id'];?>);"  title="Descargar el archivo PDF">
			<i class="icon icon-white icon-envelope"></i>PDF
		</button>
		<button type="button" class="btn btn-info btn-small" onclick="shareCFDI(<?php echo $data['Master']['id'];?>);" title="Enviar archivos XML y PDF por Email al Cliente.">
			<i class="icon icon-white icon-envelope"></i>Mail
		</button>
	</div>
</div>

<?php foreach($respuestas as $item): ?>
<div class="well well-small round-corners">
	<h2 class="text-<?php echo $item[0];?>"><?php echo $item[1];?></h2>
	<pre class="preSmall">
		<?php echo $item[2];?>
	</pre>
</div>

<?php endforeach;?>

<hr/>
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

</script>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
