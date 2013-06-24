<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Ordencompra',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="refer"><?php echo $form->text('Ordencompra.folio', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Folio...', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Ordencompra.fecha',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Fecha...', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->text('Proveedor.prvepro',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Proveedor...', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Proveedor.prnom',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Razón Social...', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->text('Ordencompra.proveedor_refer',array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Prov Refer...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Ordencompra.st',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('Ordencompra.created',array('label' => false, 'type' => 'search', 'placeholder'=>'Creado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="refer"><?php echo $this->Paginator->sort('Folio','Ordencompra.folio'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','Ordencompra.fecha'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Prov','Proveedor.prcvepro'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razón Social','Proveedor.prnom'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Refer Prov','Ordencompra.proveedor_refer'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Ordencompra.st'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Creado','Ordencompra.created'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Ordencompra']['id'];?>" class="t-row">
				<td class="refer"><?php echo $item['Ordencompra']['folio']; ?></td>
				<td class="date"><?php echo substr($item['Ordencompra']['fecha'],0,10);?></td>
				<td class="cve"><?php echo $item['Proveedor']['prcvepro']; ?></td>
				<td class=""><?php echo $item['Proveedor']['prnom']; ?></td>
				<td class="cve"><?php echo $item['Ordencompra']['proveedor_refer'];?></td>
				<td class="st"><?php echo $item['Ordencompra']['st']; ?></td>
				<td class="datetime"><?php echo $item['Ordencompra']['created']; ?></td>
				<td class="id">
					<span title="Creado: <?php echo $item['Ordencompra']['created']; ?>  Modificado: <?php echo $item['Ordencompra']['modified']; ?>  T:<?php echo $item['Ordencompra']['st']; ?>"
					data-ui-jq="tooltip" data-ui-jq-options="{placement:'left'}">
					<?php echo $item['Ordencompra']['id']; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name, 'MyModel'=>'Ordencompra', 'MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php
echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".
$this->Html->url(array('action'=>(isset($clickAction)?$clickAction:'edit'))).
"/'+this.id);"
, array('stop' => true));
?>

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
