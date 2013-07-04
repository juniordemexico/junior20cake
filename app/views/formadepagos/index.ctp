<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Formadepago',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="cve"><?php echo $form->text('Formadepago.cve',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Clave...', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Formadepago.descrip',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Descripción...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Formadepago.visible',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Visible...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Formadepago.st',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('Formadepago.created',array('label' => false, 'type' => 'search', 'placeholder'=>'Creado...', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('Formadepago.modified',array('label' => false, 'type' => 'search', 'placeholder'=>'Modificado...', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="cve"><?php echo $this->Paginator->sort('Clave','Formadepago.cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Descripción','Formadepago.descrip'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('Visible','Formadepago.visible'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Formadepago.st'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Creado','Formadepago.created'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Modificado','Formadepago.modified'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Formadepago']['id'];?>" class="t-row">
				<td class="refer"><?php echo $item['Formadepago']['cve']; ?></td>
				<td class=""><?php echo $item['Formadepago']['descrip'];?></td>
				<td class="st"><?php echo $item['Formadepago']['visible']; ?></td>
				<td class="st"><?php echo $item['Formadepago']['st']; ?></td>
				<td class="datetime"><?php echo $item['Formadepago']['created']; ?></td>
				<td class="datetime"><?php echo $item['Formadepago']['modified']; ?></td>
				<td class="id">
					<span title="Creado: <?php echo $item['Formadepago']['created']; ?>  Modificado: <?php echo $item['Formadepago']['modified']; ?>  T:<?php echo $item['Formadepago']['st']; ?>"
					data-ui-jq="tooltip" data-ui-jq-options="{placement:'left'}">
					<?php echo $item['Formadepago']['id']; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name, 'MyModel'=>'Formadepago', 'MyRowClickAction' => 'edit')); ?>

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
