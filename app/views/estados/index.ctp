<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Estados', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class=""><?php echo $form->text('Estado.esedo',array('label' => '', 'type' => 'search', 'placeholder' => 'Estado', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->text('Pais.papais',array('label' => '', 'type' => 'search', 'placeholder' => 'Pais', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class=""><?php echo $this->Paginator->sort('Clave','Estado.esedo'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Pais','Pais.papais'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		foreach ($estados as $item):
			$thisID=trim($item['Estado']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cve"><?php echo $item['Estado']['esedo']; ?></td>
				<td class=""><?php echo $item['Pais']['papais'];?></td>
				<td class="id"><?php echo $item['Estado']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Estado','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>