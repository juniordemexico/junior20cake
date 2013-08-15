<?php echo $this->Form->create('Transporte', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>
<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Generales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Direcciones</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Comerciales</a></li>
		<li><a href="#tabs-3" data-toggle="tab">Varios</a></li>
		<?php if ($mode == 'edit') {?>
		<li><a href="#tabs-10" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">
<?php echo $this->TBS->input('Transporte.trcve', array('type' => 'text', 'label' => 'Clave', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Transporte.trnom', array('label' => 'Nombre o Razón Social', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Transporte.tratn', array('type' => 'text', 'label' => 'At\'n', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Transporte.trrfc', array('type' => 'text', 'label' => 'RFC', 'ly_w'=>'3')); ?>
<?php
	echo $this->TBS->input('Transporte.trst', array('label'=>'Estatus', 'type' => 'radiogroup',
											'selectOptions'=> array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
							);
?>
<?php //echo $this->TBS->input('Transporte.trcurp ', array('type' => 'text', 'label' => 'CURP', 'ly_w'=>'3')); ?>
</div>
<div id="tabs-1" class="tab-pane">
<?php echo $this->TBS->input('Transporte.pais_id', array('label' => 'País', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Transporte.estado_id', array('label' => 'Estado', 'ly_w'=>'3')); ?>
<?php echo $this->TBS->input('Transporte.trdir', array('type' => 'textarea', 'label' => 'Dirección', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Transporte.trcp', array('type' => 'text', 'label' => 'Código Postal', 'placeholder'=>'C.P.', 'ly_w'=>'1')); ?>
</div>
<div id="tabs-2" class="tab-pane">
	Comerciales
</div>
<div id="tabs-3" class="tab-pane">
<?php echo $this->TBS->input('Transporte.obser', array('type'=>'textarea', 'label' => 'Observaciones', 'ly_w'=>'4')); ?>
</div>

<?php if ($mode == 'edit') {?>
<div id="tabs-10" class="tab-pane">
<?php echo $this->Element('ItemRecordData', array(
							'MyController'=>$this->name,
							'MyModel'=>$this->Form->params['models'][0],
							'mode'=>$mode,
							)); 
?>
</div>
<?php } ?>
</div>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));

echo $this->Form->end(); 
?>
