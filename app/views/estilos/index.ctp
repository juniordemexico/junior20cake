<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Estilo', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cveart"><?php echo $form->text('cve', array('id'=>'cve', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('descrip',array('id'=>'descrip','label' => false, 'type' => 'search', 'placeholder'=>'Descripción', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('modified',array('label' => false, 'type' => 'search', 'placeholder'=>'Fecha', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('st',array('label' => false, 'type' => 'search', 'placeholder'=>'ST', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cveart"><?php echo $this->Paginator->sort('Clave','cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Descrición','descrip'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','modified'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','st'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $item):
			$class = null;
			$thisID=trim($item['Estilo']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cveart"><?php echo $item['Estilo']['cve']; ?></td>
				<td class=""><?php echo $item['Estilo']['descrip'];?></td>
				<td class="datetime"><?php echo $item['Estilo']['modified'];?></td>
				<td class="st"><?php echo $item['Estilo']['st']; ?></td>
				<td class="id"><?php echo $item['Estilo']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Estilo','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>
<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
