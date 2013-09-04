<?php echo $this->Form->create('Articulo', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php 	echo $this->Form->hidden('Articulo.art', array( 'label' => null)); ?>
<?php }?>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Generales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Clasificacion</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Colores</a></li>
		<li><a href="#tabs-3" data-toggle="tab">Precios</a></li>
<?php //		<li><a href="#tabs-4" data-toggle="tab">Costos</a></li> ?>
<?php //		<li><a href="#tabs-5" data-toggle="tab">Caracteristicas</a></li> ?>
		<?php if($mode=="edit" || $mode=='view'): ?>
		<li><a href="#tabs-10" data-toggle="tab">Historial</a></li>
		<?php endif;?>
	</ul>
	
<div class="tab-content">
<div id="tabs-0" class="tab-pane active">
<?php echo $this->TBS->input('Articulo.arcveart', array('type' => 'text', 'label' => 'Código', 'ly_w'=>'2', 
							'title'=>($mode=='edit' && $itemCodeReadOnly==1)?'Este producto YA tiene transacciones. No es posible editar su Código':'Proporciona el Código interno del producto',
							'class'=>(($mode=='edit' && $itemCodeReadOnly==1)?'readonly':''), 'readonly'=>(($mode=='edit' && $itemCodeReadOnly==1)?'readonly':''?'true':''))); ?>
<?php echo $this->TBS->input('Articulo.ardescrip', array('type' => 'text', 'label' => 'Descripción', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('arst', array('type'=>'radiogroup', 'label'=>'Estatus', 
							'selectOptions'=>array('A'=>'Activo', 'C'=>'Cancelado', 'S'=>'Suspendido'),
							'title'=>'Elige el Estatus del producto: Activo, Baja (descontinuado, eliminado), Suspendido (bloqueado temporalmente)'
							));
?>
<?php echo $this->TBS->input('Articulo.lento', array('type'=>'checkbox', 'label'=>'Lento Desplazamiento', 'title'=>'Marca esta opción para productos de lento desplazamiento')); ?>
<?php echo $this->TBS->input('Articulo.arstcompterm', array('type'=>'checkbox', 'label'=>'Se Compra Terminado', 'title'=>'Marcalo en caso de que este producto se compre terminado')); ?>
<?php echo $this->TBS->input('Articulo.arobser', array('label' => 'Observaciones', 'type'=>'textarea', 'placeholder'=>'Observaciones y Comentarios', 'title'=>'Proporciona cualquier tipo de observación o comentario respecto a este producto ', 'ly_w'=>'4')); ?>
<?echo "perro::".$itemCodeReadOnly;?>
</div>

<div id="tabs-1" class="tab-pane">
<?php //echo $this->TBS->input('tipoarticulo_id', array('label' => 'ºTipo de Inventario')); ?>
<?php echo $this->TBS->input('unidad_id', array('label' => 'Unidad')); ?>
<?php echo $this->TBS->input('linea_id', array('label' => 'Linea')); ?>
<?php echo $this->TBS->input('marca_id', array('label' => 'Marca')); ?>
<?php echo $this->TBS->input('temporada_id', array('label' => 'Temporada')); ?>
<?php echo $this->TBS->input('talla_id', array('label' => 'Grupo de Tallas')); ?>
<?php echo $this->TBS->input('proporcion_id', array('label' => 'Proporciones para Prod')); ?>
<?php echo $this->TBS->input('base_id', array('label' => 'Base o molde del producto', 'empty'=>'Selecciona una...')); ?>
<?php echo $this->TBS->input('estilo_id', array('label' => 'Estilo del producto', 'empty'=>'Selecciona uno...')); ?>
</div>

<div id="tabs-2" class="tab-pane">

<div class="row-fliud">
<div class="span8">
<?php echo $this->TBS->input('Color', array('label'=>'Colores', 'multiple'=>'checkbox')); ?>
</div>

<div class="span4" id="related-records-container">
<label class="label">Colores Actuales:</label>
<?php if(isset($this->data['Color']) && sizeof($this->data['Color'])>0 && $mode=='edit'): ?>
<div class="related-records">
<ul>
<?php foreach($this->data['Color'] as $color): ?>
	<li><a href="/Colores/edit/<?php echo $color['id'];?>" target="_blank"><?php echo $color['cve']; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>
</div>

</div>
</div> <!-- div tabs-2 -->
 
<div id="tabs-3" class="tab-pane">
<?php echo $this->TBS->input('divisa_id', array('label' => 'Divisa', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Articulo.arpva', array('label' => 'Precio A', 'prepend'=>'$', 'ly_w'=>'1', 'format'=>'currency', 'placeholder'=>'Neto')); ?>
<?php echo $this->TBS->input('Articulo.arpvb', array('label' => 'Precio B', 'prepend'=>'$', 'ly_w'=>'1', 'format'=>'currency', 'placeholder'=>'Bruto')); ?>
<?php echo $this->TBS->input('Articulo.arpvc', array('label' => 'Precio Promoción', 'prepend'=>'$', 'ly_w'=>'1', 'format'=>'currency', 'placeholder'=>'Promoción...')); ?>
<?php echo $this->TBS->input('Articulo.arimpu1', array('label' => 'Impuesto 1', 'append'=>'%', 'ly_w'=>'1', 'format'=>'currency', 'placeholder'=>'I.V.A.')); ?>
<?php echo $this->TBS->input('Articulo.arimpu2', array('label' => 'Impuesto 2', 'append'=>'%', 'ly_w'=>'1', 'format'=>'currency')); ?>
<?php echo $this->TBS->input('Articulo.ardesc1', array('label' => 'Descuento 1', 'append'=>'%', 'ly_w'=>'1', 'format'=>'currency')); ?>
<?php echo $this->TBS->input('Articulo.ardesc2', array('label' => 'Descuento 2', 'append'=>'%', 'ly_w'=>'1', 'format'=>'currency')); ?>
</div>

<?php
/*
<div id="tabs-4" class="tab-pane">
<?php echo $this->TBS->input('Articulo.arpcosto', array('label' => 'Costo', 'prepend'=>'$', 'ly_w'=>'1', 'format'=>'currency')); ?>
<?php echo $this->TBS->input('Articulo.arucosto', array('label' => 'Ultimo Costo', 'prepend'=>'$', 'ly_w'=>'1', 'format'=>'currency')); ?>
<?php echo $this->TBS->input('Articulo.arcostoprom', array('label' => 'Costo Promedio', 'prepend'=>'$', 'ly_w'=>'2', 'format'=>'currency')); ?>
</div>
*/
?>

<?php
/*
<div id="tabs-5" class="tab-pane">
	<?php echo $this->TBS->input('Articulo.arinvmin', array('label' => 'Inventario Mínimo', 'append'=>'Unidades', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('Articulo.arinvmax', array('label' => 'Inventario Máximo', 'append'=>'Unidades', 'ly_w'=>'1')); ?>
	<?php echo $this->TBS->input('Articulo.arcomposicion', array('label' => 'Composicion', 'ly_w'=>'4', 'placeholder'=>'Composición física / química')); ?>
	<?php echo $this->TBS->input('Articulo.arorigen', array('label' => 'Origen', 'ly_w'=>'4', 'placeholder'=>'Pais o Lugar de Origen')); ?>
	<?php echo $this->TBS->input('Articulo.arancho', array('label' => 'Ancho', 'append'=>'Mts','ly_w'=>'1')); ?>
</div>
*/
?>

<?php if ($mode == 'edit' || $mode=='view'): ?>
<div id="tabs-10" class="tab-pane">
<?php echo $this->Element('ItemRecordData', array(
							'MyController'=>$this->name,
							'MyModel'=>$this->Form->params['models'][0],
							'mode'=>$mode,
							)); 
?>
</div>
<?php endif; ?>
</div> <!-- div tab-content-->
</div> <!-- div tabs tabbable-->
<?php
if( $session->read('Auth.User.group_id') == 1 || $session->read('Auth.User.group_id') == 2 ||
	$session->read('Auth.User.group_id') == 10 || $session->read('Auth.User.group_id') == 21 ) {
	echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));
}
echo $this->Form->end(); 
?>
