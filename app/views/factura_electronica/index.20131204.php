<div class="span12 index-form">

<div id="gridWrapper">
<?php 
echo $form->create('Factura',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('farefer', array('label' => '', 'type' => 'search', 'maxLength' => '8', 'placeholder' => 'Folio...', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('fafecha',array('label' => '', 'type' => 'search', 'maxLength' => '10', 'placeholder' => 'Fecha...', 'class' => 'search-query'));?></th>
				<th class="refer"><?php echo $form->text('fapedido',array('label' => '', 'type' => 'search', 'maxLength' => '8', 'placeholder' => 'Pedido...', 'class' => 'search-query'));?></th>
				<th class="cvecli"><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Cliente...', 'class' => 'search-query'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Tda...', 'class' => 'search-query'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Vend...', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('fatotal',array('label' => '', 'type' => 'search', 'maxLength' => '14', 'placeholder' => 'Total...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('fast',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST...', 'class' => 'search-query'));?></th>
				<th class="id"><?php echo $form->text('id',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ID...', 'class' => 'search-query'));?></th>	
				<th class="">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-small')); ?>
				</th>
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','farefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','fafecha'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Pedido','fapedido'); ?></th>
				<th class="cvecli"><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','fatotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','fast'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
				<th class="">SAT</th>
			</tr>
		</thead>
		<tbody>
			<tr data-ng-repeat="item in items">
				<td class="refer">{{item.Factura.farefer}}</td>
				<td class="date">{{item.Factura.fafecha}}</td>
				<td class="refer">{{item.Factura.fapedido}}</td>
				<td class="cvecli" title="{{item.Cliente.clnom}}">{{item.Cliente.clcvecli}}</td>
				<td class="tda" title="{{item.Cliente.clsuc}}">{{item.Cliente.cltda}}</td>
				<td class="cveven" title="{{item.Vendedor.venom}}">{{item.Vendedor.vecveven}}</td>
				<td class="total">{{item.Factura.factura__fatotal | currency}}</td>
				<td class="st">{{item.Factura.fast}}</td>
				<td class="id" title="Creado: {{item.Factura.created}} Modificado: {{item.Factura.modified}}">{{item.Factura.id}}</td>
				<td class="">
					<div class="btn-group">
						<button type="button" class="btn btn-primary btn-small" title="Timbrar el CFDI. A traves del Webservice proporcionado por el PAC"
						data-ng-click="timbraXML( item.Factura.id )"><i class="icon icon-qrcode icon-white"></i> Timbra</button>
						<button type="button" class="btn btn-warning btn-small" title="Descargar el archivo XML CFDI"
						data-ng-click="downloadXML( item.Factura.id )"><i class="icon icon-list icon-white"></i> XML</button>
						<button type="button" class="btn btn-danger btn-small" title="Descargar el archivo PDF CFDI"
						data-ng-click="downloadPDF( item.Factura.id )"><i class="icon icon-book icon-white"></i> PDF</button>
						<button type="button" class="btn btn-info btn-small" title="Enviar por EMail el XML y PDF"
						data-ng-click="shareCFDI( item.Factura.id )"><i class="icon icon-book icon-white"></i> Mail</button>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
<ul data-ng-repeat="item in items">
	<li>Aca {{$index}}:: {{item|json}}</li>
</ul>
{{items|json}}
<?php //echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Factura','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->


<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

	$scope.timbraXML = function(id) {
		window.open( '/FacturaElectronica/generaxml/'+id, '_blank');
	}

	$scope.downloadXML = function(id) {
		window.open( '/FacturaElectronica/download/'+id+'/xml',	'_blank');
	}

	$scope.downloadPDF = function(id) {
		window.open( '/FacturaElectronica/download/'+id+'/pdf',	'_blank');
	}

	$scope.shareCFDI = function(id) {
		window.open( '/FacturaElectronica/sharecfdi.json/'+id,	'_blank');
	}


/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>

<?php /* echo $this->Html->Image('icons/documents/pdf-blue.png',array(
																		'url'=>array(
																					'controller'=>'FacturaElectronica',
																					'action'=>'download',
																					$item['Factura']['id'],
																					'pdf',
																					),
																		'alt'=>'PDF',
																		'class'=>'tableactionicon'
																		)
																		);
							*/				?>

<?php /*echo $this->Html->Image('icons/documents/xml-blue.png',array(
																		'url'=>array(
																					'controller'=>'FacturaElectronica',
																					'action'=>'download',
																					$item['Factura']['id'],
																					'xml',
																					),
																		'alt'=>'XML',
																		'class'=>'tableactionicon'
																		)
																		);
		*/									?>