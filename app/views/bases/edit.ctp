<div class="span12 edit-form">

<?php echo $this->Form->create('Base', array('class'=>'form-horizontal')); ?>
<?php if ($this->action == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php  endif; ?>

<div class="row">
	<?php echo $this->TBS->input('cve', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('descrip', array('type' => 'text', 'label' => 'Descripción', 'ly_w'=>'4')); ?>
	<?php echo $this->TBS->input('Base.st', array('type'=>'radiogroup', 'label'=>'Estatus', 
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
