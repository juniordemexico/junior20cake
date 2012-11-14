	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<?php echo $this->element('FormToolBar', array('MyController'=>'Facturas', 'MyModel' => 'Factura', 'MyMode' => $mode));
				?>
			</div>
		</div>
	</div>
</div>

<?php echo $this->Form->create('Factura'); ?>
<div>
<?php echo $this->Form->input('Factura.farefer', array('type' => 'text', 'maxlenght' => '8', 'label' => 'Folio')); ?>
<?php echo $this->Form->input('Factura.fafecha', array('type' => 'text', 'label' => 'Fecha', 'maxlenght' => '10')); ?>
<?php echo $this->Form->input('Cliente.clcvecli', array('type' => 'text', 'maxlenght' => '16', 'label' => 'Cliente', 'placeholder' => 'Clave')); ?>
<?php echo $this->Form->input('Cliente.cltda', array('type' => 'text', 'label' => 'Tienda', 'maxlenght' => '8', 'placeholder' => 'Tda')); ?>
<?php echo $this->Form->input('Cliente.clnom', array('maxlenght' => '64', 'label' => 'Nombre', 'placeholder' => 'Nombre o Razón Social')); ?>
<?php	echo $this->Form->hidden('id'); ?>
</div>
<?php if ($mode == 'edit') {?>
<?php }?>
<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Totales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Detalle</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Otros</a></li>
		<?php if ($mode == 'edit') {?>
		<li><a href="#tabs-3" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">
<?php echo $this->Form->input('Factura.fafvence', array('type'=>'text','maxlenght' => '10', 'label' => 'Vence')); ?>
<?php echo $this->Form->input('Factura.clplazo', array('label' => 'Plazo', 'maxlenght' => '3', 'placeholder'=>'Días')); ?>
<?php echo $this->Form->input('Factura.fasuma', array('maxlenght' => '14', 'label' => 'Suma')); ?>
<?php echo $this->Form->input('divisa_id', array('label' => 'Divisa')); ?>
<?php echo $this->Form->input('Factura.clprecio', array('label' => 'Lista de Precios', 'type' => 'text', 'maxlenght' => '1')); ?>
<?php //echo $this->Form->input('vendedor_id', array('label' => 'Vendedor asignado')); ?>
<?php echo $this->Form->input('Factura.cldesc1', array('label' => 'Descuento 1', 'maxlenght' => '5')); ?>
<?php echo $this->Form->input('Factura.cldesc2', array('label' => 'Descuento 2', 'maxlenght' => '5')); ?>
<?php echo $this->Form->input('Factura.faimporte', array('maxlenght' => '14', 'label' => 'Importe')); ?>
<?php echo $this->Form->input('Factura.faimpoimpu', array('maxlenght' => '14', 'label' => 'Impuestos')); ?>
<?php echo $this->Form->input('Factura.fatotal', array('maxlenght' => '14', 'label' => 'Total')); ?>
<?php echo $this->Form->radio('Factura.fast',
							array('A'=>'Activo','C'=>'Cancelado','S'=>'Surtido'),
								array('label'=>'false','legend'=>'Estatus'));
?>
</div>

<div id="tabs-1" class="tab-pane">
<?php echo $this->Element('facturas/detail', array('mode'=>$mode, 'details'=>$details, 'master_id'=>$master_id));?>
</div>

<div id="tabs-2" class="tab-pane">
<?php echo $this->Form->input('Factura.fat', array('label' => 'TTipo', 'type' => 'checkbox')); ?>
<?php echo $this->Form->input('Factura.faobser', array('label' => 'Observaciones', 'type'=>'textarea', 'maxlenght' => '128', 'placeholder'=>'Comentarios...')); ?>
</div>

<?php if ($mode == 'edit') {?>
<div id="tabs-3" class="tab-pane">
<div class="label readonly">
	<label class="readonly"><?php __("id"); ?></label>
	<em><?php echo $this->data['Factura']['id']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("created"); ?></label>
	<em><?php echo $this->data['Factura']['crefec']; ?>&nbsp;</em>
</div>
<div class="label readonly">
	<label class="readonly"><?php __("modified"); ?></label>
	<em><?php echo $this->data['Factura']['modfec']; ?>&nbsp;</em>
</div>

</div>
<?php } ?>

</div>
</div>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'ui-button-primary', 'update' => '#content'));

echo $this->Form->end(); 
?>

<?php
 $autocompleteUrl = Router::url(array('controller'=>'Clientes','action'=>'autoComplete','field'=>'clcvecli'), true);
 $autocompleteUrl2 = Router::url(array('controller'=>'Clientes','action'=>'autoComplete','field'=>'cltda'), true);

	/* Create the form's tabs */
    echo $this->Html->scriptBlock("	

	//	$( '#data[Factura][pest]' ).buttonset();
	
    $('#FacturaPefecha').datepicker();
	    $('#FacturaPefvence').datepicker();

	"."\n",
	array('inline' => true));
/*
  echo $this->Html->scriptBlock("
  $(document).ready(function(){
   $('#FacturaPecvecli').autocomplete({
    source: '".$autocompleteUrl."',
    minLength:2,
	search: function(event, ui) { },
    select: function(event, ui) { 
	$('#FacturaPetda').autocomplete('options', 'source', '".$autocompleteUrl2."' + '/clcvecli:' + $('#FacturaPecvecli').val() );
	}
   });

  $('#FacturaPetda').autocomplete({
    source: '".$autocompleteUrl2."',
    minLength:1,
	search: function(event, ui) { 
	alert()
	},
    select: function(event, ui) { }
   });



$('#FacturaPecvecli').live('change',
						function(){
						alert($('#FacturaPetda').autocomplete('options', 'source'));
							$('#FacturaPetda').autocomplete('options', 'source', '".$autocompleteUrl2."' + '/clcvecli:' + $('#FacturaClcvecli').val());
						});

  });
 ", array('inline' => true));
*/
?>
