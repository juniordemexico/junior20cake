<?php echo $this->Form->create('Vendedor', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>
<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Generales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Direccion</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Comerciales</a></li>
		<?php if ($mode == 'edit') {?>
		<li><a href="#tabs-10" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">
<?php echo $this->TBS->input('Vendedor.vecveven', array('type' => 'text', 'label' => 'Clave', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Vendedor.venom', array('label' => 'Nombre o Razón Social', 'ly_w'=>'4')); ?>
<?php
	echo $this->TBS->input('Vendedor.vest', array('label'=>'Estatus', 'type' => 'radiogroup',
											'selectOptions'=> array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
							);
?>
</div>
<div id="tabs-1" class="tab-pane">
<?php echo $this->TBS->input('Vendedor.pais_id', array('label' => 'País', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Vendedor.estado_id', array('label' => 'Estado', 'ly_w'=>'3')); ?>
<?php echo $this->TBS->input('Vendedor.vedir', array('type' => 'textarea', 'label' => 'Dirección', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Vendedor.vecp', array('type' => 'text', 'label' => 'Código Postal', 'placeholder'=>'C.P.', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Vendedor.vetel', array('type' => 'text', 'label' => 'Telefonos', 'placeholder'=>'Telefono, telefono ...', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Vendedor.veemail', array('type' => 'text', 'label' => 'EMail', 'placeholder'=>'usuario@servidor.com', 'ly_w'=>'4')); ?>
</div>
<div id="tabs-2" class="tab-pane">
<?php echo $this->TBS->input('Vendedor.verfc', array('type' => 'text', 'label' => 'RFC', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Vendedor.vecomis', array('type'=>'text', 'label' => 'Comision', 'format'=>'numeric', 'append'=>'%', 'ly_w'=>'1')); ?>
<?php //echo $this->TBS->label('Banco: Numero de Cuenta, Numero CLABE <enter>'); ?>
<?php echo $this->TBS->input('Vendedor.vebancocta', array('type'=>'textarea', 'label' => 'Cuentas Bancarias', 'placeholder'=>'Banco: Numero de Cuenta, Numero CLABE <enter>','ly_w'=>'4')); ?>
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
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'type'=>'button', 'update' => '#content'));

echo $this->Form->end(); 
?>
