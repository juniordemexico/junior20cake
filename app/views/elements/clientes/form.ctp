<?php echo $this->Form->create('Cliente', array('class'=>'form-horizontal')); ?>
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

<div class="tab-content" style="height: 400px; min-height: 400px;">

<div id="tabs-0" class="tab-pane active">
<?php echo $this->TBS->input('Cliente.clcvecli', array('type' => 'text', 'label' => 'Clave', 'placeholder' => 'Clave', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Cliente.cltda', array('type' => 'text', 'label' => 'Tienda', 'placeholder' => 'Tda', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Cliente.clnom', array('label' => 'Nombre o Razón Social', 'placeholder' => 'Nombre o Razón Social', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Cliente.clsuc', array('type' => 'text', 'label' => 'Nombre de la Sucursal', 'placeholder' => 'Sucursal', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Cliente.clatn', array('type' => 'text', 'label' => 'At\'n', 'placeholder' => 'At\'n', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Cliente.clemail', array('type' => 'text', 'label' => 'Email', 'placeholder' => 'Correo Electronico', 'ly_w'=>'4', 'prepend'=>'<i class="icon icon-envelope"></i>')); ?>
<?php
	echo $this->TBS->input('Cliente.clst', array('label'=>'Estatus', 'type' => 'radiogroup',
											'selectOptions'=> array('A'=>'Activo', 'C'=>'Cancelado', 'S'=>'Suspendido'))
							);
?>
</div>
<div id="tabs-1" class="tab-pane">
<?php
	echo $this->TBS->input('Cliente.cllocfor', array('label'=>'Estatus', 'type' => 'radiogroup',
											'selectOptions'=> array('0'=>'Local', '1'=>'Foraneo'))
							);
?>
 
<?php echo $this->TBS->input('pais_id', array('label' => 'País', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('estado_id', array('label' => 'Estado', 'ly_w'=>'3')); ?>
<?php echo $this->TBS->input('Cliente.cldir', array('type' => 'textarea', 'label' => 'Dirección', 'ly_w'=>'4', 'placeholder' => 'Calle Número y Colonia')); ?>
<?php echo $this->TBS->input('Cliente.clcp', array('type' => 'text', 'label' => 'Código Postal', 'ly_w'=>'1', 'placeholder' => 'Código Postal')); ?>
</div>
<div id="tabs-2" class="tab-pane">
<?php echo $this->TBS->input('Cliente.clrfc', array('type' => 'text', 'label' => 'RFC', 'placeholder' => 'RFC del Cliente', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('Cliente.clcurp', array('type' => 'text', 'label' => 'CURP', 'placeholder' => 'CURP del Cliente', 'ly_w'=>'3')); ?>
<?php echo $this->TBS->input('vendedor_id', array('label' => 'Vendedor asignado', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('divisa_id', array('label' => 'Divisa', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Cliente.clprecio', array('label' => 'Lista de Precios', 'type' => 'text', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Cliente.cldesc1', array('label' => 'Descuento 1', 'append'=>'%', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Cliente.cldesc2', array('label' => 'Descuento 2', 'append'=>'%', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Cliente.cldesc3', array('label' => 'Descuento 3', 'append'=>'%', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Cliente.clplazo', array('label' => 'Plazo', 'append'=>'Días', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Cliente.seriefactura', array('label' => 'Facturar con Serie', 'type' => 'text', 'ly_w'=>'1')); ?>
</div>
<div id="tabs-3" class="tab-pane">
<?php echo $this->TBS->input('Cliente.clbancocve', array('label' => 'Su Banco', 'placeholder' => 'Banco del Cliente', 'ly_w'=>'4')); ?>
<?php echo $this->TBS->input('Cliente.clbancocta', array('label' => 'Su Número de Cuenta', 'placeholder' => 'Número de Cta del Cliente', 'ly_w'=>'3')); ?>
</div>
<div id="tabs-4" class="tab-pane">
<?php echo $this->TBS->input('Cliente.clobser', array('label' => 'Observaciones', 'type'=>'textarea', 'maxlenght' => '128', 'placeholder' => 'Comentarios...', 'ly_w'=>'4')); ?>
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

<?php
	/* Create the form's tabs */

 $autocompleteUrl = Router::url(array('controller'=>$this->name,'action'=>'autoComplete','field'=>'clcvecli'), true);
 $autocompleteUrl2 = Router::url(array('controller'=>$this->name,'action'=>'autoComplete','field'=>'cltda'), true);
 
  echo $this->Html->scriptBlock("
$(function () {

$('#ClienteClcvecli').autocomplete({
    source: '".$autocompleteUrl."',
    minLength:2,
	search: function(event, ui) { },
    select: function(event, ui) { 
	}
   });

$('#ClienteCltda').autocomplete({
    source: '".$autocompleteUrl2."',
    minLength:1,
	search: function(event, ui) { 
		alert($('#ClienteClcvecli').val());
	},
    select: function(event, ui) { }
   });

/*
$('#ClienteClcvecli').live('blur',
						function(){
							$('#ClienteCltda').autocomplete('options', 'source', '".$autocompleteUrl2."' + '/clcvecli:' + $('#ClienteClcvecli').val());
						});
*/
  });
 ", array('inline' => true));

?>
