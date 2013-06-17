<?php echo $this->Form->create('ArticuloReports'); ?>
<div id="#rptGeneralRanges">
<?php
 echo $this->Form->hidden('SelectedReport');
 echo $this->Form->input('Articulo.arcveart', array('type' => 'text', 'maxLength' => '16', 'label' => 'Inicial'));
 echo $this->Form->input('Articulo.arcveartfin', array('type' => 'text', 'maxLength' => '16', 'label' => 'Final'));
?>
<?php echo $this->Form->input('linea_id', array('label' => 'Linea')); ?>
<?php echo $this->Form->input('temporada_id', array('label' => 'Temporada')); ?>
<?php echo $this->Form->input('unidad_id', array('label' => 'Unidad')); ?>
<?php echo $this->Form->input('marca_id', array('label' => 'Marcas')); ?>
</div>
<?php echo $this->Form->end('VER'); ?>

<div id="accordion">

<div>
<h3><a href="#">Códigos de Barra</a></h3>
<p>
<?php
 echo $this->Form->input('Articulo.modified', array('type' => 'text', 'maxLength' => '10', 'label' => 'Desde'));
 ?>
<?php
 echo $this->Form->input('Articulo.created', array('type' => 'text', 'maxLength' => '10', 'label' => 'Hasta'));
 ?>
</p>
</div>

<div>
<h3><a href="#">Lista de Precios</a></h3>
<p>
<?php
 echo $this->Form->input('Articulo.modified2', array('type' => 'date', 'maxLength' => '16', 'label' => 'Inicial'));
 ?>
<?php
 echo $this->Form->input('Articulo.created2', array('type' => 'date', 'maxLength' => '16', 'label' => 'Final'));
 ?>
</p>
</div>

<div>
<h3><a href="#">Fichas Técnicas</a></h3>
<p>
sadasdasasd
</p>
</div>

<div>
<h3><a href="#">LA ULTIMASSS</a></h3>
<p>
sadasdasasd
</p>
</div>


</div>

<?php
	/* Create the form's accordion */
    echo $this->Html->scriptBlock("	var accordion=$(function() {
		$( '#accordion' ).accordion({autoHeight: false, fillSpace: true});
	});"."\n",
	array('inline' => true));
	

 $autocompleteUrl = Router::url(array('controller'=>'Articulos','action'=>'autoComplete','field'=>'Articulo.arcveart'), true);
 echo $this->Html->scriptBlock("
  $(document).ready(function(){
   $('#ArticuloArcveart').autocomplete({
    source: '".$autocompleteUrl."',
    minLength:4,
	search: function(event, ui) { },
    select: function(event, ui) { }
   });

/*   $('#ArticuloArcomposicion').datepicker();*/

  });
 ", array('inline' => true));

 $autocompleteFinUrl = Router::url(array('controller'=>'Articulos','action'=>'autoComplete','field'=>'Articulo.arcveartfin'), true);
 echo $this->Html->scriptBlock("
  $(document).ready(function(){
   $('#ArticuloArcveartfin').autocomplete({
    source: '".$autocompleteUrl."',
    minLength:4,
	search: function(event, ui) { },
    select: function(event, ui) { }
   });

   $('#ArticuloModified').datepicker();

  });
 ", array('inline' => true));

//  echo $this->Js->get('#ArticuloArcveart')->event('change', "function(){ //$('ArticuloArcveartFin').value=this.value;  } ");
?>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
