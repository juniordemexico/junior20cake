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
		<h3>Conteo 1</h3>
		<?php echo $this->TBS->input('Ifisico.t0_1', array('type' => 'text', 'label' => $this->data['Talla']['tat0'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t1_1', array('type' => 'text', 'label' => $this->data['Talla']['tat1'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t2_1', array('type' => 'text', 'label' => $this->data['Talla']['tat2'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t3_1', array('type' => 'text', 'label' => $this->data['Talla']['tat3'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t4_1', array('type' => 'text', 'label' => $this->data['Talla']['tat4'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t5_1', array('type' => 'text', 'label' => $this->data['Talla']['tat5'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t6_1', array('type' => 'text', 'label' => $this->data['Talla']['tat6'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t7_1', array('type' => 'text', 'label' => $this->data['Talla']['tat7'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t8_1', array('type' => 'text', 'label' => $this->data['Talla']['tat8'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t9_1', array('type' => 'text', 'label' => $this->data['Talla']['tat9'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.cant_1', array('type' => 'text', 'label' => '<strong>Suma 1</strong>', 'ly_w'=>'1', 'readonly'=>'readonly')); ?>
		</div>
		<div class="span5">
		<h3>Conteo 2</h3>
		<?php echo $this->TBS->input('Ifisico.t0_2', array('type' => 'text', 'label' => $this->data['Talla']['tat0'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t1_2', array('type' => 'text', 'label' => $this->data['Talla']['tat1'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t2_2', array('type' => 'text', 'label' => $this->data['Talla']['tat2'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t3_2', array('type' => 'text', 'label' => $this->data['Talla']['tat3'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t4_2', array('type' => 'text', 'label' => $this->data['Talla']['tat4'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t5_2', array('type' => 'text', 'label' => $this->data['Talla']['tat5'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t6_2', array('type' => 'text', 'label' => $this->data['Talla']['tat6'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t7_2', array('type' => 'text', 'label' => $this->data['Talla']['tat7'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t8_2', array('type' => 'text', 'label' => $this->data['Talla']['tat8'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.t9_2', array('type' => 'text', 'label' => $this->data['Talla']['tat9'], 'ly_w'=>'1')); ?>
		<?php echo $this->TBS->input('Ifisico.cant_2', array('type' => 'text', 'label' => '<strong>Suma 2</strong>', 'ly_w'=>'1', 'readonly'=>'readonly')); ?>
		</div>
	</div>


<div class="row">
	<?php echo $this->Js->submit('GUARDAR', array('class' => 'btn btn-primary', 'update' => '#content')); ?>
	<br /><br />
	<ul>
		<li class="label">ifisico_id: <em><?php echo $this->data['Ifisico']['id']?></em></li>
		<li class="label">articulo_id: <em><?php echo $this->data['Ifisico']['articulo_id']?></em></li>
		<li class="label">color_id: <em><?php echo $this->data['Ifisico']['color_id']?></em></li>
		<li class="label">Creado: <em><?php echo $this->data['Ifisico']['created_user_id']?> ( <?php echo $this->data['Ifisico']['created']?> )</em></li>
		<li class="label">Modificado: <em><?php echo $this->data['User']['username']?> ( <?php echo $this->data['Ifisico']['modified']?> )</em></li>
	</ul>
</div>

</div> <!-- span12 -->


<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
