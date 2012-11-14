<cake:nocache>
<?php echo $session->flash();?>
</cake:nocache>	
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
								'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)) ));
?>
<div class="articulo index">

<div id="gridWrapper">
<?php 
echo $form->create('Articulo');
?>

	<table id="datagrid" cellspacing="0">
		<thead>
			<tr id="trFilter">
				<th class="articulo cveart"><?php echo $form->text('arcveart', array('label' => '', 'type' => 'search', 'maxLength' => '16', ));?></th>
				<th class="articulo descrip"><?php echo $form->text('ardescrip',array('label' => '', 'type' => 'search', 'maxLength' => '64'));?></th>
				<th class="articulo licve"><?php echo $form->text('Linea.licve',array('label' => '', 'type' => 'search', 'maxLength' => '4'));?></th>
				<th class="articulo macve"><?php echo $form->text('Marca.macve',array('label' => '', 'type' => 'search', 'maxLength' => '16'));?></th>
				<th class="articulo tecve"><?php echo $form->text('Temporada.tecve',array('label' => '', 'type' => 'search', 'maxLength' => '16'));?></th>
				<th class="articulo artipo"><?php echo $form->text('artipo',array('label' => '', 'type' => 'search', 'maxLength' => '1'));?></th>
				<th class="articulo st"><?php echo $form->text('arst',array('label' => '', 'type' => 'search', 'maxLength' => '1'));?></th>
				<th class="articulo id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content',
														'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
														'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false)) 
									));
				?>
				</th>	
			</tr>
			<tr id="trLabels">
				<th class="articulo cveart"><?php echo $this->Paginator->sort('Clave','arcveart'); ?></th>
				<th class="articulo descrip"><?php echo $this->Paginator->sort('Descripción','ardescrip'); ?></th>
				<th class="articulo licve"><?php echo $this->Paginator->sort('Linea','Linea.licve'); ?></th>
				<th class="articulo macve"><?php echo $this->Paginator->sort('Marca','Marca.macve'); ?></th>
				<th class="articulo tecve"><?php echo $this->Paginator->sort('Temporada','Temporada.tecve'); ?></th>
				<th class="articulo artipo"><?php echo $this->Paginator->sort('Tipo','artipo'); ?></th>
				<th class="articulo st"><?php echo $this->Paginator->sort('ST','arst'); ?></th>
				<th class="articulo id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($articulos as $articulo):
			$class = null;
			$thisID=trim($articulo['Articulo']['id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="articulo cveart"><?php echo $articulo['Articulo']['arcveart']; ?></td>
				<td class="articulo descrip"><?php echo $articulo['Articulo']['ardescrip']; ?></td>
				<td class="articulo licve"><?php echo $articulo['Linea']['licve']; ?></td>
				<td class="articulo macve"><?php echo $articulo['Marca']['macve']; ?></td>
				<td class="articulo tecve"><?php echo $articulo['Temporada']['tecve']; ?></td>
				<td class="articulo artipo"><?php echo $articulo['Articulo']['artipo']; ?></td>
				<td class="articulo st"><?php echo $articulo['Articulo']['arst']; ?></td>
				<td class="articulo id"><?php echo $articulo['Articulo']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
<div class="counter">
</div>


</div>
<div id="dialogForm">
jojkojoj
</div>
<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Articulo','MyRowClickAction' => 'edit')); ?>

<script>
$( "#dialogForm" ).dialog({
			autoOpen: false,
			height: 450,
			width: 780,
			top: 100,
			modal: true,
			resizable: false,
			hide: 'fade',
			show: 'fade',
			buttons: {
				Cancelar: function() {
					$( this ).dialog( "close");
				},
				Cerrar: function() {
					$( this ).dialog( "close");
				}
			},
			open: function() {
				$( "#dialogForm" ).load('/articulos/tallacolor/'+$( "#dialogForm" ).html());
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