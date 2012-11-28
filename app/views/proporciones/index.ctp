<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Proporcion', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class=""><?php echo $form->text('cve', array('id'=>'cve', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t0',array('id'=>'t0','label' => false, 'type' => 'search', 'placeholder'=>'T0', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t1',array('id'=>'t1','label' => false, 'type' => 'search', 'placeholder'=>'T1', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t2',array('id'=>'t2','label' => false, 'type' => 'search', 'placeholder'=>'T2', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t3',array('id'=>'t3','label' => false, 'type' => 'search', 'placeholder'=>'T3', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t4',array('id'=>'t4','label' => false, 'type' => 'search', 'placeholder'=>'T4', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t5',array('id'=>'t5','label' => false, 'type' => 'search', 'placeholder'=>'T5', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t6',array('id'=>'t6','label' => false, 'type' => 'search', 'placeholder'=>'T6', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t7',array('id'=>'t7','label' => false, 'type' => 'search', 'placeholder'=>'T7', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t8',array('id'=>'t8','label' => false, 'type' => 'search', 'placeholder'=>'T8', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('t9',array('id'=>'t9','label' => false, 'type' => 'search', 'placeholder'=>'T9', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('modified',array('label' => false, 'type' => 'search', 'placeholder'=>'Fecha', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class=""><?php echo $this->Paginator->sort('Clave','cve'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','t0'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T1','t1'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T2','t2'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T3','t3'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T4','t4'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T5','t5'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T6','t6'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T7','t7'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T8','t8'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T9','t9'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','modified'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($proporciones as $item):
			$class = null;
			$thisID=trim($item['Proporcion']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class=""><?php echo $item['Proporcion']['cve']; ?></td>
				<td class="col1"><?php echo $item['Proporcion']['t0'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t1'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t2'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t3'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t4'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t5'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t6'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t7'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t8'];?></td>
				<td class="col1"><?php echo $item['Proporcion']['t9'];?></td>
				<td class="datetime"><?php echo $item['Proporcion']['modified'];?></td>
				<td class="id"><?php echo $item['Proporcion']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Proporcion','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>