<div class="span12 reports-form">

<?php echo $form->create('PedidoReportesForm',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
<div class="row-fluid">
	<div class="span6">

<?php echo $this->TBS->input('fechaini', array('type' => 'textdate', 'label' => 'Fecha Inicial:', 'ly_w'=>'2')); ?>
<?php echo $this->TBS->input('fechafin', array('type' => 'textdate', 'label' => 'Fecha Final:', 'ly_w'=>'2')); ?>
<?php
 echo $this->TBS->input('fvenceini', array('type' => 'textdate', 'label' => 'Vencimiento Inicial', 'ly_w'=>'2'));
?>
<?php
 echo $this->TBS->input('fvenceini', array('type' => 'textdate', 'label' => 'Vencimiento Final', 'ly_w'=>'2'));
?>
	</div>
	<div class="span6">
<?php
 echo $this->Form->input('Articulo.arcveart', array('type' => 'text', 'label' => 'Articulo Final'));
?>
<?php echo $this->Form->input('linea_id', array('label' => 'Linea')); ?>
<?php echo $this->Form->input('temporada_id', array('label' => 'Temporada')); ?>
<?php echo $this->Form->input('marca_id', array('label' => 'Marcas')); ?>
</div>
</div> <!-- end row-fluid -->
<?php echo $this->Form->end(); ?>

</div> <!-- reportsform-form -->
