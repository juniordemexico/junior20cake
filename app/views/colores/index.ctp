<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Color',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class=""><?php echo $form->text('cve', array('id'=>'cve', 'label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Color', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->input('tipoarticulo_id_0', array('label' => false, 'type' => 'checkbox'));?></th>
				<th class="cve"><?php echo $form->input('tipoarticulo_id_1',array('label' => false, 'type' => 'checkbox'));?></th>
				<th class="cve"><?php echo $form->input('tipoarticulo_id_2',array('label' => false, 'type' => 'checkbox'));?></th>
				<th class="cve"><?php echo $form->input('tipoarticulo_id_3',array('label' => false, 'type' => 'checkbox'));?></th>
				<th class="st"><?php echo $form->text('st',array('label' => false, 'type' => 'search', 'placeholder'=>'ST', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('modified',array('label' => false, 'type' => 'search', 'placeholder'=>'Modificado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class=""><?php echo $this->Paginator->sort('Clave','cve'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Producto','tipoarticulo_id_0'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Material','tipoarticulo_id_1'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Servicio','tipoarticulo_id_2'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Otros','tipoarticulo_id_2'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','st'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','modified'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($colores) && !empty($colores)): ?>
		<?php foreach ($colores as $color):	?>
			<tr id="<?php echo $color['Color']['id'] ?>" class="t-row">
				<td class=""><?php echo $color['Color']['cve']; ?></td>
				<td class="cve"><?php echo $color['Color']['tipoarticulo_id_0']?'<i class="icon icon-ok"></i>':'&nbsp;'; ?></td>
				<td class="cve"><?php echo $color['Color']['tipoarticulo_id_1']?'<i class="icon icon-ok"></i>':'&nbsp;'; ?></td>
				<td class="cve"><?php echo $color['Color']['tipoarticulo_id_2']?'<i class="icon icon-ok"></i>':'&nbsp;'; ?></td>
				<td class="cve"><?php echo $color['Color']['tipoarticulo_id_3']?'<i class="icon icon-ok"></i>':'&nbsp;'; ?></td>
				<td class="st"><?php echo $color['Color']['st']; ?></td>
				<td class="datetime"><?php echo $color['Color']['modified']; ?></td>
				<td class="id"><?php echo $color['Color']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,
'MyModel'=>'Color','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>