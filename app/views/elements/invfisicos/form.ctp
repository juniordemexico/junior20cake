<?php echo $this->Form->create('Ubicacion', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit'): ?>
<?php	echo $this->Form->hidden('id'); ?>
<?php endif; ?>

<div class="row">
	<?php echo $this->TBS->input('cve', array('type' => 'text', 'label' => 'Titulo', 'ly_w'=>'4')); ?>
	<?php echo $this->TBS->input('almacen_id', array('label' => 'Almacén')); ?>
	<?php echo $this->TBS->input('fecha', array('type' => 'textdate', 'label' => 'Fecha', 'ly_w'=>'2')); ?>
	<?php echo $this->TBS->input('finicio', array('type' => 'textdate', 'label' => 'Inicio', 'ly_w'=>'2')); ?>
	<?php echo $this->TBS->input('ftermino', array('type' => 'textdate', 'label' => 'Termino', 'ly_w'=>'2')); ?>
	<?php echo $this->TBS->input('st', array('type'=>'radiogroup', 'label'=>'Estatus', 
								'selectOptions'=>array('A'=>'Activo', 'I'=>'Inicializado',
														'1'=>'Primer conteo', '2'=>'Segundo conteo',
														'C'=>'Cerrado', 'P'=>'Procesado'))
								);
	?>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
echo $this->Form->end(); 
?>