<?php echo $this->Form->create('Proveedor', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>
<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Generales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Direcciones</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Comerciales</a></li>
		<li><a href="#tabs-3" data-toggle="tab">Bancarios</a></li>
		<li><a href="#tabs-4" data-toggle="tab">Varios</a></li>
		<?php if ($mode == 'edit') {?>
		<li><a href="#tabs-10" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">
<?php echo $this->TBS->input('Proveedor.prcvepro', array('type' => 'text', 'label' => 'Clave', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Proveedor.prnom', array('label' => 'Nombre o Razón Social', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Proveedor.pratn', array('type' => 'text', 'label' => 'At\'n', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Proveedor.prrfc', array('type' => 'text', 'label' => 'RFC', 'ly_w'=>'3')); ?>
<?php
	echo $this->TBS->input('Proveedor.prst', array('label'=>'Estatus', 'type' => 'radiogroup',
											'selectOptions'=> array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
							);
?>
<?php //echo $this->TBS->input('Proveedor.prcurp ', array('type' => 'text', 'label' => 'CURP', 'ly_w'=>'3')); ?>
</div>
<div id="tabs-1" class="tab-pane">
<?php echo $this->TBS->input('Proveedor.pais_id', array('label' => 'País', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Proveedor.estado_id', array('label' => 'Estado', 'ly_w'=>'3')); ?>
<?php echo $this->TBS->input('Proveedor.prdir', array('type' => 'textarea', 'label' => 'Dirección', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Proveedor.prcp', array('type' => 'text', 'label' => 'Código Postal', 'placeholder'=>'C.P.', 'ly_w'=>'1')); ?>
</div>
<div id="tabs-2" class="tab-pane">
<?php echo $this->TBS->input('Proveedor.divisa_id', array('label' => 'Divisa', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Proveedor.prdesc1', array('label' => 'Descuento 1', 'append'=>'%', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Proveedor.prdesc2', array('label' => 'Descuento 2', 'append'=>'%', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Proveedor.prdesc3', array('label' => 'Descuento 3', 'append'=>'%', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Proveedor.prplazo', array('label' => 'Plazo', 'append'=>'Días', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Proveedor.prnomventas', array('label' => 'Atención Ventas', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Proveedor.prnomcob', array('label' => 'Atención Cobranza', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Proveedor.prnomserv', array('label' => 'Atención Servicio', 'ly_w'=>'4')); ?>
</div>
<div id="tabs-3" class="tab-pane">
<?php //echo $this->TBS->input('Proveedor.prbancocve', array('type'=>'text', 'label' => 'Su Banco', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->text('Banco: Numero de Cuenta, Numero CLABE <enter>'); ?>
<?php echo $this->TBS->input('Proveedor.prbancocta', array('type'=>'textarea', 'label' => 'Cuentas Bancarias', 'placeholder'=>'Banco: Numero de Cuenta, Numero CLABE <enter>','ly_w'=>'4')); ?>
</div>
<div id="tabs-4" class="tab-pane">
<?php echo $this->TBS->input('Proveedor.probser', array('type'=>'textarea', 'label' => 'Observaciones', 'ly_w'=>'4')); ?>
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
