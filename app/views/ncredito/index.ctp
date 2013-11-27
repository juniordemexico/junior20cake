<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								'limit' => 15,
								));
?>

<div id="gridWrapper">
<?php 
echo $form->create('Ncredito', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>

	<table id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('ncrefer', array('label' => '', 'type' => 'search', 'maxLength' => '8', 'placeholder' => 'Folio...', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('ncfecha',array('label' => '', 'type' => 'search', 'maxLength' => '10', 'placeholder' => 'Fecha...', 'class' => 'search-query'));?></th>
				<th class="refer"><?php echo $form->text('ncdevol',array('label' => '', 'type' => 'search', 'maxLength' => '8', 'placeholder' => 'Devol...', 'class' => 'search-query'));?></th>
				<th class="cvecli"><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Cliente...', 'class' => 'search-query'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Tda...', 'class' => 'search-query'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven',array('label' => '', 'type' => 'search', 'maxLength' => '4', 'placeholder' => 'Vend...', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('nctotal',array('label' => '', 'type' => 'search', 'maxLength' => '14', 'placeholder' => 'Total...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('ncst',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST...', 'class' => 'search-query'));?></th>
				<th class="id"><?php echo $form->text('id',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ID...', 'class' => 'search-query'));?></th>	
				<th class="">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-small')); ?>
				</th>
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','ncrefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','ncfecha'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Devol','ncdevol'); ?></th>
				<th class="cvecli"><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','nctotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','ncst'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
				<th class="">SAT</th>
			</tr>
		</thead>
		<tbody>
			<tr data-ng-repeat="item in items" id="row_{{item.0.id}}">
				<td class="refer">{{item.0.ncrefer}}</td>
				<td class="date">{{item.0.ncfecha}}</td>
				<td class="refer">{{item.0.ncdevol}}</td>
				<td class="cvecli" title="{{item.Cliente.clnom}}">{{item.Cliente.clcvecli}}</td>
				<td class="tda" title="{{item.Cliente.clsuc}}">{{item.Cliente.cltda}}</td>
				<td class="cveven" title="{{item.Vendedor.venom}}">{{item.Vendedor.vecveven}}</td>
				<td class="total">{{item.0.ncsuma | currency}}</td>
				<td class="st">{{item.0.ncst}}</td>
				<td class="id" title="Creado: {{item.0.created}} Modificado: {{item.0.modified}}">{{item.0.id}}</td>
				<td class="">
					<div class="btn-group">
						<button type="button" class="btn btn-info btn-small" title="Generar el XML para CFDI"
						data-ng-click="generaXML( item.0.id )"><i class="icon icon-list icon-white"></i> CFDI</button>
						<button type="button" class="btn btn-primary btn-small" title="Timbrar el CFDI. A traves del Webservice proporcionado por el PAC"
						data-ng-click="timbraXML( item.0.id )"><i class="icon icon-qrcode icon-white"></i> Timbra</button>
						<button type="button" class="btn btn-warning btn-small" title="Descargar el archivo XML CFDI"
						data-ng-click="downloadXML( item.0.id )"><i class="icon icon-list icon-white"></i> XML</button>
						<button type="button" class="btn btn-danger btn-small" title="Descargar el archivo PDF CFDI"
						data-ng-click="downloadPDF( item.0.id )"><i class="icon icon-book icon-white"></i> PDF</button>
					</div>

					<a class="btn btn-primary btn-small" data-toggle="modal" href="/Ncredito/generaxml/1111" data-target="#myModal"><i class="icon icon-qrcode icon-white"></i></a>
				</td>
			</tr>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>

<?php //echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'NCredito','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="myModalLabel"><strong>Comprobante Digital CFDI</strong> <small><strong>Generación y Timbrado de XML v3.2</strong></small></h3>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>


	$scope.generaXML = function(id) {
		window.open( '/Ncredito/generaxml/'+id, '_blank');
	}

	$scope.timbraXML = function(id) {
		window.open( '/Ncredito/generaxml/'+id, '_blank');
	}

	$scope.downloadXML = function(id) {
		window.open( '/Ncredito/download/'+id+'/xml',	'_blank');
	}

	$scope.downloadPDF = function(id) {
		window.open( '/Ncredito/download/'+id+'/pdf',	'_blank');
	}


/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
