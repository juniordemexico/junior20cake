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
				<th class=""><?php echo $form->text('descrip', array('label' => false, 'type' => 'search', 'placeholder'=>'Desripcion...', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->text('Tipoequipo.cve',array('label' => false, 'type' => 'search', 'placeholder'=>'Tipo de equipo...', 'class' => 'search-query'));?></th>
				<th class="col3"><?php echo $form->text('numeroserie',array('type' => 'search', 'placeholder'=>'Num Serie', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->text('Group.cve',array('label' => false, 'type' => 'search', 'placeholder'=>'Depto...', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->text('Users.username',array('label' => false, 'type' => 'search', 'placeholder'=>'Usuario...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('st',array('type' => 'search', 'placeholder'=>'ST', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class=""><?php echo $this->Paginator->sort('Descripción','descrip'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Tipo de Equipo','Tipoequipo.cve'); ?></th>
				<th class="col3"><?php echo $this->Paginator->sort('Numéro Serie','numeroserie'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Depto','Group.cve'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Usuario','User.username'); ?></th>
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
			$thisID=trim($item['Equipo']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class=""><?php echo $item['Equipo']['descrip']; ?></td>
				<td class="cve"><?php echo $item['Tipoequipo']['cve']; ?></td>
				<td class="col3"><?php echo $item['Equipo']['numeroserie']; ?></td>
				<td class="cve"><?php echo $item['Group']['cve']; ?></td>
				<td class="cve"><?php echo $item['User']['username']; ?></td>
				<td class="st"><?php echo $item['Equipo']['st']; ?></td>
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
