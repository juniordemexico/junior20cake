<div class="span12 import-form">

<?php echo $this->Form->create('PedidoImporta', array('action'=>'importa', 'class'=>'form-horizontal well')); ?>

<?php echo $this->TBS->input('data', array('type'=>'textarea', 'label'=>'Pegar aqui el contenido del archivo de pedido','maxlength'=>'32000'));?>

<?php
echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content', 'url'=>array('controller'=>'Pedidos', 'action'=>'Importa')));
echo $this->Form->end(); 
?>


</div> <!-- span12 -->
