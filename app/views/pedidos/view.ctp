<header>
<div class="page-header">
<h1><small>Pedido <strong class="text-info">{{data.Master.perefer}}</strong></small></h1>
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
		<label for="PedidoRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<em><strong>{{data.Master.perefer}}</strong></em>
		</div>
	</div>

	<div class="control-group">
		<label for="PedidoFecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<em><strong>{{data.Master.pefecha}}</strong></em>
		</div>
	</div>

	<div class="control-group">
		<label for="PedidoFvence" class="control-label">Vencimiento:</label>
		<div class="controls input">
			<em><strong>{{data.Master.pefvence}}</strong></em>
		</div>
	</div>

	<div class="control-group">
		<label for="PedidoVendedor_id" class="control-label">Vendedor:</label>
		<div class="controls input">
			<em><strong>({{data.Vendedor.vecveven}})</strong> <span class="text-info">{{data.Vendedor.venom}}</span></em>
		</div>
	</div>

	<div class="control-group">
		<label for="PedidoCliente_id" class="control-label">Cliente:</label>
		<div class="controls input">
			<em><strong>(cve: {{data.Cliente.clcvecli}}<span data-ng-hide="data.Cliente.cltda=='    ' || data.Cliente.cltda==''"> tda: {{data.Cliente.cltda}}</span>)</strong>  <span class="text-info">{{data.Cliente.clnom}}</span></em>
		</div>
	</div>

	</div> <!-- div.span6 -->

	<div class="span1">&nbsp;</div>

	<div class="span5">

	<div class="control-group">
		<label for="PedidoSuma" class="control-label">Suma:</label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.pesuma | currency}}</strong>
		</div>
	</div>
	<div class="control-group">
		<label for="PedidoImporte" class="control-label">Importe:</label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.pedido__peimporte | currency}}</strong>
		</div>
	</div>
	<div class="control-group">
		<label for="PedidoImpoimpu" class="control-label">Impuesto:</label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.pedido__peimpoimpu | currency}}</strong>
		</div>
	</div>
	<div class="control-group">
		<label for="PedidoTotal" class="control-label"><strong>Total:</strong></label>
		<div class="controls input">
			<strong class="span2 text-right">{{data.Master.pedido__petotal | currency}}</strong>
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
				<td class="st text-right" title="Talla {{i.Talla.tat0}}">{{toInteger(i.Detail.pedpt0)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat1}}">{{toInteger(i.Detail.pedpt1)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat2}}">{{toInteger(i.Detail.pedpt2)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat3}}">{{toInteger(i.Detail.pedpt3)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat4}}">{{toInteger(i.Detail.pedpt4)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat5}}">{{toInteger(i.Detail.pedpt5)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat6}}">{{toInteger(i.Detail.pedpt6)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat7}}">{{toInteger(i.Detail.pedpt7)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat8}}">{{toInteger(i.Detail.pedpt8)}}</td>
				<td class="st text-right" title="Talla {{i.Talla.tat9}}">{{toInteger(i.Detail.pedpt9)}}</td>
				<td class="span1 text-right">{{toInteger(i.Detail.pedpedido)}}</td>
				<td class="precio text-right">{{i.Detail.pedprecio | currency}}</td>
				<td class="total text-right">{{i.Detail.pedimporte | currency}}</td>
			</tr>
			</tbody>
		</table>
		</div>
	</div>

</pane>

<pane id="tabs-4" heading="Datos adicionales">
<div class="control-group">
	<label for="PedidoObser" class="control-label">Observaciones</label>
	<div class="controls input">
		<textarea name="data[Pedido][peobser]" field="data.Master.peobser" maxlength="255"
				class="span4" cols="30" rows="6" id="PedidoPeobser"
				data-ng-model="data.Master.peobser"
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
				$http.get( '/Pedidos/cancel/'+$scope.data.Master.id+'.json'
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
