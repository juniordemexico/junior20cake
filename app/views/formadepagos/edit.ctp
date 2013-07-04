<header>
<div class="page-header">
<h1><small>Forma de Pago <strong class="text-info"><?php echo $this->data['Formadepago']['cve']?></strong></small></h1>
</div>
</header>

<div class="row">
<?php echo $this->Form->create('Formadepago', array('class'=>'form-horizontal')); ?>
<?php if ($this->action == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>

<div class="span12">
	<?php echo $this->TBS->input('cve', array('type' => 'text', 'label' => 'Clave')); ?>
	<?php echo $this->TBS->input('descrip', array('type' => 'text', 'label' => 'Descripción')); ?>
	<?php echo $this->TBS->input('visible', array('type'=>'checkbox', 'label'=>'Visible')); ?>
	<?php echo $this->TBS->input('st', array('type'=>'radiogroup', 'label'=>'Estatus', 
							'selectOptions'=>array('A'=>'Activo', 'C'=>'Cancelado', 'S'=>'Suspendido'),
							'title'=>'Elige el Estatus: Activo, Baja (descontinuado, eliminado), Suspendido (bloqueado temporalmente)'
							));
	?>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>
</div> <!-- row -->

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
