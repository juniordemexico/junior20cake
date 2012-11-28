<?php echo $this->Form->create('Proveedor'); ?>
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
		<li><a href="#tabs-5" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">
<?php echo $this->Form->input('Proveedor.prcvepro', array('type' => 'text', 'maxlenght' => '4', 'label' => 'Clave')); ?>
<?php echo $this->Form->input('Proveedor.prnom', array('maxlenght' => '64', 'label' => 'Nombre o Razón Social')); ?>
<?php echo $this->Form->input('Proveedor.pratn', array('type' => 'text', 'maxlenght' => '32', 'label' => 'At\'n')); ?>
<?php echo $this->Form->input('Proveedor.prrfc', array('type' => 'text', 'maxlenght' => '16', 'label' => 'RFC')); ?>
<?php echo $this->Form->input('Proveedor.prcurp ', array('type' => 'text', 'maxlenght' => '20', 'label' => 'CURP')); ?>
</div>
<div id="tabs-1" class="tab-pane">
<?php echo $this->Form->input('pais_id', array('label' => 'País')); ?>
<?php echo $this->Form->input('estado_id', array('label' => 'Estado')); ?>
<?php echo $this->Form->input('Proveedor.prdir', array('type' => 'textarea', 'maxlenght' => '64', 'label' => 'Dirección')); ?>
<?php echo $this->Form->input('Proveedor.prcp', array('type' => 'text', 'maxlenght' => '5', 'label' => 'Código Postal')); ?>
</div>
<div id="tabs-2" class="tab-pane">
<?php echo $this->Form->input('divisa_id', array('label' => 'Divisa')); ?>
<?php echo $this->Form->input('Proveedor.prdesc1', array('label' => 'Descuento 1', 'maxlenght' => '5')); ?>
<?php echo $this->Form->input('Proveedor.prdesc2', array('label' => 'Descuento 2', 'maxlenght' => '5')); ?>
<?php echo $this->Form->input('Proveedor.prdesc3', array('label' => 'Descuento 3', 'maxlenght' => '5')); ?>
<?php echo $this->Form->input('Proveedor.prplazo', array('label' => 'Plazo', 'maxlenght' => '3')); ?>
<?php echo $this->Form->input('Proveedor.prnomvtas', array('maxlenght' => '64', 'label' => 'Atención Ventas')); ?>
<?php echo $this->Form->input('Proveedor.prnomcob', array('maxlenght' => '64', 'label' => 'Atención Cobranza')); ?>
<?php echo $this->Form->input('Proveedor.prnomserv', array('maxlenght' => '64', 'label' => 'Atención Servicio')); ?>
</div>
<div id="tabs-3" class="tab-pane">
<?php echo $this->Form->input('Proveedor.prbancocve', array('label' => 'Su Banco')); ?>
<?php echo $this->Form->input('Proveedor.prbancocta', array('label' => 'Su Número de Cuenta')); ?>
</div>
<div id="tabs-4" class="tab-pane">
<?php echo $this->Form->radio('Proveedor.prst',
							array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'),
								array('label'=>'false','legend'=>'Estatus'));
?>
<?php echo $this->Form->input('Proveedor.prt', array('label' => 'TTipo', 'type' => 'checkbox')); ?>
<?php echo $this->Form->input('Proveedor.probser', array('type'=>'textarea','maxlenght' => '128', 'label' => 'Observaciones')); ?>
</div>

<?php if ($mode == 'edit') {?>
<div id="tabs-5" class="tab-pane">
<div class="label readonly">
	<label class="readonly"><?php __("id"); ?></label>
	<em><?php echo $this->data['Proveedor']['id']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("created"); ?></label>
	<em><?php echo $this->data['Proveedor']['created']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("modified"); ?></label>
	<em><?php echo $this->data['Proveedor']['modified']; ?>&nbsp;</em>
</div>

</div>
<?php } ?>
</div>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));

echo $this->Form->end(); 
?>

<?php
?>
