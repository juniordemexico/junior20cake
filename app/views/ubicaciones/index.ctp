<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Ubicacion', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cve"><?php echo $form->text('cve', array('id'=>'cve', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('descrip',array('id'=>'descrip','label' => false, 'type' => 'search', 'placeholder'=>'Descripción', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('zona',array('id'=>'zona','label' => false, 'type' => 'search', 'placeholder'=>'A', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('fila',array('id'=>'fila','label' => false, 'type' => 'search', 'placeholder'=>'99', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('espacio',array('id'=>'espacio','label' => false, 'type' => 'search', 'placeholder'=>'9999', 'class' => 'search-query'));?></th>
				<th class="span2"><?php echo $form->text('Almacen.aldescrip',array('id'=>'aldescrip','label' => false, 'type' => 'search', 'placeholder'=>'Descripción', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cve"><?php echo $this->Paginator->sort('Ubicación','cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Descripción','descrip'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Zona','zona'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Fila','fila'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Espacio','espacio'); ?></th>
				<th class="span2"><?php echo $this->Paginator->sort('Almacén', 'Almacen.aldescrip'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $item):
			$class = null;
			$thisID=trim($item['Ubicacion']['id']);
		?>
			<tr id="<?php echo $item['Ubicacion']['id'];?>" class="t-row">
				<td class="cve"><?php echo $item['Ubicacion']['cve']; ?></td>
				<td class=""><?php echo $item['Ubicacion']['descrip'];?></td>
				<td class="span1"><?php echo $item['Ubicacion']['zona'];?></td>
				<td class="span1"><?php echo $item['Ubicacion']['fila'];?></td>
				<td class="span1"><?php echo $item['Ubicacion']['espacio'];?></td>
				<td class="span2"><?php echo $item['Almacen']['aldescrip'];?></td>
				<td class="id"><?php echo $item['Ubicacion']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Ubicacion','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>
<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
