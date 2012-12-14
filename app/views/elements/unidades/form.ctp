<?php echo $this->Form->create('Unidad', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row">
	<?php echo $this->TBS->input('cve', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('nom', array('type' => 'text', 'label' => 'Nombre')); ?>

</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>