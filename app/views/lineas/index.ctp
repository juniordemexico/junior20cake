<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Linea', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr class="row-filter">
				<th class="cve"><?php echo $form->text('cve', array('id'=>'licve', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave'));?></th>
				<th class=""><?php echo $form->text('descrip',array('id'=>'descrip','label' => false, 'type' => 'search', 'placeholder'=>'Descripción'));?></th>
				<th class="tipoarticulo"><?php echo $form->text('Tipoarticulo.cve',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Tipo'));?></th>
				<th class="datetime"><?php echo $form->text('modified',array('label' => false, 'type' => 'search', 'placeholder'=>'Modificado'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>
			</tr>
			<tr class="row-labels">
				<th class="cve"><?php echo $this->Paginator->sort('Clave','licve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Descripción','descrip'); ?></th>
				<th class="tipoarticulo"><?php echo $this->Paginator->sort('Tipo','Tipoarticulo.cve'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','modified'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($lineas as $item):
			$class = null;
			$thisID=trim($item['Linea']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cve"><?php echo $item['Linea']['licve']; ?></td>
				<td class=""><?php echo $item['Linea']['descrip'];?></td>
				<td class="tipoarticulo"><?php echo $item['Tipoarticulo']['cve']; ?></td>
				<td class="datetime"><?php echo $item['Linea']['modified']; ?></td>
				<td class="id"><?php echo $item['Linea']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Linea','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>