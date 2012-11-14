<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Unidades', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr class="row-filter">
				<th class="cve"><?php echo $form->text('cve', array('id'=>'cve', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('nom',array('id'=>'nom','label' => false, 'type' => 'search', 'placeholder'=>'Descripción', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cve"><?php echo $this->Paginator->sort('Clave','cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Nombre','nom'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($unidades as $item):
			$class = null;
			$thisID=trim($item['Unidad']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cve"><?php echo $item['Unidad']['cve']; ?></td>
				<td class=""><?php echo $item['Unidad']['nom'];?></td>
				<td class="id"><?php echo $item['Unidad']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Unidad','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>