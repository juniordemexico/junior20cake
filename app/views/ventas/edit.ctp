<header>
<div class="page-header">
<h1><small>Venta <strong class="text-info">{{data.Master.folio}}</strong></small></h1>
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
		<label for="VentaRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<input type="text" id="VentaRefer" name="data[Venta][folio]" field="Venta.folio"
				data-ng-model="data.Master.folio" 
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="date" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentaFecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<input type="text" id="VentaFecha" name="data[Venta][fecha]" field="Venta.fecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="data.Master.fecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentaVendedor_id" class="control-label">Vendedor:</label>
		<div class="controls input">
			<select id="VentaVendedor_id" name="data[Venta][vendedor_id]"
				class="span3"
				data-ng-model="data.Master.vendedor_id"
				data-ng-options="i.id as i.cve for i in related.Vendedor"
				>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="VentaCliente_id" class="control-label">Cliente:</label>
		<div class="controls input">
			<select id="VentaCliente_id" name="data[Venta][cliente_id]"
				class="span3"
				data-ng-model="data.Master.cliente_id"
				data-ng-options="i.id as i.cve for i in related.Cliente"
				>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="VentaDivisa_id" class="control-label">Divisa:</label>
		<div class="controls input">
			<select id="VentaDivisa_id" name="data[Venta][divisa_id]"
				class="span1"
				data-ng-model="data.Master.divisa_id"
				data-ng-options="i.id as i.cve for i in related.Divisa"
				>
			</select>
			<input type="text" id="VentaTipodecambio" name="data[Venta][tipodecambio]" field="Venta.tipodecambio"
				data-ng-model="data.Master.tipodecambio"
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="span1" placeholder="T Cambio..." title="Tipo de Cambio de la Divisa seleccionada" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentaFormadepago_id" class="control-label">Forma de Pago:</label>
		<div class="controls input">
			<select id="VentaFormadepago_id" name="data[Venta][formadepago_id]"
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
		<label for="VentaSuma" class="control-label">Suma:</label>
		<div class="controls input">
			<input type="text" id="VentaSuma" name="data[Venta][suma]" field="Venta.suma"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.suma"
				class="span2 readonly" placeholder="Suma..." title="Suma del detalle (precio, menos descuentos por partida, por cantidad)" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentaDesc1" class="control-label">Descuentos:</label>
		<div class="controls input">
			<input type="text" id="VentaDesc1" name="data[Venta][desc1]" field="Venta.desc1"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.desc1"
				class="span1 readonly" placeholder="Desc 1..." title="Primer Descuento" />
			<input type="text" id="VentaDesc2" name="data[Venta][desc2]" field="Venta.desc2"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.desc2"
				class="span1 readonly" placeholder="Desc 2..." title="Segundo Descuento" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentaImporte" class="control-label">Importe:</label>
		<div class="controls input">
			<input type="text" id="VentaImporte" name="data[Venta][importe]" field="Venta.importe"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.importe"
				class="span2 readonly" placeholder="Importe..." title="Importe (Suma menos Descuentos Generales)" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentaImpu1" class="control-label">Impuestos:</label>
		<div class="controls input">
			<input type="text" id="VentaImpu1" name="data[Venta][impu1]" field="Venta.impu1"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.impu1"
				class="span1 readonly" placeholder="Impu 1..." title="Primer Impuesto" />
			<input type="text" id="VentaImpu2" name="data[Venta][impu2]" field="Venta.impu2"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.impu2"
				class="span1 readonly" placeholder="Impu 2..." title="Segundo Impuesto" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentaTotal" class="control-label"><strong>Total:</strong></label>
		<div class="controls input">
			<input type="text" id="VentaTotal" name="data[Venta][total]" field="Venta.total"
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
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="i in data.Details" data-detail-id="{{i.Detail.id}}" class="item-row">
				<td class="span2">{{i.Articulo.arcveart}}</td>
				<td class="span2">{{i.Color.cve}}</td>
				<td class="">{{i.Articulo.ardescrip}}</td>
				<td class="cant">{{i.Detail.t0}}</td>
				<td class="precio">{{i.Detail.precio | currency}}</td>
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
	<label for="VentaObser" class="control-label">Observaciones</label>
	<div class="controls input">
		<textarea name="data[Venta][obser]" field="data.Master.Obser" maxlength="255"
				class="span4" cols="30" rows="6" id="VentaObser"
				data-ng-model="data.Master.obser"
				data-ng-minlength="0" data-ng-maxlength="255"
		>
		</textarea>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="" title="Adjunta el documento original del cliente">Documento Original:</label>
	<div class="controls input">
		<?php echo $this->Upload->edit('img/Venta', $this->data['master']['Venta']['folio']);?>
	</div>
</div>

</pane> <!-- pane#tabs4 -->

</tabs> <!-- div tabbable -->

</form>

<pre>
{{ theResponse | json}}
</pre>

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

var emptyItem={Articulo: {'id': null, text: '', title:''}, Color:{}, ArticuloColor:[], "talla_id": 1, "t0": 0, "cant":1, "precio":0 };

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

	/* Begins the angular controller's code specific to this View */
	$scope.theRespose={};
	$scope.save = function() {
		// Serialize the full form, including details items
		var serializedData=$scope.serializeToServer( {
							"Master" 	: $scope.data.Master,
							"Details"	: $scope.data.Details
							},
							$scope.data.masterModel,
							$scope.data.detailModel
						);
						
		// Send the PUT request to the server
		$http.post($scope.app.actions.add, serializedData
		).then(function(response) {
			// We got a response to process
			$scope.theResponse=response.data;
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				axAlert(response.data.message, 'success', false);
				return;
			}
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
				$http.get( '/Ventas/cancel/'+$scope.data.Master.id+'.json'
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
				t0: $scope.currentItem.t0,
				cant: $scope.currentItem.t0,
				precio: $scope.currentItem.precio,
			},
			Articulo: $scope.currentItem.Articulo,
			Color: $scope.currentItem.Color
		}
		if($scope.data.Details.push(item)>currentLength) {
			$scope.currentItem=angular.copy(emptyItem);
			$scope.oldValues.arcveart='';		
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
			}
		});
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
				$scope.currentItem.precio=response.data.item.Articulo.arpvd;
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

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
