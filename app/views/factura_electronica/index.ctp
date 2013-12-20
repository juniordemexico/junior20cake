<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								'limit'=>20,
								));
?>

<div id="gridWrapper">
<?php 
echo $form->create('Factura',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('farefer', array('label' => '', 'type' => 'search', 'maxLength' => '8', 'placeholder' => 'Folio'));?></th>
				<th class="date"><?php echo $form->text('fafecha',array('label' => '', 'type' => 'search', 'maxLength' => '10', 'placeholder' => 'Fecha'));?></th>
				<th class="cvecli"><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Cliente'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Tda'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Vend'));?></th>
				<th class="total"><?php echo $form->text('fatotal',array('label' => '', 'type' => 'search', 'maxLength' => '14', 'placeholder' => 'Total'));?></th>
				<th class="st"><?php echo $form->text('fast',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST'));?></th>
				<th class="uuid"><?php echo $form->text('UUID',array('label' => '', 'type' => 'search', 'maxLength' => '36', 'placeholder' => 'UUID...'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
				<th class="action">&nbsp;</th>
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','farefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','fafecha'); ?></th>
				<th class="cvecli"><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','fatotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','fast'); ?></th>
				<th class="uuid"><?php echo $this->Paginator->sort('UUID','uuid'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
				<th class="action">ACCIONES</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($facturas as $factura):
			$class = null;
			$thisID=trim($factura['Factura']['id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="refer" title="Pedido: <?php echo $factura['Factura']['fapedido']; ?>."><?php echo $factura['Factura']['farefer']; ?></td>
				<td class="date"><?php echo substr($factura['Factura']['fafecha'],0,10); ?></td>
				<td class="cvecli" title="<?php echo $factura['Cliente']['clnom']; ?>"><?php echo $factura['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($factura['Cliente']['clsuc']); ?>"><?php echo $factura['Cliente']['cltda']; ?></td>
				<td class="cveven" title="<?php echo $factura['Vendedor']['venom']; ?>"><?php echo $factura['Vendedor']['vecveven']; ?></td>
				<td class="total"><?php echo $this->Number->currency($factura['Factura']['factura__fatotal']); ?></td>
				<td class="st" title="Fecha de Cancelación: <?php echo $factura['Factura']['cancelafecha']; ?>"><?php echo $factura['Factura']['fast']; ?></td>
				<td class="uuid" title="<?php echo 'Fecha Timbrado: '.$factura['Factura']['crefec'].'.'; ?>"><?php echo $factura['Factura']['uuid']; ?></td>
				<td class="id" title="<?php echo 'Creado: '.$factura['Factura']['crefec'].'. Modificado: '.$factura['Factura']['modfec'].'.'; ?>"><?php echo $factura['Factura']['id']; ?></td>
				<td class="action">

				<div class="btn-group">
<?php if(substr($factura['Factura']['farefer'],0,1)=='D'):?>
				<button type="button" class="btn btn-danger btn-small <?php if(!empty($factura['Factura']['cancelafecha']) || $factura['Factura']['fast']<>'C' ) echo "disabled";?>" onclick="<?php if(empty($factura['Factura']['cancelafecha']) && $factura['Factura']['fast']=='C') echo "cancelaCFDI(".$factura['Factura']['id'].")";?>" 
					title="Timbrar la Cancelación de esta Factura con el PAC.">
					<i class="icon icon-white icon-qrcode"></i>Cancela
				</button>
<?php endif;?>
				</div>
				<div class="btn-group pull-right">
<?php if(substr($factura['Factura']['farefer'],0,1)=='D'):?>
				<button type="button" class="btn btn-primary btn-small <?php if(!empty($factura['Factura']['fechatimbrado'])) echo "disabled";?>" onclick="<?php if(empty($factura['Factura']['fechatimbrado'])) echo "generaCFDI(".$factura['Factura']['id'].")";?>" title="Generar el XML. Timbrarlo con el PAC. Y enviar XML y PDF al Cliente.">
					<i class="icon icon-white icon-qrcode"></i>Timbra
				</button>
<?php endif;?>
				<button type="button" class="btn btn-warning btn-small" onclick="verXML(<?php echo $factura['Factura']['id'];?>);" title="Descargar el archivo XML.">
					<i class="icon icon-white icon-envelope"></i>XML
				</button>
				<button type="button" class="btn btn-danger btn-small" onclick="verPDF(<?php echo $factura['Factura']['id'];?>);"  title="Ver el archivo PDF">
					<i class="icon icon-white icon-envelope"></i>PDF
				</button>
				<button type="button" class="btn btn-info btn-small" onclick="shareCFDI(<?php echo $factura['Factura']['id'];?>);" title="Enviar archivos XML y PDF por Email al Cliente.">
					<i class="icon icon-white icon-envelope"></i>
				</button>
				</div>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
</div>

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Factura','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

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

var cancelaCFDI = function(id) {
	window.open('/FacturaElectronica/cancelacfdi/'+id);
}

var downloadCancelaCFDI = function(id) {
	window.open('/FacturaElectronica/downloadcancela/'+id+'/xml');
}

var verPDF = function(id) {
	window.open('/FacturaElectronica/ver/'+id+'/pdf');
}

var verXML = function(id) {
	window.open('/FacturaElectronica/ver/'+id+'/xml');
}


</script>
<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
