<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Contacto',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cve"><?php echo $form->text('cve', array('type' => 'search', 'maxLength' => '16', 'placeholder' => 'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('nom',array('type' => 'search', 'maxLength' => '64', 'placeholder' => 'Nombre o Razón Social', 'class' => 'search-query'));?></th>
				<th class="tel"><?php echo $form->text('tel',array('type' => 'search', 'placeholder' => 'Telefono', 'class' => 'search-query'));?></th>
				<th class="tel"><?php echo $form->text('fax',array('type' => 'search', 'placeholder' => 'Fax', 'class' => 'search-query'));?></th>
				<th class="email"><?php echo $form->text('email',array('type' => 'search', 'placeholder' => 'EMail', 'class' => 'search-query '));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cve"><?php echo $this->Paginator->sort('Clave','cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Nombre','nom'); ?></th>
				<th class="tel"><?php echo $this->Paginator->sort('Telefonos','tel'); ?></th>
				<th class="tel"><?php echo $this->Paginator->sort('Fax','fax'); ?></th>
				<th class="email"><?php echo $this->Paginator->sort('EMail','email'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','st'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($contactos as $contacto):
			$class = null;
			$thisID=trim($contacto['Contacto']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cve"><?php echo $contacto['Contacto']['cve']; ?></td>
				<td class=""><?php echo $contacto['Contacto']['nom']; ?></td>
				<td class="tel"><?php echo $contacto['Contacto']['tel']; ?></td>
				<td class="tel"><?php echo $contacto['Contacto']['fax']; ?></td>
				<td class="email"><?php echo $contacto['Contacto']['email']; ?></td>
				<td class="st"><?php echo $contacto['Contacto']['st']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Contacto','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>