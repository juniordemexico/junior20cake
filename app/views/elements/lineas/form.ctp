<?php echo $this->Form->create('Linea', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>

<div class="row-fluid">
	<?php echo $this->TBS->input('licve', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('descrip', array('type' => 'text', 'label' => 'Descripción')); ?>
	<?php echo $this->TBS->input('tipoarticulo_id', array('label' => 'Tipo de Inventario')); ?>


</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'type'=>'button', 'update' => '#content'));
echo $this->Form->end(); 
?>