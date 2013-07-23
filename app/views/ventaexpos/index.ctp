<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Ventaexpo',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="refer"><?php echo $form->text('Ventaexpo.folio', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Folio...', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Ventaexpo.fecha',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Fecha...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Vendedor.vecveven',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Vendedor...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Cliente.clcvecli',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Cliente...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Cliente.cltda',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Tda...', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Cliente.clnom',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Razón Social...', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('Ventaexpo.total',array('label' => '', 'type' => 'search', 'maxLength' => '14', 'placeholder' => 'Total', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Ventaexpo.st',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('Ventaexpo.created',array('label' => false, 'type' => 'search', 'placeholder'=>'Creado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="refer"><?php echo $this->Paginator->sort('Folio','Ventaexpo.folio'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','Ventaexpo.fecha'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razón Social','Cliente.clnom'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','Ventaexpo.total'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Ventaexpo.st'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Creado','Ventaexpo.created'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Ventaexpo']['id'];?>" class="t-row">
				<td class="refer"><?php echo $item['Ventaexpo']['folio']; ?></td>
				<td class="date"><?php echo substr($item['Ventaexpo']['fecha'],0,10);?></td>
				<td class="st"><?php echo $item['Vendedor']['vecveven']; ?></td>
				<td class="st"><?php echo $item['Cliente']['clcvecli']; ?></td>
				<td class="st"><?php echo $item['Cliente']['cltda']; ?></td>
				<td class=""><?php echo $item['Cliente']['clnom']; ?></td>
				<td class="total text-right"><?php echo $this->Number->currency($item['Ventaexpo']['total']); ?></td>
				<td class="st"><?php echo $item['Ventaexpo']['st']; ?></td>
				<td class="datetime"><?php echo $item['Ventaexpo']['created']; ?></td>
				<td class="id">
					<span title="Creado: <?php echo $item['Ventaexpo']['created']; ?>  Modificado: <?php echo $item['Ventaexpo']['modified']; ?>  T:<?php echo $item['Ventaexpo']['st']; ?>"
					data-ui-jq="tooltip" data-ui-jq-options="{placement:'left'}">
					<?php echo $item['Ventaexpo']['id']; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name, 'MyModel'=>'Ventaexpo', 'MyRowClickAction' => 'edit')); ?>

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
