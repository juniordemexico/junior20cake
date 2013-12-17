<div class="span8 generacfdi-form">

<div class="page-header">
<h3><strong>Cancelación de Facturas CFDI</strong> &nbsp;&nbsp;&nbsp;&nbsp; <em class="text-info">Factura <?php echo $data['Factura']['farefer']; ?> (id: <?php echo $data['Factura']['id']; ?>)</em></h3>
</div>

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
		<button type="button" class="btn btn-info" onclick="downloadCancelaCFDI(<?php echo $data['Factura']['id']; ?>);" title="Descargar XML de la cancelacón.">
			<i class="icon icon-white icon-envelope"></i>XML
		</button>
	</div>
</div>

<h4 class="text-<?php echo $result=='ok'?'info':'error';?>">Resultado de la Cancelacion de CFDI</h4>
<div class="well">
	<p><strong><?php echo $message;?></strong></p>
	<pre style="height: 128px; min-height: 128px; max-height: 128px; overflow: scroll;">
		<?php echo htmlentities($response);?>
	</pre>
</div>

</div>

<script>


var downloadCancelaCFDI = function(id) {
	location.replace('/FacturaElectronica/downloadcancela/'+id+'/xml');
}

var shareCFDICancel = function(id) {
	window.open('/FacturaElectronica/enviacorreocancela/'+id);
}

</script>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
