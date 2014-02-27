<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								'limit'=>25,
								));
?>

<div id="gridWrapper">
<?php 
echo $form->create('Ncredito',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('ncrefer', array('label' => '', 'type' => 'search', 'maxLength' => '8', 'placeholder' => 'Folio'));?></th>
				<th class="date"><?php echo $form->text('ncfecha',array('label' => '', 'type' => 'search', 'maxLength' => '10', 'placeholder' => 'Fecha'));?></th>
				<th class="cvecli"><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Cliente'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Tda'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Vend'));?></th>
				<th class="refer"><?php echo $form->text('ncdevol',array('label' => '', 'type' => 'search', 'maxLength' => '8', 'placeholder' => 'Devolucion'));?></th>
				<th class="total"><?php echo $form->text('nctotal',array('label' => '', 'type' => 'search', 'maxLength' => '14', 'placeholder' => 'Total'));?></th>
				<th class="st"><?php echo $form->text('ncst',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST'));?></th>
				<th class=""><?php echo $form->text('UUID',array('label' => '', 'type' => 'search', 'maxLength' => '36', 'placeholder' => 'UUID...'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
				<th class="action">&nbsp;</th>
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','ncrefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','ncfecha'); ?></th>
				<th class="cvecli"><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Devolucion','nctotal'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','nctotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','ncst'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('UUID','uuid'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
				<th class="action">ACCIONES</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $ncredito):
			$class = null;
			$thisID=trim($ncredito['Ncredito']['id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="refer" title="Pedido: ."><?php echo $ncredito['Ncredito']['ncrefer']; ?></td>
				<td class="date"><?php echo substr($ncredito['Ncredito']['ncfecha'],0,10); ?></td>
				<td class="cvecli" title="<?php echo $ncredito['Cliente']['clnom']; ?>"><?php echo $ncredito['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($ncredito['Cliente']['clsuc']); ?>"><?php echo $ncredito['Cliente']['cltda']; ?></td>
				<td class="cveven" title="<?php echo $ncredito['Vendedor']['venom']; ?>"><?php echo $ncredito['Vendedor']['vecveven']; ?></td>
				<td class="refer" title="<?php echo $ncredito['Ncredito']['ncdevol']; ?>"><?php echo $ncredito['Ncredito']['ncdevol']; ?></td>
				<td class="total"><?php echo $this->Number->currency($ncredito['Ncredito']['ncredito__nctotal']); ?></td> 
				<td class="st" title="Fecha de Cancelación: <?php echo $ncredito['Ncredito']['cancelafecha']; ?>"><?php echo $ncredito['Ncredito']['ncst']; ?></td>
				<td class="" title="<?php echo 'Fecha Timbrado: '.$ncredito['Ncredito']['crefec'].'.'; ?>"><?php echo $ncredito['Ncredito']['uuid']; ?></td>
				<td class="id" title="<?php echo 'Creado: '.$ncredito['Ncredito']['crefec'].'. Modificado: '.$ncredito['Ncredito']['modfec'].'.'; ?>"><?php echo $ncredito['Ncredito']['id']; ?></td>
				<td class="action">

				<div class="btn-group">
<?php if(substr($ncredito['Ncredito']['ncrefer'],0,1)=='N'):?>
				<button type="button" class="btn btn-primary btn-small <?php if(!empty($ncredito['Ncredito']['fechatimbrado'])) echo "disabled";?>" onclick="<?php if(empty($ncredito['Ncredito']['fechatimbrado'])) echo "generaCFDI(".$ncredito['Ncredito']['id'].")";?>" title="Generar el XML. Timbrarlo con el PAC. Y enviar XML y PDF al Cliente.">
					<i class="icon icon-white icon-qrcode"></i>Timbra
				</button>
<?php endif;?>
<?php if(substr($ncredito['Ncredito']['ncrefer'],0,1)=='N'):?>
				<button type="button" class="btn btn-danger btn-small <?php if(!empty($ncredito['Ncredito']['cancelafecha']) || $ncredito['Ncredito']['ncst']<>'C' ) echo "disabled";?>" onclick="<?php if(empty($ncredito['Ncredito']['cancelafecha']) && $ncredito['Ncredito']['ncst']=='C') echo "cancelaCFDI(".$ncredito['Ncredito']['id'].")";?>" 
					title="Timbrar la Cancelación de esta Nota de credito con el PAC.">
					<i class="icon icon-white icon-qrcode"></i>Cancela
				</button>
<?php endif;?>
				</div>
				<div class="btn-group pull-right">
				<button type="button" class="btn btn-warning btn-small <?php if(empty($ncredito['Ncredito']['uuid'])) echo "disabled";?>" onclick="verXML(<?php echo $ncredito['Ncredito']['id'];?>);" title="Descargar el archivo XML.">
					<i class="icon icon-white icon-envelope"></i>XML
				</button>
				<button type="button" class="btn btn-danger btn-small <?php if(empty($ncredito['Ncredito']['uuid'])) echo "disabled";?>" onclick="verPDF(<?php echo $ncredito['Ncredito']['id'];?>);"  title="Ver el archivo PDF">
					<i class="icon icon-white icon-envelope"></i>PDF
				</button>
				<button type="button" class="btn btn-info btn-small <?php if(empty($ncredito['Ncredito']['uuid'])) echo "disabled";?>" onclick="shareCFDI(<?php echo $ncredito['Ncredito']['id'];?>);" title="Enviar archivos XML y PDF por Email al Cliente.">
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

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Ncredito','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<script>

var generaCFDI = function(id) {
	window.open('/NcreditoElectronica/generacfdi/'+id);
}

var downloadXML = function(id) {
	location.replace('/NcreditoElectronica/download/'+id+'/xml');
}

var downloadPDF = function(id) {
	location.replace('/NcreditoElectronica/download/'+id+'/pdf');
}

var shareCFDI = function(id) {
	window.open('/NcreditoElectronica/enviacorreo/'+id);
}

var cancelaCFDI = function(id) {
	window.open('/NcreditoElectronica/cancelacfdi/'+id);
}

var downloadCancelaCFDI = function(id) {
	window.open('/NcreditoElectronica/downloadcancela/'+id+'/xml');
}

var verPDF = function(id) {
	window.open('/NcreditoElectronica/ver/'+id+'/pdf');
}

var verXML = function(id) {
	window.open('/NcreditoElectronica/ver/'+id+'/xml');
}


</script>
<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>