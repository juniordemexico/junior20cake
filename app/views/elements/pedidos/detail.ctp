<div id="gridWrapper">
<table id="datagrid" class="table table-bordered table-striped table-condensed">
	<thead>
<?php if ($mode == 'add'):?>
	<tr>
		<th class="cveart"><?php echo $this->Form->input('cveart', array('type'=>'text', 'ly_w'=>'3', 'append'=>'?', 'class'=>'span3') )?></th>
		<th class="descrip"><?php echo $this->Form->input('descrip', array('type'=>'text', 'ly_w'=>'4', 'class'=>'span4') )?></th>
		<th class="cant"><?php echo $this->Form->input('precio', array('type'=>'text','ly_w'=>'1', 'class'=>'span1') )?></th>
		<th class="precio"><?php echo $this->Form->input('cant', array('type'=>'text', 'class'=>'span1') )?></th>
		<th class="importe"><?php echo $this->Form->input('importe', array('type'=>'text', 'ly_w'=>'2', 'class'=>'span2') )?></th>
		<th class="listButton"><button type="button" id="btnAddDetail" name="btnAddDetails" class="btn btn-inverse btn-small"><i class="icon icon-white icon-plus-sign"></button></th>
	</tr>
<?php endif; ?>
	<tr id="trLabels">
		<th class="cveart">Producto</th>
		<th class="descrip">Descripción</th>
		<th class="cant">Cant</th>
		<th class="precio">Precio</th>
		<th class="importe">Importe</th>
<?php if ($mode == 'add'):?>
		<th class="listButton">&nbsp;</th>
<?php endif; ?>
	</tr>
	</thead>
	<tbody>
<?php foreach($details as $detail) {

	?>
	<tr id="<?php echo $detail[0]['articulo_id'];?>" class="renglon">
		<td class="cveart"><?php echo $detail[0]['cveart'];?></td>
		<td class="descrip"><?php echo $detail[0]['descrip'];?></td>
		<td class="cant"><?php echo round($detail[0]['cant'],0);?></td>
		<td class="precio" ><?php echo $this->Number->currency($detail[0]['precio']);?></td>
		<td class="total"><?php echo $this->Number->currency($detail[0]['importe']);?></td>
<?php if ($mode == 'add'):?>
		<td class="listButton"><button id="btnAddDetail" name="btnAddDetail" class="btn btn-small"><i class="icon icon-minus-sign"></button></td>
<?php endif; ?>
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
   			position: ["center","center"], 
			zIndex: 999999,
			modal: true,
			stack: true,
			hide: 'fade',
			show: 'fade',
			autoOpen: false,
			buttons: {
				Guardar: function() {
					$( this ).dialog( "save");
				},
				Cerrar: function() {
					$( this ).dialog( "close");
				}
			},
			open: function() {
				$( "#dialogForm" ).load('/articulos/tallacolor/'+$( "#dialogForm" ).html()+'/control:pedidos/action:tallacolordata/master_id:'+$( "#PedidoId" ).val()+'/child_id:'+$( "#dialogForm" ).html());
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

<?php
// Set the Click Event from the Add Detail Button
if ($mode == 'add') {
$this->Js->get('#btnAddDetail')->event(
'click', '
alert("jajaja");
', array('stop' => true));
}
?>