<?php echo $this->Form->create('Contacto', array('class'=>'form-horizontal')); ?>
<?php if ($mode == 'edit') {?>
<?php	echo $this->Form->hidden('id'); ?>
<?php }?>
<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Generales</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Direccion</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Mapas</a></li>
		<li><a href="#tabs-3" data-toggle="tab">Varios</a></li>
		<?php if ($mode == 'edit') {?>
		<li><a href="#tabs-10" data-toggle="tab">Historial</a></li>
		<?php }?>
	</ul>

<div class="tab-content" style="height: 400px; min-height: 400px;">

<div id="tabs-0" class="tab-pane active">
	<?php echo $this->TBS->input('Contacto.cve', array('type' => 'text', 'label' => 'Clave', 'placeholder' => 'Clave', 'ly_w'=>'2', 'maxlength'=>'4')); ?>
	<?php echo $this->TBS->input('Contacto.nom', array('label' => 'Nombre', 'placeholder' => 'Nombre o Razón Social', 'ly_w'=>'4')); ?>
	<?php echo $this->TBS->input('Contacto.tel', array('type' => 'text', 'label' => 'Telefonos', 'placeholder' => 'Telefonos', 'ly_w'=>'4')); ?>
	<?php echo $this->TBS->input('Contacto.fax', array('type' => 'text', 'label' => 'Fax', 'placeholder' => 'Fax', 'ly_w'=>'4')); ?>
	<?php echo $this->TBS->input('Contacto.email', array('type' => 'text', 'label' => 'Correo Electronico', 'placeholder' => 'EMail', 'ly_w'=>'4')); ?>
	<?php echo $this->TBS->input('Contacto.rfc', array('type' => 'text', 'label' => 'RFC', 'placeholder' => 'RFC del Contacto', 'ly_w'=>'2')); ?>
</div>
<div id="tabs-1" class="tab-pane">
	<?php echo $this->TBS->input('pais_id', array('label' => 'País', 'ly_w'=>'2')); ?>
	<?php echo $this->TBS->input('estado_id', array('label' => 'Estado', 'ly_w'=>'3')); ?>
	<?php echo $this->TBS->input('Contacto.dir', array('type' => 'textarea', 'label' => 'Dirección', 'ly_w'=>'4', 'placeholder' => 'Calle Número y Colonia')); ?>
	<?php echo $this->TBS->input('Contacto.cp', array('type' => 'text', 'label' => 'Código Postal', 'ly_w'=>'1', 'placeholder' => 'Código Postal')); ?>
</div>
<div id="tabs-2" class="tab-pane">
mapas
</div>
<div id="tabs-3" class="tab-pane">
<?php
	echo $this->TBS->input('Contacto.st', array('label'=>'Estatus', 'type' => 'radiogroup',
											'selectOptions'=> array('A'=>'Activo','B'=>'Baja','S'=>'Suspendido'))
							);
?>
<?php echo $this->TBS->input('Contacto.obser', array('label' => 'Observaciones', 'type'=>'textarea', 'maxlength' => '128', 'placeholder' => 'Comentarios...', 'ly_w'=>'4')); ?>
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
echo $this->Js->submit('GUARDAR', array('class' => 'ui-button-primary', 'update' => '#content'));

echo $this->Form->end(); 
?>

<?php
	/* Create the form's tabs */

 $autocompleteUrl = Router::url(array('controller'=>$this->name,'action'=>'autoComplete','field'=>'clcvecli'), true);
 $autocompleteUrl2 = Router::url(array('controller'=>$this->name,'action'=>'autoComplete','field'=>'cltda'), true);
 
  echo $this->Html->scriptBlock("
$(function () {

$('#ContactoCve').autocomplete({
    source: '".$autocompleteUrl."',
    minLength:2,
	search: function(event, ui) { },
    select: function(event, ui) { 
	}
   });

$('#ContactoCltda').autocomplete({
    source: '".$autocompleteUrl2."',
    minLength:1,
	search: function(event, ui) { 
		alert($('#ContactoCve').val());
	},
    select: function(event, ui) { }
   });

/*
$('#ContactoCve').live('blur',
						function(){
							$('#ContactoCltda').autocomplete('options', 'source', '".$autocompleteUrl2."' + '/clcvecli:' + $('#ContactoCve').val());
						});
*/
  });
 ", array('inline' => true));

?>
