<div class="span12 index-form">
<?php

$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
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
				<th class="total"><?php echo $form->text('fatotal',array('label' => '', 'type' => 'search', 'maxLength' => '14', 'placeholder' => 'Total'));?></th>
				<th class="st"><?php echo $form->text('fast',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST'));?></th>
				<th class="uuid"><?php echo $form->text('UUID',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'UUID'));?></th>
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
				<th class="total"><?php echo $this->Paginator->sort('Total','fatotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','fast'); ?></th>
				<th class="uuid"><?php //echo $this->Paginator->sort('UUID','uuid'); ?></th>
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
//			$class = ($i++ % 2 == 0) ?
//					' class="renglon altrow"' :
//					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" class="renglon">
				<td class="refer"><?php echo $factura['Factura']['farefer']; ?></td>
				<td class="date" title="Pedido: <?php echo $factura['Factura']['fapedido']; ?>"><?php echo substr($factura['Factura']['fafecha'],0,10); ?></td>
				<td class="cvecli"><?php echo $factura['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($factura['Cliente']['clsuc']); ?>"><?php echo $factura['Cliente']['cltda']; ?></td>
				<td class="total"><?php echo $this->Number->currency($factura['Factura']['factura__fatotal']); ?></td>
				<td class="st"><?php echo $factura['Factura']['fast']; ?></td>
				<td class="uuid" title="<?php echo 'Timbrado: '.$factura['Factura']['crefec'].'.'; ?>"><?php echo 'E4563-2134-23233-23233';//$factura['Factura']['uuid']; ?></td>
				<td class="id" title="<?php echo 'Creado: '.$factura['Factura']['crefec'].'. Modificado: '.$factura['Factura']['modfec'].'.'; ?>"><?php echo $factura['Factura']['id']; ?></td>
				<td class="action">
					
					<?php /*echo $this->Html->Image('icons/documents/xml-blue.png',array(
												'url'=>array(
													'controller'=>'FacturaElectronica',
													'action'=>'generacfi',
													$factura['Factura']['id'],
													'target'=>'_blank'
												),
												'alt'=>'Timbrar',
												'class'=>'tableactionicon',
												'title'=>'Generar el XML CFDI v3.2 -> Timbrarlo con el PAC -> Enviar XML y PDF al cliente.',
											)
											);
						*/
					?>
					<?php /* echo $this->Html->Image('icons/documents/pdf-blue.png',array(
												'url'=>array(
													'controller'=>'FacturaElectronica',
													'action'=>'download',
													$factura['Factura']['id'],
													'pdf',
												),
											'alt'=>'PDF',
											'class'=>'tableactionicon',
											'title'=>'Descarga el archivo XML del CFDI'
											)
											);
					*/
					?>
					<?php echo $this->Html->Image('icons/documents/xml-blue.png',array(
												'url'=>array(
													'controller'=>'FacturaElectronica',
													'action'=>'download',
													$factura['Factura']['id'],
													'xml'
												),
											'alt'=>'XML',
											'class'=>'tableactionicon',
											)
											);
					
					?>
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

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>

<script language="javascript">
/*
	var timbraXML = function(id) {
		alert('si entre a la func');
		window.open( '/FacturaElectronica/generacfdi/'+id, '_blank');
	}

	var downloadXML = function(id) {
		window.open( '/FacturaElectronica/download/'+id+'/xml');
	}

	var downloadPDF = function(id) {
		window.open( '/FacturaElectronica/download/'+id+'/pdf');
	}

	var shareCFDI = function(id) {
		window.open( '/FacturaElectronica/sharecfdi.json/'+id,	'_blank');
	}
	
	alert('nincial');
*/
/*
						<input class="btn btn-small btn-primary" type="button" onclick="alert(<?php echo $factura['Factura']['id'];?>);">
							<i class="icon icon-qrcode icon-white"></i>Timbra
						</input>
						<input class="btn btn-small btn-warning" type="button" onclick="descargaXML(<?php echo $factura['Factura']['id'];?>);">
							<i class="icon icon-page icon-white"></i>XML
						</input>
						<input class="btn btn-small btn-danger" type="button" onclick="descargaPDF(<?php echo $factura['Factura']['id'];?>);">
							<i class="icon icon-page icon-white"></i>PDF
						</button>
						<input class="btn btn-small btn-info" type="button" onclick="shareCFDI(<?php echo $factura['Factura']['id'];?>);">
							<i class="icon icon-envelope icon-white"></i>Mail
						</input>

*/
</script>
