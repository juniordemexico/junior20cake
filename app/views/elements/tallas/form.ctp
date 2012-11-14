<?php echo $this->Form->create('Talla', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row-fluid">
	<?php echo $this->TBS->input('tacve', array('type' => 'text', 'label' => 'Clave', 'ly_w'=>'2')); ?>
	<?php echo $this->TBS->input('tadescrip', array('type' => 'text', 'label' => 'Descripcion', 'ly_w'=>'4')); ?>
	<?php echo $this->TBS->input('Talla.st', array('type'=>'radiogroup', 'label'=>'Estatus', 
								'selectOptions'=>array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
								);
	?>
	<?php echo $this->TBS->input('tat0', array('type' => 'text', 'label' => 'Talla 0', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat1', array('type' => 'text', 'label' => 'Talla 1', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat2', array('type' => 'text', 'label' => 'Talla 2', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat3', array('type' => 'text', 'label' => 'Talla 3', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat4', array('type' => 'text', 'label' => 'Talla 4', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat5', array('type' => 'text', 'label' => 'Talla 5', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat6', array('type' => 'text', 'label' => 'Talla 6', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat7', array('type' => 'text', 'label' => 'Talla 7', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat8', array('type' => 'text', 'label' => 'Talla 8', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('tat9', array('type' => 'text', 'label' => 'Talla 9', 'ly_w'=>'1')); ?>

</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'ui-button-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>