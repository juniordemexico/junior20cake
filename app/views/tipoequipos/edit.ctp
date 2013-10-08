<div class="span12 edit-form">

<?php echo $this->Form->create('Tipoequipo', array('class'=>'form-horizontal')); ?>
<?php if ($this->action == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row">
	<?php echo $this->TBS->input('Tipoequipo.cve', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('Tipoequipo.visible', array('type'=>'checkbox', 'label'=>'Visible', 'title'=>'Este tipo de Equipo es visible para los usuarios')); ?>
	<?php echo $this->TBS->input('Tipoequipo.st', array('type'=>'radiogroup', 'label'=>'Estatus', 
								'selectOptions'=>array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
								);
	?>

</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>

</div> <!-- span12 -->

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
