<?php echo $this->Form->create('Barcodes', array('class'=>'form-horizontal')); ?>
<?php echo $this->Form->hidden('id'); ?>

<div class="row-fluid">
	<?php echo $this->TBS->input('Articulo.arcveart', array('type' => 'text', 'label' => 'Producto')); ?>
	<?php echo $this->TBS->input('Articulo.ardescrip', array('type' => 'text', 'label' => 'Descripción')); ?>
	<?php echo $this->TBS->input('barcodeserie_id', array('label' => 'Serie de Codigos')); ?>
	<div>
<?php print_r($barcodes);?>
	<table cellspacing="0" cellpading="0">
		<tr>
			<th>Color</th>
			<th>Grupo Tallas</th>
			<th>Talla</th>
			<th>Codigo</th>
		</tr>
	<?php //print_r($barcodes); ?>
	<?php foreach($barcodes as $item):?>
		<tr id="<?php echo $item['barcode_id'];?>">
			<td><?php echo $item['color_cve'];?></td>
			<td><?php echo $item['tallas_cve'];?></td>
			<td id="<?php echo $item['talla_index'];?>"><?php echo $item['talla_label'];?></td>
			<td><?php echo $this->TBS->input('Barcode.barcode', array('type' => 'text', 'label' => 'Codigo', 'ly_w'=>'2')); ?></td>
		</tr>	
	<?php endforeach;?>
	</table>
	</div>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'ui-button-primary', 'update' => '#content'));

echo $this->Form->end(); 
?>
