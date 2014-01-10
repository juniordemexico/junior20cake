<div class="span12 edit-form">

<?php echo $this->Form->create('Ifisico', array('class'=>'form-horizontal')); ?>
<?php echo $this->Form->hidden('Ifisico.id'); ?>
<?php echo $this->Form->hidden('Ifisico.articulo_id'); ?>
<?php echo $this->Form->hidden('Ifisico.color_id'); ?>
<?php echo $this->Form->hidden('Ifisico.talla_id'); ?>
<?php echo $this->Form->hidden('Ifisico.created_user_id'); ?>
<?php echo $this->Form->hidden('Ifisico.modified_user_id'); ?>

	<div class="row">
		<div class="span5">
			<?php echo $this->TBS->input('Articulo.arcveart', array('type' => 'text', 'label' => 'Clave', 'ly_w'=>'2', 'readonly'=>'readonly')); ?>
			<?php echo $this->TBS->input('Color.cve', array('type' => 'text', 'label' => 'Color', 'ly_w'=>'2', 'readonly'=>'readonly')); ?>
		</div>
		<div class="span5">
			<?php echo $this->TBS->input('Articulo.lento', array('type' => 'checkbox', 'label' => 'Lento', 'ly_w'=>'2', 'readonly'=>'readonly')); ?>
			<?php echo $this->TBS->input('Articulo.arst', array('type' => 'text', 'label' => 'ST', 'ly_w'=>'2', 'readonly'=>'readonly')); ?>
			<?php echo $this->TBS->input('Ifisico.existencia', array('type' => 'text', 'label' => 'Existencia', 'ly_w'=>'2', 'readonly'=>'readonly')); ?>
		</div>
	</div>
	<div class="row">
		<div class="span5">
		<h4><em class="<?php if ($this->data['Ifisico']['existencia']<>$this->data['Ifisico']['cant_1']) echo "text-error";?>">Primer Conteo</em></h4>
		<?php echo $this->TBS->input('Ifisico.t0_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat0'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t0_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t1_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat1'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t1_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t2_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat2'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t2_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t3_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat3'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t3_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t4_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat4'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t4_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t5_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat5'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t5_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t6_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat6'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t6_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t7_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat7'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t7_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t8_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat8'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t8_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.t9_1', array('class' => 'cont1', 'type' => 'text', 'label' => $this->data['Talla']['tat9'], 'ly_w'=>'1', 'readonly'=>($this->data['Ifisico']['t9_2']?'readonly':'') )); ?>
		<?php echo $this->TBS->input('Ifisico.cant_1', array('type' => 'text', 'label' => '<strong>Suma 1</strong>', 'ly_w'=>'1', 'readonly'=>'readonly')); ?>
		</div>
		<div class="span5">
		<h4><em class="<?php if ($this->data['Ifisico']['existencia']<>$this->data['Ifisico']['cant_2']) echo "text-error";?>">Segundo Conteo</em></h4>
		<?php echo $this->TBS->input('Ifisico.t0_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat0'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t1_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat1'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t2_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat2'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t3_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat3'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t4_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat4'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t5_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat5'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t6_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat6'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t7_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat7'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t8_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat8'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t9_2', array('class' => 'cont2', 'type' => 'text', 'label' => $this->data['Talla']['tat9'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.cant_2', array('type' => 'text', 'label' => '<strong>Suma 2</strong>', 'ly_w'=>'1', 'readonly'=>'readonly')); ?>
		</div>
	</div>

<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<?php echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content', 'escape'=>false)); ?>
	</div>
	<div class="btn-group pull-right">	
		<button type="button" class="btn btn-primary" data-ng-click="copiaasegundo()" data-ng-disabled="(data.Master.id>0)" title="Copiar Primer Conteo al Segundo Conteo" alt="Copiar">
		<i class="icon-plus-sign icon-white"></i>
		</button>
	</div>
</div>

</div> <!-- span12 -->

<script>
$(function() {
	$("button")
	.button()
	.click(function (event) {

	$('.cont1').each(function(i, valor){
		$('#IfisicoT'+i+'2').val(valor.value);
		});
	});
});
</script>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>