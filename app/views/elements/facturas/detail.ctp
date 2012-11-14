<div id="gridWrapper">
<table id="datagrid" class="table table-bordered table-striped table-condensed">
	<thead>
	<tr id="trLabels">
		<th class="facturadet cveart">Producto</th>
		<th class="facturadet descrip">Descripción</th>
		<th class="facturadet cant">Cant</th>
		<th class="facturadet precio">Precio</th>
		<th class="facturadet importe">Importe</th>
	</tr>
	</thead>
	<tbody>
<?php foreach($details as $detail) {

	?>
	<tr id="<?php echo $detail[0]['articulo_id'];?>" class="renglon">
		<td class="facturadet cveart"><?php echo $detail[0]['cveart'];?></td>
		<td class="facturadet descrip"><?php echo $detail[0]['descrip'];?></td>
		<td class="facturadet cant"><?php echo round($detail[0]['cant'],0);?></td>
		<td class="facturadet precio" ><?php echo $this->Number->currency($detail[0]['precio']);?></td>
		<td class="facturadet total"><?php echo $this->Number->currency($detail[0]['importe']);?></td>
	</tr>

<?php }?>
	</tbody>
</table>
</div>

<div id="dialogForm">
</div>

<script>
$( "#dialogForm" ).dialog({
			autoOpen: false,
			height: 320,
			width: 780,
			top: 100,
			modal: true,
			resizable: false,
			hide: 'fade',
			show: 'fade',
			autoOpen: false,
			buttons: {
				Cancelar: function() {
					$( this ).dialog( "close");
				},
				Cerrar: function() {
					$( this ).dialog( "close");
				}
			},
			open: function() {
				$( "#dialogForm").load('/articulos/tallacolor/'+$( "#dialogForm" ).html()+'/control:facturas/action:tallacolordata/master_id:'+$( "#FacturaId" ).val()+'/child_id:'+$( "#dialogForm" ).html());
			},
			close: function() {
				$("#dialogForm").html('');
			}
		});
</script>
<?php
$this->Js->get('.renglon')->event(
'click',
'$( "#dialogForm" ).html(this.id); $( "#dialogForm" ).dialog( "open" );'
, array('stop' => true));

?>