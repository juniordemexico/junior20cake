<header>
<div class="page-header">
<h1><small>Venta Tienda <strong class="text-info">{{data.Master.folio}}</strong></small> <small class="text-info">( {{Cliente.clcvecli}} {{Cliente.cltda}} ) {{Cliente.clnom}}</small></h1>
</div>
</header>

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<button type="submit" class="btn btn-primary" data-ng-click="save()" data-ng-disabled="(formMaster.$pristine || !formMaster.$valid) || data.Master.id>0 || !data.Details.length>0" alt="Guardar">
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
		<label for="VentatdaRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<input type="text" id="VentatdaRefer" name="data[Ventatda][folio]" field="Ventatda.folio"
				data-ng-model="data.Master.folio" 
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="date" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentatdaFecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<input type="text" id="VentatdaFecha" name="data[Ventatda][fecha]" field="Ventatda.fecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="data.Master.fecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentatdaVendedor_id" class="control-label">Vendedor:</label>
		<div class="controls input">
			<select id="VentatdaVendedor_id" name="data[Ventatda][vendedor_id]"
				class="span3"
				data-ng-model="data.Master.vendedor_id"
				data-ng-options="i.id as i.cve for i in related.Vendedor"
				>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="VentatdaCliente_id" class="control-label">Cliente:</label>
		<div class="controls input">
			<select id="VentatdaCliente_id" name="data[Ventatda][cliente_id]"
				class="span3"
				data-ng-change="clienteChange()"
				data-ng-model="data.Master.cliente_id"
				data-ng-options="i.id as i.cve for i in related.Cliente"
				>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="VentatdaDivisa_id" class="control-label">Divisa:</label>
		<div class="controls input">
			<select id="VentatdaDivisa_id" name="data[Ventatda][divisa_id]"
				class="span1"
				data-ng-model="data.Master.divisa_id"
				data-ng-options="i.id as i.cve for i in related.Divisa"
				>
			</select>
			<input type="text" id="VentatdaTipodecambio" name="data[Ventatda][tipodecambio]" field="Ventatda.tipodecambio"
				data-ng-model="data.Master.tipodecambio"
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="span1" placeholder="T Cambio..." title="Tipo de Cambio de la Divisa seleccionada" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentatdaFormadepago_id" class="control-label">Forma de Pago:</label>
		<div class="controls input">
			<select id="VentatdaFormadepago_id" name="data[Ventatda][formadepago_id]"
				class="span2"
				data-ng-model="data.Master.formadepago_id"
				data-ng-options="i.id as i.cve for i in related.Formadepago"
				title="Forma de Pago del Cliente ( Efectivo, Tarjeta de Crédito ... )"
				>
			</select>
		</div>
	</div>

	</div> <!-- div.span6 -->
	<div class="span1">&nbsp;</div>


	<div class="span5">

	<div class="control-group">
		<label for="VentatdaSuma" class="control-label">Suma:</label>
		<div class="controls input">
			<input type="text" id="VentatdaSuma" name="data[Ventatda][suma]" field="Ventatda.suma"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.suma"
				class="span2 readonly" placeholder="Suma..." title="Suma del detalle (precio, menos descuentos por partida, por cantidad)" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentatdaImporte" class="control-label">Importe:</label>
		<div class="controls input">
			<input type="text" id="VentatdaImporte" name="data[Ventatda][importe]" field="Ventatda.importe"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.importe"
				class="span2 readonly" placeholder="Importe..." title="Importe (Suma menos Descuentos Generales)" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentatdaImpoimpu" class="control-label">Impuesto:</label>
		<div class="controls input">
			<input type="text" id="VentatdaImpoimpu" name="data[Ventatda][impoimpu]" field="Ventatda.impoimpu"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.impoimpu"
				class="span1 readonly" placeholder="Impuesto..." title="Impuesto" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentatdaTotal" class="control-label"><strong>Total:</strong></label>
		<div class="controls input">
			<input type="text" id="VentatdaTotal" name="data[Ventatda][total]" field="Ventatda.total"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.total"
				class="span2 readonly" placeholder="Total..." title="Total con Descuentos e Impuestos incluidos" />
		</div>
	</div>

	</div> <!-- div.span5 -->

</div>

</pane>

<pane id="tabs-1" heading="Detalle">

		<div class="toolbar well well-small" data-ng-hide="data.Master.id>0">
			<input class="span3" data-ng-model="currentItem.Articulo"
				data-ui-select2="fieldItem" data-ui-event="{ change : 'getItemByCve()' }" 
				data-item-placeholder="Código del Material..."
				title="Proporciona el Código del Material ({{currentItem.Articulo.ardescrip}})" />

			<select class="span3" data-ng-model="currentItem.Color" 
				data-ng-options="c.cve for c in currentItem.ArticuloColor" 
				title="Elige el Color del Material" />
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" maxlength="10" data-ng-model="currentItem.t0"
				data-ng-minlength="1" data-ng-maxlength="10"
				class="cant" placeholder="Cant..." title="Especifica la Cantidad" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" maxlength="10" data-ng-model="currentItem.precio"
				data-ng-minlength="1" data-ng-maxlength="10"
				class="precio" placeholder="Precio..." title="Especifica el Precio" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addCurrentItem()" 
				data-ng-disabled="(!(currentItem.Articulo.id>0)||!(currentItem.t0>0)||!(currentItem.precio>0))">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>
		</div>

		<div id="detailContentTable">
		<table class="table table-condensed table-bordered table-hover ax-detail-table">
			<thead>
			<tr>
				<th class="span2">Material</th>
				<th class="span2">Color</th>
				<th class="">Descripción</th>
				<th class="cant">Cant</th>
				<th class="precio">Precio</th>
				<th class="total">Importe</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="i in data.Details" data-detail-id="{{i.Detail.id}}" class="item-row">
				<td class="span2">{{i.Articulo.arcveart}}</td>
				<td class="span2">{{i.Color.cve}}</td>
				<td class="">{{i.Articulo.ardescrip}}</td>
				<td class="cant">{{i.Detail.cant}}</td>
				<td class="precio">{{i.Detail.precio | currency}}</td>
				<td class="total">{{i.Detail.importe | currency}}</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete($index, i, true)"
							data-ng-hide="data.Master.id>0">
							<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>

</pane> <!-- div tabs1 -->

<pane id="tabs-4" heading="Datos adicionales">
<div class="control-group">
	<label for="VentatdaObser" class="control-label">Observaciones</label>
	<div class="controls input">
		<textarea name="data[Ventatda][obser]" field="data.Master.Obser" maxlength="255"
				class="span4" cols="30" rows="6" id="VentatdaObser"
				data-ng-model="data.Master.obser"
				data-ng-minlength="0" data-ng-maxlength="255"
		>
		</textarea>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="" title="Adjunta el documento original del cliente">Documento Original:</label>
	<div class="controls input">
		<?php echo $this->Upload->edit('img/Ventatda', $this->data['master']['Ventatda']['folio']);?>
	</div>
</div>

</pane> <!-- pane#tabs4 -->

</tabs> <!-- div tabbable -->

</form>


<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

var emptyItem={Articulo: {'id': null, text: '', title:''}, Color:{}, ArticuloColor:[], "talla_id": 1, "t0": 1, "cant":1, "precio":0 };

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

	// Load Related Models
	$scope.loadRelatedModels();
	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "talla_id": 1, "t0":1, "cant":1, "precio":0};
	$scope.currentItem=angular.copy(emptyItem);
	$scope.selectedItems=[];
	$scope.selectedCell={};
	$scope.selectedRow={};
    $scope.selectedColumn={};	
	$scope.Cliente={};
/*
	if(!angular.isDefined($scope.data.Master.id) || !$scope.data.Master.id>0) {
		$scope.data.Master.impo1=16;
		$scope.data.Master.suma=0;
		$scope.data.Master.importe=0;
		$scope.data.Master.impoimpu=0;
		$scope.data.Master.total=0;
		$scope.data.Details=[];
	}
*/
	/* Begins the angular controller's code specific to this View */
	$scope.theRespose={};
	$scope.save = function() {
		// Serialize the full form, including details items
		$scope.totalize($scope.data.Details);		

		var serializedData=$scope.serializeToServer( {
							"Master" 	: $scope.data.Master,
							"Details"	: $scope.data.Details
							},
							$scope.data.masterModel,
							$scope.data.detailModel
						);

		console.log(serializedData);
		
		// Send the PUT request to the server
		$http.post('/Ventatiendas/save.json', serializedData
		).then(function(response) {
			// We got a response to process
			$scope.theResponse=response.data;
			if( angular.isDefined(response.data) && angular.isDefined(response.data.result) ) {
				console.log("RESPUESTA data: "+angular.toJson(response.data));
				if(response.data.result=='ok') {
					axAlert(response.data.message, 'success', false);
					$scope.data.Details=[];
					$scope.totalize( {} );
					if(angular.isDefined(response.data.nextFolio)) {
						$scope.data.Master.folio=response.data.nextFolio;
					}
				}
				else {
					var errorText='<strong>Error al Guardar</strong><br/>';
					if( angular.isDefined(response.data.validationErrors) ) {
						console.log("ERROR AL GUARDAR:" + angular.toJson(response.data));
						errorText='<ul class="unstyled">';
						angular.forEach(response.data.validationErrors, function(value, model) {
							errorText=errorText+'<li><strong>' + model + '</strong><ul>' ;
							angular.forEach(value, function(msg, field) {
								errorText=errorText + '<li>' + field + ': <em>' + msg + '</em>';
							});
							errorText=errorText+'</li></ul>';
						});
						errorText=errorText+'</ul>';
					}
					axAlert(errorText, 'error', false);
				}
			}
			else {
				console.log("ERROR AL GUARDAR:" + (angular.isDefined(response)?angular.toJson(response):'') );
				axAlert('Error DESCONOCIDO Guardar el Pedido', 'error', false);				
			}
			$scope.saveText='Guardar';
		});

	}
	$scope.cancel = function() {
		var title = 'Confirmación';
		var msg = '¿ Seguro de Cancelar ?';
		var btns = [{result:0, label: 'Cancelar'}, {result:1, label: 'OK', cssClass: 'btn-primary'}];
		$dialog.messageBox(title, msg, btns)
		.open()
		.then( function(result) {
			if(result) {
				// Send the CANCEL request to the server
				$http.get( '/Ventatiendas/cancel/'+$scope.data.Master.id+'.json'
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

	$scope.addCurrentItem = function() {
		var currentLength=$scope.data.Details.length;
		var item={
			Detail: {
				id: null,
				articulo_id: $scope.currentItem.Articulo.id,
				color_id: $scope.currentItem.Color.id,
				talla_id: $scope.currentItem.talla_id,
				t0: parseInt($scope.currentItem.t0, 10),
				cant: parseInt($scope.currentItem.t0, 10),
				precio: $scope.currentItem.precio,
				importe: (parseInt($scope.currentItem.t0, 10) * $scope.currentItem.precio).toFixed(2)
			},
			Articulo: $scope.currentItem.Articulo,
			Color: $scope.currentItem.Color
		}
		if($scope.data.Details.push(item)>currentLength) {
			$scope.currentItem=angular.copy(emptyItem);
			$scope.oldValues.arcveart='';
			$scope.totalize($scope.data.Details);		
			return 1;
		}
		else {
			axAlert('Error agregando detalle', 'error');
			return 0;
		}
	}

	$scope.detailDelete = function(index, itemObj, askConfirmation) {
		var title = 'Confirmación';
		var msg = '¿ Seguro de eliminar del detalle '+itemObj.Articulo.arcveart+' ?';
		var btns = [{result:0, label: 'Cancelar'}, {result:1, label: 'OK', cssClass: 'btn-primary'}];
		$dialog.messageBox(title, msg, btns)
		.open()
		.then( function(result) {
			if(result) {
				$scope.data.Details.splice(index,1);
				$scope.totalize($scope.data.Details);
			}
		});
	}

	$scope.clienteChange = function () {
		angular.forEach($scope.related.ClienteLista, function(value, key) {
			if(value.id==$scope.data.Master.cliente_id) {
				$scope.Cliente.clcvecli=value.clcvecli;
				$scope.Cliente.cltda=value.cltda;
				$scope.Cliente.clnom=value.clnom;
				if( !angular.isDefined($scope.data.Master.id) && !$scope.data.Master.id>0 ) {
					$scope.totalize($scope.data.Details);
				}
			}
		});
	}

	$scope.totalize = function( items ) {
		$scope.data.Master.suma=0;
		var item={};
		if( items.length>0 ) {
			angular.forEach( items, function(value, key) {
/*
				if( angular.isDefined(value.id) ) {
					item=value;
				}
*/
				if( angular.isDefined(value.Detail) && angular.isDefined(value.Detail.id) ) {
					item=value.Detail;
				}
				if( angular.isDefined(item.cant) && angular.isNumber(item.cant) && item.cant>0 ) {
					$scope.data.Master.suma=( parseFloat($scope.data.Master.suma) + parseFloat(item.importe) ).toFixed(2);
				}
			});
		}
		$scope.data.Master.impu1=16;
		$scope.data.Master.importe=$scope.data.Master.suma;
		$scope.data.Master.impoimpu=(parseFloat($scope.data.Master.importe) * ($scope.data.Master.impu1/100).toFixed(4) ).toFixed(2);
		$scope.data.Master.total=( parseFloat($scope.data.Master.importe) + parseFloat($scope.data.Master.impoimpu) ).toFixed(2);
		return true;
	}

	$scope.getItemByCve = function() {
		if($scope.currentItem.Articulo.text==$scope.oldValues.arcveart) {
			return 0;
		}

		$scope.oldValues.arcveart=$scope.currentItem.Articulo.text;
		$http.get($scope.app.actions.getItemByCve+
				'?cve='+$scope.currentItem.Articulo.text
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentItem.Articulo=response.data.item.Articulo;
				$scope.currentItem.Articulo.text=$scope.currentItem.Articulo.arcveart;
				$scope.currentItem.ArticuloColor=response.data.item.ArticuloColor;
				$scope.currentItem.Color=response.data.item.ArticuloColor[0];
				$scope.currentItem.talla_id=response.data.item.Articulo.talla_id;
				$scope.currentItem.t0=1;
				$scope.currentItem.cant=1;
				$scope.currentItem.precio=response.data.item.Articulo.arpvd;
				$scope.currentItem.importe=0;
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
				$scope.currentItem=JSON.parse(JSON.stringify(emptyItem));
				$scope.currentItem.Articulo.text=$scope.oldValues.arcveart;
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

	$scope.clienteChange();

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
