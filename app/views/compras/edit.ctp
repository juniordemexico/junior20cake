<header>
<div class="page-header">
<h1><small>Factura de Compra <strong class="text-info">{{data.Master.folio}}</strong></small></h1>
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
		<button type="button" class="btn btn-primary" data-ng-click="share()" data-ng-disabled="!(data.Master.id>0)" title="Enviar por email la transacción" alt="Compartir">
		<i class="icon-share icon-white"></i>
		</button>
	</div>

</div>

<form class="form form-horizontal" id="formmaster" name="formMaster" method="post" accept-charset="utf-8">
<input type="hidden" name="_method" value="PUT" />
	
<!-- Form's Tabbed Divs -->
<tabs id="tabs">

<pane id="tabs-0" heading="General" class="well">

<div class="row">
	<div class="span5">
	<div class="control-group">
		<label for="CompraRefer" class="control-label"><strong>Folio:</strong></label>
		<div class="controls input">
			<input type="text" id="CompraRefer" name="data[Compra][folio]" field="Compra.folio"
				data-ng-model="data.Master.folio"
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="date" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="CompraFecha" class="control-label"><strong>Fecha:</strong></label>
		<div class="controls input">
			<input type="text" id="CompraFecha" name="data[Compra][fecha]" field="Compra.fecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="data.Master.fecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="CompraRefer" class="control-label">Órden de Compra:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraFolio" name="data[Ordencompra][folio]" field="Ordencompra.folio"
				class="span2"
				data-ng-minlength="0" data-ng-maxlength="16"
				class="date" placeholder="Folio..." title="Referencia de la Ordén de Compra" />
		</div>
	</div>

	<div class="control-group">
		<label for="CompraProveedor_id" class="control-label">Proveedor:</label>
		<div class="controls input">
			<select id="CompraProveedor_id" name="data[Compra][proveedor_id]"
				class="span3"
				data-ng-model="data.Master.proveedor_id"
				data-ng-options="i.id as i.cve for i in related.Proveedor"
				>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="CompraDivisa_id" class="control-label">Divisa:</label>
		<div class="controls input">
			<select id="CompraDivisa_id" name="data[Compra][divisa_id]"
				class="span1"
				data-ng-model="data.Master.divisa_id"
				data-ng-options="i.id as i.cve for i in related.Divisa"
				>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="CompraTipodecambio" class="control-label">Tipo de Cambio:</label>
		<div class="controls input">
			<input type="text" id="CompraTipodecambio" name="data[Compra][tipodecambio]" field="Compra.tipodecambio"
				data-ng-model="data.Master.tipodecambio"
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="span1" placeholder="T Cambio..." title="Tipo de cambio al que se realiza la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="CompraRefer" class="control-label">Referencia Proveedor:</label>
		<div class="controls input">
			<input type="text" id="CompraProveedor_refer" name="data[Compra][proveedor_refer]" field="Compra.proveedor_refer"
				class="span2"
				data-ng-model="data.Master.proveedor_refer"
				data-ng-minlength="0" data-ng-maxlength="16"
				class="date" placeholder="Folio..." title="Referencia de la Ordén de Compra asignada por el Proveedor" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Estatus:</label>
		<div class="controls group">
		<div class="btn-group">
			<button type="button" id="CompraStA" class="btn" data-ng-class="{'btn-success': data.Master.st==app.estatus.Activo}" data-ng-model="data.Master.st" data-btn-radio="'A'" data-ng-disabled="data.Master.st==estatus.Cancelado" name="data[Compra][st]">Activo</button>
			<button type="button" id="CompraStC" class="btn" data-ng-class="{'btn-danger': data.Master.st==app.estatus.Cancelado}" data-ng-model="data.Master.st" data-btn-radio="'C'" data-ng-disabled="data.Master.st==estatus.Activo" name="data[Compra][st]">Cancelado</button>
		</div>
		</div>
	</div>

	</div> <!-- div.span5 -->
	<div class="span1">&nbsp;</div>


	<div class="span5">

	<div class="control-group">
		<label for="CompraSuma" class="control-label">Suma:</label>
		<div class="controls input">
			<input type="text" id="CompraSuma" name="data[Compra][suma]" field="Compra.suma"
				data-ng-model="data.Master.suma"
				class="span2" placeholder="Suma..." title="Suma del detalle (precio, menos descuentos por partida, por cantidad)" />
		</div>
	</div>
	<div class="control-group">
		<label for="CompraDesc1" class="control-label">Descuentos:</label>
		<div class="controls input">
			<input type="text" id="CompraDesc1" name="data[Compra][desc1]" field="Compra.desc1"
				data-ng-model="data.Master.desc1"
				class="span1" placeholder="Desc 1..." title="Primer Descuento" />
			<input type="text" id="CompraDesc2" name="data[Compra][desc2]" field="Compra.desc2"
				data-ng-model="data.Master.desc2"
				class="span1" placeholder="Desc 2..." title="Segundo Descuento" />
		</div>
	</div>
	<div class="control-group">
		<label for="CompraImporte" class="control-label">Importe:</label>
		<div class="controls input">
			<input type="text" id="CompraImporte" name="data[Compra][importe]" field="Compra.importe"
				data-ng-model="data.Master.importe"
				class="span2" placeholder="Importe..." title="Importe (Suma menos Descuentos Generales)" />
		</div>
	</div>
	<div class="control-group">
		<label for="CompraImpu1" class="control-label">Impuestos:</label>
		<div class="controls input">
			<input type="text" id="CompraImpu1" name="data[Compra][impu1]" field="Compra.impu1"
				data-ng-model="data.Master.impu1"
				class="span1" placeholder="Impu 1..." title="Primer Impuesto" />
			<input type="text" id="CompraImpu2" name="data[Compra][impu2]" field="Compra.impu2"
				data-ng-model="data.Master.impu2"
				class="span1" placeholder="Impu 2..." title="Segundo Impuesto" />
		</div>
	</div>
	<div class="control-group">
		<label for="CompraTotal" class="control-label"><strong>Total:</strong></label>
		<div class="controls input">
			<input type="text" id="CompraTotal" name="data[Compra][total]" field="Compra.total"
				data-ng-model="data.Master.total"
				class="span2" placeholder="Total..." title="Total con Descuentos e Impuestos incluidos" />
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
			<input type="text" maxlength="10" data-ng-model="currentItem.costo"
				data-ng-minlength="1" data-ng-maxlength="10"
				class="precio" placeholder="Costo..." title="Especifica el Costo" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addCurrentItem()" 
				data-ng-disabled="(!(currentItem.Articulo.id>0)||!(currentItem.t0>0))">
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
				<th class="precio">Costo</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="i in data.Details" data-detail-id="{{i.Detail.id}}" class="item-row">
				<td class="span2">{{i.Articulo.arcveart}}</td>
				<td class="span2">{{i.Color.cve}}</td>
				<td class="">{{i.Articulo.ardescrip}}</td>
				<td class="cant">{{i.Detail.t0}}</td>
				<td class="precio">{{i.Detail.costo | currency}}</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete($index, item, true)"
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
	<label for="CompraObser" class="control-label">Observaciones</label>
	<div class="controls input">
		<textarea name="data[Compra][obser]" field="Compra.Obser" maxlength="255"
				class="span4" cols="30" rows="6" id="CompraObser"
				data-ng-model="data.Master.obser"
				data-ng-minlength="0" data-ng-maxlength="255"
		>
		</textarea>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="" title="Adjunta el documento original del proveedor">Documento Original:</label>
	<div class="controls input">
		<?php echo $this->Upload->edit('img/Compra', $this->data['master']['Compra']['folio']);?>
	</div>
</div>

</pane> <!-- pane#tabs4 -->

</tabs> <!-- div tabbable -->

</form>

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

var emptyItem={Articulo: {'id': null, text: '', title:''}, Color:{}, ArticuloColor:[], "t0": 0, "cant":0, "costo":0 };

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

	// Load Related Models
	$scope.loadRelatedModels();
	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "t0":0, "cant":0, "costo":0};
	$scope.currentItem=angular.copy(emptyItem);


	$scope.relatedtransactions=[
	{ Entsal: {id:1, folio:"E000990", fecha:"2013-05-12", st:"A", concep:"Entrada por adelanto de entrega"} },
	{ Entsal: {id:2, folio:"E000991", fecha:"2013-05-15", st:"A", concep:"Entrada por la totalidad de la órden de compra"} },
	{ Entsal: {id:3, folio:"S000999", fecha:"2013-05-16", st:"A", concep:"Salida a devolución por defecto"} }	
	];
	
	$scope.relatedcxp=[
	{ Cxp: {id:1, folio:"C0000001", fecha:"2013-05-10", cargo: 245600, concep:"COMPRA C0000001"} },
	{ Cxp: {id:2, folio:"PA003451", fecha:"2013-05-11", abono: 100000, concep:"PAGO POR ANTICIPO COMPRA C0000001"} }
	];
	

	/* Begins the angular controller's code specific to this View */

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
				$http.get( '/Compras/cancel/'+$scope.data.Master.id+'.json'
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
				compra_id: null,
				articulo_id: $scope.currentItem.Articulo.id,
				color_id: $scope.currentItem.Color.id,
				talla_id: $scope.currentItem.talla_id,
				t0: $scope.currentItem.t0,
				cant: $scope.currentItem.t0,
				costo: $scope.currentItem.costo,
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
				$scope.currentItem.t0=0;
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
			url: "/Articulos/autocomplete/tipo:1",
      		data: function (term, page) {
        		return {keyword: term}; // query params go here
			},
			results: function (data, page) { // parse the results into the format expected by Select2.
        		return {results: data};
      		}
    	}
  	}


/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
