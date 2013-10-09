<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Equipo', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class=""><?php echo $form->text('descrip', array('label' => false, 'type' => 'search', 'placeholder'=>'Clave', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Tipoequipo.cve',array('label' => false, 'type' => 'search', 'placeholder'=>'ST', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('st',array('type' => 'search', 'placeholder'=>'ST', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('modified',array('label' => false, 'type' => 'search', 'placeholder'=>'Modificado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class=""><?php echo $this->Paginator->sort('Descripción','descrip'); ?></th>
				<th class="col2"><?php echo $this->Paginator->sort('Tipo','Tipoequipo.cve'); ?></th>
				<th class="col3"><?php echo $this->Paginator->sort('Numéro Serie','numeroserie'); ?></th>
				<th class="col3"><?php echo $this->Paginator->sort('Depto','Group.cveeroserie'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','modified'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($items as $item):
			$class = null;
			$thisID=trim($item['Equipo']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class=""><?php echo $item['Equipo']['cve']; ?></td>
				<td class="st"><?php echo $item['Equipo']['visible']; ?></td>
				<td class="st"><?php echo $item['Equipo']['st']; ?></td>
				<td class="datetime" title="<?php echo 'Creado:'.$item['Equipo']['created'];?>"><?php echo $item['Equipo']['modified'];?></td>
				<td class="id"><?php echo $item['Equipo']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Equipo','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>
<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
