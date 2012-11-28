<?php echo $this->Form->create('Divisa', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>

<?php echo $this->Form->input('Divisa.dicve', array('type' => 'text', 'maxLength' => '3')); ?>
<?php echo $this->Form->input('Divisa.dinom', array('type' => 'text', 'maxLength' => '32')); ?>
<?php echo $this->Form->input('Divisa.ditcambio', array('type' => 'textarea', 'default' => '1.00', 'maxLength' => '7')); ?>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>