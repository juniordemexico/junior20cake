<?php echo $this->Form->create('Pais', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row-fluid">
	<?php echo $this->TBS->input('papais', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('divisa_id', array('label' => 'Divisa')); ?>

</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>