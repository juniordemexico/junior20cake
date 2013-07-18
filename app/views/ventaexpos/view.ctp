<header>
<div class="page-header">
<h1><small>Pedido Expo <strong class="text-info">{{data.Master.folio}}</strong></small></h1>
</div>
</header>

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<button type="submit" class="btn btn-primary" data-ng-click="save()" data-ng-disabled="true" alt="Guardar">
		<i class="icon icon-ok-circle icon-white"></i> Guardar
		</button>

		<button type="submit" class="btn btn-primary" data-ng-click="cancel()" data-ng-disabled="!(data.Master.id>0) || data.Master.st=='C'" alt="Cancelar">
		<i class="icon icon-ok-circle icon-white"></i> Cancelar
		</button>
	</div>
	<div class="btn-group pull-right">	
		<button type="button" class="btn btn-primary" data-ng-click="print()" data-ng-disabled="!(data.Master.id>0)" title="Imprimir la transacción" alt="Imprimir">
		<i class="icon-print icon-white"></i>
		</button>
	</div>
</div>

<form class="form form-horizontal" id="formmaster" name="formMaster" method="post" accept-charset="utf-8">
<input type="hidden" name="_method" value="PUT" />

<!-- Form's Tabbed Divs -->
<tabs id="tabs">

<pane id="tabs-0" heading="General" class="well">

<div class="row">
	<div class="span6">
	<div class="control-group">
		<label for="VentaexpoRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<em><strong>{{data.Master.folio}}</strong></em>
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoFecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<em><strong>{{data.Master.fecha}}</strong></em>
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoFvence" class="control-label">Vencimiento:</label>
		<div class="controls input">
			<em><strong>{{data.Master.fvence}}</strong></em>
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoVendedor_id" class="control-label">Vendedor:</label>
		<div class="controls input">
			<em><strong>({{data.Vendedor.vecveven}})</strong> <span class="text-info">{{data.Vendedor.venom}}</span></em>
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoCliente_id" class="control-label">Cliente:</label>
		<div class="controls input">
			<em><strong>(cve: {{data.Cliente.clcvecli}}<span data-ng-hide="data.Cliente.cltda=='    ' || data.Cliente.cltda==''"> tda: {{data.Cliente.cltda}}</span>)</strong>  <span class="text-info">{{data.Cliente.clnom}}</span></em>
		</div>
	</div>

	</div> <!-- div.span6 -->

	<div class="span1">&nbsp;</div>


	<div class="span5">

	<div class="control-group">
		<label for="VentaexpoSuma" class="control-label">Suma:</label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.suma | currency}}</strong>
		</div>
	</div>
	<div class="control-group">
		<label for="VentaexpoImporte" class="control-label">Importe:</label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.importe | currency}}</strong>
		</div>
	</div>
	<div class="control-group">
		<label for="VentaexpoImpoimpu" class="control-label">Impuesto:</label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.impoimpu | currency}}</strong>
		</div>
	</div>
	<div class="control-group">
		<label for="VentaexpoTotal" class="control-label"><strong>Total:</strong></label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.total | currency}}</strong>
		</div>
	</div>

	</div> <!-- div.span5 -->

</div>

	<div class="row">
		<div class="span1">&nbsp;</div>
		<div class="span10">
		<table class="table table-condensed table-bordered table-hover ax-detail-table">
			<thead>
			<tr>
				<th class="">Producto</th>
				<th class="">Color</th>
				<th class="st">T0</th>
				<th class="st">T1</th>
				<th class="st">T2</th>
				<th class="st">T3</th>
				<th class="st">T4</th>
				<th class="st">T5</th>
				<th class="st">T6</th>
				<th class="st">T7</th>
				<th class="st">T8</th>
				<th class="st">T9</th>
				<th class="span1">Cant</th>
				<th class="precio">Precio</th>
				<th class="total">Importe</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="i in data.Details" data-detail-id="{{i.Detail.id}}" class="item-row">
				<td class="" title="{{i.Articulo.ardescrip}}">{{i.Articulo.arcveart}}</td>
				<td class="">{{i.Color.cve}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t0)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t1)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t2)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t3)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t4)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t5)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t6)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t7)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t8)}}</td>
				<td class="st text-right" title="Talla {{i.Tallas.tat0}}">{{toInteger(i.Detail.t9)}}</td>
				<td class="span1 text-right">{{i.Detail.cant}}</td>
				<td class="precio text-right">{{i.Detail.precio | currency}}</td>
				<td class="total text-right">{{i.Detail.importe | currency}}</td>
			</tr>
			</tbody>
		</table>
		</div>
	</div>

</pane>

<pane id="tabs-4" heading="Datos adicionales">
<div class="control-group">
	<label for="VentaexpoObser" class="control-label">Observaciones</label>
	<div class="controls input">
		<textarea name="data[Ventaexpo][obser]" field="data.Master.Obser" maxlength="255"
				class="span4" cols="30" rows="6" id="VentaexpoObser"
				data-ng-model="data.Master.obser"
				data-ng-minlength="0" data-ng-maxlength="255"
		>
		</textarea>
	</div>
</div>

</pane> <!-- pane#tabs4 -->

</tabs> <!-- div tabbable -->

</form>

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

	// Load Related Models
	$scope.loadRelatedModels();
	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "talla_id": 1, "t0":0, "cant":0, "precio":0};
	$scope.selectedItems=[];
	$scope.selectedCell={};
	$scope.selectedRow={};
    $scope.selectedColumn={};


	$scope.cancel = function() {
		var title = 'Confirmación';
		var msg = '¿ Seguro de Cancelar ?';
		var btns = [{result:0, label: 'Cancelar'}, {result:1, label: 'OK', cssClass: 'btn-primary'}];
		$dialog.messageBox(title, msg, btns)
		.open()
		.then( function(result) {
			if(result) {
				// Send the CANCEL request to the server
				$http.get( '/Ventaexpos/cancel/'+$scope.data.Master.id+'.json'
				).then(function(response) {
					// We got a response to process
					if(typeof response.data != 'undefined' && 
						typeof response.data.result != 'undefined') {
						if( typeof response.data.setFields != 'undefined' && angular.isObject(response.data.setFields) ) {
							$scope.data.Master.st='C';
						}
						axAlert(response.data.message, (response.data.result=='ok'?'success':'error'), false);						
						return;
					}
					axAlert('Error en la respuesta', 'error', false);						
				});
			}
		});
	}

    $scope.detailEdit = function (row, cell, column) {
		$scope.selectedCell = cell;
		$scope.selectedRow = row;
    	$scope.selectedColumn = column;
		row['cant']=
				((angular.isDefined(row['t0']) && row['t0']!='')?parseInt(row['t0'],10):0)+
				((angular.isDefined(row['t1']) && row['t1']!='')?parseInt(row['t1'],10):0)+
				((angular.isDefined(row['t2']) && row['t2']!='')?parseInt(row['t2'],10):0)+
				((angular.isDefined(row['t3']) && row['t3']!='')?parseInt(row['t3'],10):0)+
				((angular.isDefined(row['t4']) && row['t4']!='')?parseInt(row['t4'],10):0)+
				((angular.isDefined(row['t5']) && row['t5']!='')?parseInt(row['t5'],10):0)+
				((angular.isDefined(row['t6']) && row['t6']!='')?parseInt(row['t6'],10):0)+
				((angular.isDefined(row['t7']) && row['t7']!='')?parseInt(row['t7'],10):0)+
				((angular.isDefined(row['t8']) && row['t8']!='')?parseInt(row['t8'],10):0)+
				((angular.isDefined(row['t9']) && row['t9']!='')?parseInt(row['t9'],10):0);
		row['importe']=( parseFloat(row['cant']) * parseFloat(row['precio'])).toFixed(2);
		$scope.totalize();
	};
	
	// Binds and initializates a Twitter Bootstrap's Typeahead inside our AngularJS context
	$scope.fieldItem = {
		ajax: {
			url: "/Articulos/autocomplete/tipo:0",
      		data: function (term, page) {
        		return {keyword: term}; // query params go here
			},
			results: function (data, page) { // parse the results into the format expected by Select2.
        		return {results: data};
      		}
    	}
  	}

	$scope.toInteger = function (value) {
		if(angular.isDefined(value) && value!='') {
			return parseInt(value,10);
		}
		return value;
	}
	
/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
