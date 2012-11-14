<?php echo $this->Form->create('Color', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>

<div class="row-fluid">
	<div class="span6">
	<?php echo $this->TBS->input('Color.cve', array('type' => 'text', 'label' => 'Color')); ?>
	<?php echo $this->TBS->input('Color.st', array('type'=>'radiogroup', 'label'=>'Estatus', 
								'selectOptions'=>array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
								);
	?>
	<?php echo $this->TBS->input('tipoarticulo_id_0', array('type'=>'checkbox', 'label'=>'Producto')); ?>
	<?php echo $this->TBS->input('tipoarticulo_id_1', array('type'=>'checkbox', 'label'=>'Material')); ?>
	<?php echo $this->TBS->input('tipoarticulo_id_2', array('type'=>'checkbox', 'label'=>'Servicio')); ?>
	<?php echo $this->TBS->input('tipoarticulo_id_3', array('type'=>'checkbox', 'label'=>'Otros')); ?>
	<?php echo $this->TBS->input('tipoarticulo_id_4', array('type'=>'checkbox', 'label'=>'Activo')); ?>
	</div>
	<div class="span6" id="related-records-container">
		<span class="label">Articulos Relacionados</span>
		<div class="related-records">
			<?php if (isset($this->data['Articulo']) && sizeof($this->data['Articulo'])>0): ?>
			<ul>
			<?php 
			$lastTipoarticulo=-1;
		 	foreach($this->data['Articulo'] as $key=>$item) {
				if($item['tipoarticulo_id']<>$lastTipoarticulo) {
					if($lastTipoarticulo<>-1) echo "</ul>"."<ul>";
					$lastTipoarticulo=$item['tipoarticulo_id'];
				}
				echo "<li>"."<a href=\"/Articulos/edit/".$item['id']."\" target=\"_blank\">".trim($item['arcveart'])."</a>"."</li>\n";
			}
			?>
			</ul>
			<?php endif; ?>
		</div>
	</div>

</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'ui-button-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>