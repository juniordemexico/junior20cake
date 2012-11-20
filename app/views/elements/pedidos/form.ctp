<?php echo $this->Form->create('Pedido', array('class'=>'form-horizontal well')); ?>
<div class="row-fluid">
	<div class="span4">
		<?php echo $this->Form->hidden('id'); ?>
		<?php echo $this->Form->hidden('tmpid'); ?>
		<?php echo $this->TBS->input('Pedido.perefer', array('type' => 'text', 'label' => 'Folio', 'ly_w'=>'2')); ?>
		<?php echo $this->TBS->input('Pedido.pefecha', array('type' => 'textdate', 'label' => 'Fecha', 'ly_w'=>'2')); ?>
		<?php echo $this->TBS->input('Pedido.pefvence', array('type'=>'textdate', 'label' => 'Vence', 'ly_w'=>'2')); ?>
		<?php
	echo $this->TBS->input('Pedido.pest', array('label'=>'Estatus', 'type' => 'radiogroup',
											'selectOptions'=> array('A'=>'Activo','C'=>'Cancelado'))
							);
?>
	</div>
	<div class="span8">
		<?php echo $this->TBS->input('Cliente.clcvecli', array('type' => 'text', 'label' => 'Cliente', 'placeholder' => 'Clave', 'ly_w'=>'2')); ?>
		<?php echo $this->TBS->input('Cliente.cltda', array('type'=>'text', 'label' => 'Tienda', 'placeholder' => 'Tda', 'ly_w'=>'2')); ?>
		<?php echo $this->TBS->input('Cliente.clnom', array('label' => 'Nombre', 'placeholder' => 'Nombre o Razón Social', 'ly_w'=>'4')); ?>
		<?php echo $this->TBS->input('vendedor_id', array('label' => 'Vendedor asignado', 'ly_w'=>'4')); ?>
	</div>
</div>

<div class="row-fluid">
<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Totales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Detalle</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Otros</a></li>
		<?php if ($mode == 'view') {?>
		<li><a href="#tabs-3" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>

<div class="tab-content" style="height: 320px; min-height: 320px; overflow-y: auto;">

<div id="tabs-0" class="tab-pane active">
<div class="row-fluid">
<div class="span6">
<?php echo $this->TBS->input('divisa_id', array('label' => 'Divisa', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Pedido.peplazo', array('label' => 'Plazo', 'ly_w'=>'1', 'placeholder'=>'Plazo', 'append'=>'Días')); ?>
<?php echo $this->TBS->input('Pedido.peprecio', array('label' => 'Lista de Precios', 'type' => 'text', 'ly_w'=>'1')); ?>
<?php echo $this->TBS->input('Pedido.pedesc1', array('label' => 'Descuento 1', 'ly_w'=>'1', 'append'=>'%')); ?>
<?php echo $this->TBS->input('Pedido.pedesc2', array('label' => 'Descuento 2', 'ly_w'=>'1', 'append'=>'%')); ?>
</div>
<div class="span6">
<?php echo $this->TBS->input('Pedido.pesuma', array('label' => 'Suma', 'ly_w'=>'2', 'prepend'=>'$', 'format'=>'currency')); ?>
<?php echo $this->TBS->input('Pedido.peimporte', array('label' => 'Importe', 'ly_w'=>'2', 'prepend'=>'$', 'format'=>'currency')); ?>
<?php echo $this->TBS->input('Pedido.peimpoimpu', array('label' => 'Impuestos', 'ly_w'=>'2', 'prepend'=>'$', 'format'=>'currency')); ?>
<?php echo $this->TBS->input('Pedido.petotal', array('label' => 'Total', 'ly_w'=>'2', 'prepend'=>'$', 'format'=>'currency')); ?>
</div>
</div>
</div>

<div id="tabs-1" class="tab-pane">
<?php echo $this->Element('pedidos/detail', array('mode'=>$mode, 'details'=>$details, 'master_id'=>(isset($this->data['Pedido']['tmpid']) && $this->data['Pedido']['tmpid']>0)?$this->data['Pedido']['tmpid']:$master_id));?>
</div>

<div id="tabs-2" class="tab-pane">
<?php echo $this->TBS->input('Pedido.pet', array('label' => 'TTipo', 'type' => 'checkbox')); ?>
<?php echo $this->TBS->input('Pedido.peobser', array('label' => 'Observaciones', 'type'=>'textarea', 'placeholder'=>'Comentarios...', 'ly_w'=>'4')); ?>
</div>

<?php if ($mode == 'view') {?>
<div id="tabs-3" class="tab-pane">
<div class="label readonly">
	<label class="readonly"><?php __("id"); ?></label>
	<em><?php echo $this->data['Pedido']['id']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("created"); ?></label>
	<em><?php echo $this->data['Pedido']['crefec']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("modified"); ?></label>
	<em><?php echo $this->data['Pedido']['modfec']; ?>&nbsp;</em>
</div>

</div>
<?php } ?>

</div>
</div>
</div>
<?php
if ($mode == 'view') {
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'type'=>'button', 'update' => '#content'));
}
echo $this->Form->end(); 
?>

<?php
if ($mode == 'view') {	
 $autocompleteUrl = Router::url(array('controller'=>'Clientes','action'=>'autoComplete','field'=>'clcvecli'), true);
 $autocompleteUrl2 = Router::url(array('controller'=>'Clientes','action'=>'autoComplete','field'=>'cltda'), true);
/*
 		$.each(data.items, function(i,item) {
      		$('#'+item.id).val('value', item.value);
      		if ( i == 3 ) return false;
    	});
*/

  echo $this->Html->scriptBlock("

	$('#ClienteClcvecli').autocomplete({
		source: '".$autocompleteUrl."',
		minLength:2,
		search: function(event, ui) { },
		select: function(event, ui) { 
		}
	});

/*
	$('#ClienteCltda').autocomplete({
		source: '".$autocompleteUrl2."',
		minLength:2,
		search: function(event, ui) { 
			
			},
		}
	});
*/


$('#ClienteClcvecli').live('change',
						function() {

alert('nada'+$(this).val());

var nada=$.ajax({
	url: '/clientes/getInfo/',
	dataType: 'json',
	data: data,
	}).done( function(data) {
		alert('data'+data);
	}  
	);

});

$autocompleteArticuloUrl = Router::url(array('action'=>'autoComplete','field'=>'Articulo.arcveart'), true);
   $('#ArticuloArcveart').autocomplete({
    source: '".$autocompleteArticuloUrl."',
    minLength:4,
	search: function(event, ui) { },
    select: function(event, ui) { }
   });

 ", array('inline' => true));
}
?>