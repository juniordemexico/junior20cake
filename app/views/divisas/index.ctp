<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Divisa', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr class="row-filter">
				<th class="cve"><?php echo $form->text('dicve', array('id'=>'dicve', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('dinom',array('id'=>'dinom','label' => false, 'type' => 'search', 'placeholder'=>'Nombre de la Divisa', 'class' => 'search-query'));?></th>
				<th class="precio"><?php echo $form->text('ditcambio',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Cotizacion', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('modified',array('label' => false, 'type' => 'search', 'placeholder'=>'Modificado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>
			</tr>
			<tr class="row-labels">
				<th class="cve"><?php echo $this->Paginator->sort('Clave','dicve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Descripción','dinom'); ?></th>
				<th class="precio"><?php echo $this->Paginator->sort('Cotizacion','ditcambio'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','modified'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		pr($divisas);
		foreach ($divisas as $item):
			$thisID=trim($item['Divisa']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cve"><?php echo $item['Divisa']['dicve']; ?></td>
				<td class=""><?php echo $item['Divisa']['dinom'];?></td>
				<td class="precio"><?php echo $item['Divisa']['ditcambio']; ?></td>
				<td class="datetime"><?php echo $item['Divisa']['modified']; ?></td>
				<td class="id"><?php echo $item['Divisa']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Divisa','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>