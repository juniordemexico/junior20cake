<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Entsal',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="refer"><?php echo $form->text('Entsal.esrefer', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Folio...', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Entsal.esfecha',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Fecha...', 'class' => 'search-query'));?></th>
				<th class="id"><?php echo $form->text('Entsal.estmov',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'T Mov...', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Entsal.esconcep',array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Concepto...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Entsal.esst',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('Entsal.crefec',array('label' => false, 'type' => 'search', 'placeholder'=>'Creado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="refer"><?php echo $this->Paginator->sort('Folio','Entsal.esrefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','Entsal.esfecha'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('T Mov','Entsal.estmov'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Concepto','Entsal.esconcep'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Entsal.esst'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','Entsal.crefec'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Entsal']['id'];?>" class="t-row">
				<td class="refer"><?php echo $item['Entsal']['esrefer']; ?></td>
				<td class="date"><?php echo substr($item['Entsal']['esfecha'],0,10);?></td>
				<td class="id"><?php echo $item['Entsal']['estmov']; ?></td>
				<td class=""><?php echo $item['Entsal']['esconcep']; ?></td>
				<td class="st"><?php echo $item['Entsal']['esst']; ?></td>
				<td class="datetime"><?php echo $item['Entsal']['crefec']; ?></td>
				<td class="id" title="Creado: <?php echo $item['Entsal']['crefec']; ?>  Modificado: <?php echo $item['Entsal']['modfec']; ?>  T:<?php echo $item['Entsal']['est']; ?>">
					<?php echo $item['Entsal']['id']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name, 'MyModel'=>'Entsal', 'MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".
$this->Html->url(array('action'=>(isset($clickAction)?$clickAction:'edit'))).
"/'+this.id);"
, array('stop' => true));
?>
