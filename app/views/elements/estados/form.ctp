<?php echo $this->Form->create('Estado', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row-fluid">
	<?php echo $this->TBS->input('esedo', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('pais_id', array('label' => 'Pais')); ?>

</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'ui-button-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>