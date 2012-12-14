<?php echo $this->Form->create('Ubicacion', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php endif; ?>

<div class="row">
	<?php echo $this->TBS->input('almacen_id', array('label' => 'Almacén')); ?>
	<?php echo $this->TBS->input('zona', array('type' => 'text', 'label' => 'Zona', 'ly_w'=>'1', 'maxlength'=>1)); ?>
	<?php echo $this->TBS->input('fila', array('type' => 'text', 'label' => 'Fila', 'ly_w'=>'1', 'maxlength'=>2)); ?>
	<?php echo $this->TBS->input('espacio', array('type' => 'text', 'label' => 'Espacio', 'ly_w'=>'1', 'maxlength'=>4)); ?>
	<?php echo $this->TBS->input('descrip', array('type' => 'text', 'label' => 'Descripción', 'ly_w'=>'4', 'maxlength'=>32)); ?>
	<?php echo $this->TBS->input('cve', array('type' => 'text', 'label' => 'Codigo de la Zona', 'ly_w'=>'2')); ?>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>