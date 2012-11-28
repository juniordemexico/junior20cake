<div class="span12 edit-form">

<?php echo $this->Form->create('Articulo', array('class'=>'form-horizontal')); ?>
<?php echo $this->Form->hidden('id'); ?>

<?php
 echo $this->TBS->input('Articulo.arcveart', array('type' => 'text', 'label' => 'Código'));
?>
<?php echo $this->TBS->input('Articulo.ardescrip', array('type' => 'text', 'label' => 'Descripción')); ?>

<?php echo $this->TBS->input('barcodeserie_id', array('label' => 'Serie de Codigos')); ?>
</div>
</div>
<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content'));

echo $this->Form->end();
?>

<?php

 $autocompleteUrl = Router::url(array('action'=>'autoComplete','field'=>'Articulo.arcveart'), true);
 echo $this->Html->scriptBlock("
   $('#ArticulosEditForm').find('#ArticuloArcveart').autocomplete({
    source: '".$autocompleteUrl."',
    minLength:4,
	search: function(event, ui) { },
    select: function(event, ui) { }
   });

 ", array('inline' => true));
?>

</div> <!-- span12 -->