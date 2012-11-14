<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Talla', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr class="row-filter">
				<th class=""><?php echo $form->text('tadescrip', array('id'=>'tadescrip', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat0',array('id'=>'tat0','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat1',array('id'=>'tat1','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat2',array('id'=>'tat2','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat3',array('id'=>'tat3','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat4',array('id'=>'tat4','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat5',array('id'=>'tat5','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat6',array('id'=>'tat6','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat7',array('id'=>'tat7','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat8',array('id'=>'tat8','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="col1"><?php echo $form->text('tat9',array('id'=>'tat9','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('st',array('id'=>'st','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('modified',array('id'=>'modified','label' => false, 'type' => 'search', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class=""><?php echo $this->Paginator->sort('Clave','tadescrip'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat0'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat1'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat2'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat3'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat4'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat5'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat6'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat7'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat8'); ?></th>
				<th class="col1"><?php echo $this->Paginator->sort('T0','tat9'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','st'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','modified'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($tallas as $item):
			$class = null;
			$thisID=trim($item['Talla']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class=""><?php echo $item['Talla']['tadescrip']; ?></td>
				<td class="col1"><?php echo $item['Talla']['tat0'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat1'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat2'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat3'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat4'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat5'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat6'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat7'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat8'];?></td>
				<td class="col1"><?php echo $item['Talla']['tat9'];?></td>
				<td class="st"><?php echo $item['Talla']['st'];?></td>
				<td class="datetime"><?php echo $item['Talla']['modified']; ?></td>
				<td class="id"><?php echo $item['Talla']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Talla','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>