<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Compra',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="refer"><?php echo $form->text('Compra.folio', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Folio...', 'class' => 'search-query'));?></th>
				<th class="refer"><?php echo $form->text('Compra.proveedor_refer', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Prov Refer...', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Compra.fecha',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Fecha...', 'class' => 'search-query'));?></th>
				<th class="cve"><?php echo $form->text('Proveedor.prvepro',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Proveedor...', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Proveedor.prnom',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Razón Social...', 'class' => 'search-query'));?></th>
				<th class="refer"><?php echo $form->text('Compra.proveedor_refer',array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Prov Refer...', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('Compra.total',array('label' => false, 'type' => 'search', 'maxLength' => '14', 'placeholder'=>'Total...', 'class' => 'search-query'));?></th>
				<th class="fecha"><?php echo $form->text('Compra.fautorizacxp',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'Fecha CxP...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Compra.st',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="refer"><?php echo $this->Paginator->sort('Folio','Compra.folio'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Prov Refer','Compra.proveedor_refer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','Compra.fecha'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('Prov','Proveedor.prcvepro'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razón Social','Proveedor.prnom'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Refer Prov','Compra.proveedor_refer'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','Compra.total'); ?></th>
				<th class="fecha"><?php echo $this->Paginator->sort('CxP','Compra.fautorizacxp'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Compra.st'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Compra']['id'];?>" class="t-row">
				<td class="refer" data-ng-click="view(<?php echo $item['Compra']['id'];?>)"><?php echo $item['Compra']['folio']; ?></td>
				<td class="refer" data-ng-click="view(<?php echo $item['Compra']['id'];?>)"><?php echo $item['Compra']['proveedor_refer']; ?></td>
				<td class="date"><?php echo substr($item['Compra']['fecha'],0,10);?></td>
				<td class="cve"><?php echo $item['Proveedor']['prcvepro']; ?></td>
				<td class=""><?php echo $item['Proveedor']['prnom']; ?></td>
				<td class="refer"><?php echo $item['Compra']['proveedor_refer']; ?></td>
				<td class="total"><?php echo $this->Number->currency($item['Compra']['total']);?></td>
				<td class="fecha">
					<span data-ng-hide="item.Compra.fautorizacxp">
						<button type="button" class="btn btn-small"
							data-ng-click="autorizaCxP(<?php echo $item['Compra']['id'];?>,'<?php echo $item['Compra']['folio'];?>','<?php echo $item['Compra']['fecha'];?>')"						>
							<i class="icon icon-ok"></i>
						</button>
					</span>
					{{item.ArticuloProveedor.fautoriza}}
				</td>
				<td class="st"><?php echo $item['Compra']['st']; ?></td>
				<td class="id">
					<span title="Creado: <?php echo $item['Compra']['created']; ?>  Modificado: <?php echo $item['Compra']['modified']; ?>  T:<?php echo $item['Compra']['st']; ?> Orderncompra_id: <?php echo $item['Compra']['ordencompra_id'];?>"
					data-ui-jq="tooltip" data-ui-jq-options="{placement:'left'}">
					<?php echo $item['Compra']['id']; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name, 'MyModel'=>'Compra', 'MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->


<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

	$scope.view = function(id) {
		location.replace('/Compras/edit/'+id);
	}
	
	$scope.autorizaCxP = function(id, folio, fecha) {
		var title = 'Confirmación';
		var msg = '¿ Generar la CxP de la Compra '+folio+' ('+fecha+')'+' ?';
		var btns = [{result:0, label: 'No'}, {result:1, label: 'OK', cssClass: 'btn-primary'}];
		$dialog.messageBox(title, msg, btns)
		.open()
		.then( function(result) {
			console.log('/Compras/autorizacxp?id='+id);
		$http.get('/Compras/autorizacxp?id='+id
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentItem.costo=response.data.item.Articulo.costo;
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
			}
       	});

		});
	}


/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
