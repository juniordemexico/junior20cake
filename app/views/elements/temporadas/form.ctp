<?php echo $this->Form->create('Temporada', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row-fluid">
	<?php echo $this->TBS->input('tecve', array('type' => 'text', 'label' => 'Clave')); ?>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'type'=>'button', 'update' => '#content'));
echo $this->Form->end(); 
?>