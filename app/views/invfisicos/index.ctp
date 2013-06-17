<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Invfisico', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cve"><?php echo $form->text('cve', array('id'=>'cve', 'label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('fecha',array('id'=>'fecha','label' => false, 'type' => 'search', 'placeholder'=>'Fecha', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('Almacen.aldescrip',array('id'=>'Almacen.aldescrip','label' => false, 'type' => 'search', 'placeholder'=>'Almacén', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('finicio',array('id'=>'finicio','label' => false, 'type' => 'search', 'placeholder'=>'F Inicio', 'class' => 'search-query'));?></th>
				<th class="span1"><?php echo $form->text('ftermino',array('id'=>'ftermino','label' => false, 'type' => 'search', 'placeholder'=>'F Termino', 'class' => 'search-query'));?></th>
				<th class="span2"><?php echo $form->text('st',array('id'=>'st','label' => false, 'type' => 'search', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cve"><?php echo $this->Paginator->sort('Descripción','cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Fecha','fecha'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Almacen','Almacen.alcve'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Inicio','finicio'); ?></th>
				<th class="span1"><?php echo $this->Paginator->sort('Termino','ftermino'); ?></th>
				<th class="span2"><?php echo $this->Paginator->sort('ST', 'st'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $item):
			$class = null;
			$thisID=trim($item['Invfisico']['id']);
		?>
			<tr id="<?php echo $item['Invfisico']['id'];?>" class="t-row">
				<td class="cve"><?php echo $item['Invfisico']['cve']; ?></td>
				<td class=""><?php echo $item['Invfisico']['fecha'];?></td>
				<td class="span1"><?php echo $item['Almacen']['aldescrip'];?></td>
				<td class="span1"><?php echo $item['Invfisico']['finicio'];?></td>
				<td class="span1"><?php echo $item['Invfisico']['ftermino'];?></td>
				<td class="span2"><?php echo $item['Invfisico']['st'];?></td>
				<td class="id"><?php echo $item['Invfisico']['id'];?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Invfisico','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>
<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
