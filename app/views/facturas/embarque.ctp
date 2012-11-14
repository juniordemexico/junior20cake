<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div id="gridWrapper">
<?php 
echo $this->Form->create('Factura',array('model'=>'Factura', 'inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid" class="table table-bordered table-striped table-condensed" cellspacing="0">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('Factura.farefer', array('label' => '', 'type' => 'search',  'placeholder' => 'Folio', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Factura.fafecha',array('label' => '', 'type' => 'search', 'placeholder' => 'Fecha', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'placeholder' => 'Cliente', 'class' => 'search-query'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'placeholder' => 'Tda', 'class' => 'search-query'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven',array('label' => '', 'type' => 'search', 'placeholder' => 'Vend', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('Factura.fatotal',array('label' => '', 'type' => 'search', 'placeholder' => 'Total', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Factura.fast',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Factura.fafembarque',array('label' => '', 'type' => 'search', 'placeholder' => 'Embarque', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Factura.fafentrega',array('label' => '', 'type' => 'search', 'placeholder' => 'Entrega', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','farefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','fafecha'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','fatotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','fast'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Embarque','fafembarque'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Entrega','fafentrega'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
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
			<tr id="<?php echo $thisID?>" folio="<?php echo $factura['Factura']['farefer'];?>" <?php echo $class;?>>
				<td class="refer farefer"><?php echo $factura['Factura']['farefer']; ?></td>
				<td class="date"><?php echo substr($factura['Factura']['fafecha'],0,10); ?></td>
				<td class=""><?php echo $factura['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($factura['Cliente']['clsuc']); ?>"><?php echo $factura['Cliente']['cltda']; ?></td>
				<td class="cveven" title="<?php echo $factura['Vendedor']['venom']; ?>"><?php echo $factura['Vendedor']['vecveven']; ?></td>
				<td class="total"><?php echo $this->Number->currency($factura['Factura']['factura__fatotal']); ?></td>
				<td class="st"><?php echo $factura['Factura']['fast']; ?></td>
				<td class="date fafembarque" id="tde_<?php echo $factura['Factura']['id'];?>">
									<?php if (isset($factura['Factura']['fafembarque']) &&
				 							!empty($factura['Factura']['fafembarque'])) {
											echo substr($factura['Factura']['fafembarque'],0,10);
										}
										else {
											echo '<button class="fafembarque btn btn-mini"><i class="icon-share-alt"></i></button>';
										}
									?>
				</td>
				<td class="date fafentrega" id="tdg_<?php echo $factura['Factura']['id'];?>">
									<?php if (isset($factura['Factura']['fafentrega']) &&
				 							!empty($factura['Factura']['fafentrega'])) {
											echo substr($factura['Factura']['fafentrega'],0,10);
										}
									?>
				</td>
				<td class="id" title="<?php echo 'Creado: '.$factura['Factura']['crefec'].'. Modificado: '.$factura['Factura']['modfec'].'.'; ?>"><?php echo $factura['Factura']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php echo $this->Form->end(); ?>
</div>
</div>

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Factura','MyRowClickAction' => 'edit')); ?>

<div id="dialogFacturaEmbarque">
<form id="FacturaEmbarque" action="/Facturas/registraembarque" method="POST" onsubmit="return false;">
<div id="dialogMessagesEmbarque"></div>
<?php echo $this->Form->hidden('FacturaEmbarque.id'); ?>
<?php echo $this->Form->hidden('FacturaEmbarque.farefer'); ?>
<?php echo $this->TBS->input('FacturaEmbarque.fafembarque', array('type' => 'textdate', 'label' => 'Fecha Embarque', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('FacturaEmbarque.fatalonemb', array('type' => 'text', 'label' => 'Talon', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('FacturaEmbarque.facajas', array('type' => 'text', 'label' => 'Cajas', 'ly_w'=>'1')); ?>
</form>
</div>

</div> <!-- index-form -->

<?php
$this->Js->get('.fafembarque')->event(
'click',
'
$( "#FacturaEmbarqueId" ).val(this.parentElement.parentElement.id);
$( "#FacturaEmbarqueFarefer" ).val( $(this.parentElement.parentElement).attr("folio") );
$( "#dialogFacturaEmbarque" ).dialog( "open" );
'
, array('stop' => true));

?>

<script>
$( "#dialogFacturaEmbarque" ).dialog({
			autoOpen: false,
			height: 400,
			width: 320,
   			position: ["center","center"], 
			zIndex: 999999,
			modal: true,
			stack: true,
			hide: 'fade',
			show: 'fade',
			autoOpen: false,
			draggable: false,
			rezisable: false,
			title: 'Embarque Factura',
			buttons: [{
				text: 'Guardar',
				click: function() {
					$.ajax({
							dataType:"html", 
							type:"post", 
							data:$("#FacturaEmbarque").serialize(), 
							url:"\/Facturas\/registraembarque",
							success:function (data, textStatus) {
								$("#dialogMessagesEmbarque").html(data);
								if(data!="Error" && data!="") {
									$("#"+$( "#FacturaEmbarqueId" ).val()+" TD.fafembarque" ).html($( "#dialogMessagesEmbarque").html());
									$( "#FacturaEmbarqueFatalonemb" ).val('');
									$( "#FacturaEmbarqueFacajas" ).val('');
									$("#dialogFacturaEmbarque").dialog("close");
								}
							}, 
					});
					return false;	
				}
			}],
			open: function() {
				$("#"+this.id).dialog( "option", "title", 'Embarque Fac: '+$('#FacturaEmbarqueFarefer').val() );
			},
			close: function() {
				$( "#dialogMessagesEmbarque").html('');
				$( "#FacturaEmbarqueId" ).val('');
				$( "#FacturaEmbarqueFarefer" ).val('');
			}
		});
</script>
