<?php echo $this->Form->create('Articulo', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php 	echo $this->Form->hidden('Articulo.art', array( 'label' => null)); ?>
<?php }?>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Generales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Clasificacion</a></li>
		<li><a href="#tabs-3" data-toggle="tab">Costos</a></li>
		<li><a href="#tabs-4" data-toggle="tab">Caracteristicas</a></li>
		<?php if ($mode == 'edit') {?>
		<li><a href="#tabs-5" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>
<div class="tab-content">
<div id="tabs-0" class="tab-pane active">
<?php echo $this->TBS->input('Articulo.arcveart', array('type' => 'text', 'label' => 'Código', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Articulo.ardescrip', array('type' => 'text', 'label' => 'Descripción', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('arst', array('type'=>'radiogroup', 'label'=>'Estatus', 
							'selectOptions'=>array('A'=>'Activo', 'C'=>'Cancelado', 'S'=>'Suspendido'))
							);
?>
<?php echo $this->TBS->input('Articulo.arobser', array('label' => 'Observaciones', 'type'=>'textarea', 'placeholder'=>'Observaciones y Comentarios', 'ly_w'=>'4')); ?>
</div>

<div id="tabs-1" class="tab-pane">
<?php echo $this->TBS->input('unidad_id', array('label' => 'Unidad')); ?>
<?php echo $this->TBS->input('linea_id', array('label' => 'Linea')); ?>
<?php echo $this->TBS->input('marca_id', array('label' => 'Marca')); ?>
</div>

 
<div id="tabs-3" class="tab-pane">
<?php echo $this->TBS->input('divisa_id', array('label' => 'Divisa', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Articulo.arimpu1', array('label' => 'Impuesto 1', 'append'=>'%', 'ly_w'=>'1', 'format'=>'currency', 'placeholder'=>'I.V.A.')); ?>
<?php echo $this->TBS->input('Articulo.arimpu2', array('label' => 'Impuesto 2', 'append'=>'%', 'ly_w'=>'1', 'format'=>'currency')); ?>
</div>

<div id="tabs-4" class="tab-pane">
	<?php echo $this->TBS->input('Articulo.arinvmin', array('label' => 'Inventario Mínimo', 'append'=>'Unidades', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('Articulo.arinvmax', array('label' => 'Inventario Máximo', 'append'=>'Unidades', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('Articulo.arcomposicion', array('label' => 'Composicion', 'ly_w'=>'4', 'placeholder'=>'Composición física / química')); ?>
	<?php echo $this->TBS->input('Articulo.arorigen', array('label' => 'Origen', 'ly_w'=>'4', 'placeholder'=>'Pais o Lugar de Origen')); ?>
	<?php echo $this->TBS->input('Articulo.arancho', array('label' => 'Ancho', 'append'=>'Mts','ly_w'=>'1')); ?>
</div>

<?php if ($mode == 'edit') {?>
<div id="tabs-5" class="tab-pane">
<?php echo $this->Element('ItemRecordData',
							array('MyController'=>'Materiales','MyModel'=>'Articulo','mode'=>$mode)); 
?>
</div>
<?php } ?>
</div> <!-- div tab-content-->
</div> <!-- div tabs tabbable-->
<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));

echo $this->Form->end(); 
?>