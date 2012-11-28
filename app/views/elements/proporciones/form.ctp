<?php echo $this->Form->create('Proporcion', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row-fluid">
	<?php echo $this->TBS->input('cve', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('Proporcion.st', array('type'=>'radiogroup', 'label'=>'Estatus', 
								'selectOptions'=>array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
								);
	?>
	<?php echo $this->TBS->input('t0', array('type' => 'text', 'label' => 'Talla 0', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t1', array('type' => 'text', 'label' => 'Talla 1', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t2', array('type' => 'text', 'label' => 'Talla 2', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t3', array('type' => 'text', 'label' => 'Talla 3', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t4', array('type' => 'text', 'label' => 'Talla 4', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t5', array('type' => 'text', 'label' => 'Talla 5', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t6', array('type' => 'text', 'label' => 'Talla 6', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t7', array('type' => 'text', 'label' => 'Talla 7', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t8', array('type' => 'text', 'label' => 'Talla 8', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('t9', array('type' => 'text', 'label' => 'Talla 9', 'ly_w'=>'1')); ?>

</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>