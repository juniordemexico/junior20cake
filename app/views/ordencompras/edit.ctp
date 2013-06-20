<header>
<div class="page-header">
<h1><small>Ordencompras <strong class="text-info">{{master.Ordencompra.folio}}</strong></small></h1>
</div>
</header>

<?php //echo $this->Form->create('Ordencompra', array('action'=>'/add', 'class'=>'form well', 'data-ng-form'=>"frmMaster")); ?>
<ng-form class="form form-horizontal" name="frmMaster">

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<button type="submit" class="btn btn-primary" data-ng-click="save()" data-ng-disabled="(frmMaster.$pristine || !frmMaster.$valid) || master.Ordencompra.id>0 || details.lenght>0" alt="Guardar">
		<i class="icon icon-ok-circle icon-white"></i> Guardar
		</button>

		<button type="submit" class="btn btn-primary" data-ng-click="cancel()" data-ng-disabled="!(master.Ordencompra.id>0) || master.Ordencompra.st=='C'" alt="Cancelar">
		<i class="icon icon-ok-circle icon-white"></i> Cancelar
		</button>
	</div>
	<div class="btn-group pull-right">	
		<button type="button" class="btn btn-primary" data-ng-click="print()" data-ng-disabled="!(master.Ordencompra.id>0)" title="Imprimir la transacción" alt="Imprimir">
		<i class="icon-print icon-white"></i>
		</button>
	</div>

</div>

<!-- Form's Tabbed Divs -->
<tabs id="tabs">

<pane id="tabs-0" heading="General" class="well">

<div class="row">
	<div class="span6">
	<div class="control-group">
		<label for="OrdencompraRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraRefer" name="data[Ordencompra][folio]" field="Ordencompra.folio"
				data-ng-model="master.Ordencompra.folio" 
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="date" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="OrdencompraFecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraFecha" name="data[Ordencompra][fecha]" field="Ordencompra.fecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="master.Ordencompra.fecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="OrdencompraProveedor_id" class="control-label">Proveedor:</label>
		<div class="controls input">
			<select id="OrdencompraProveedor_id" name="data[Ordencompra][proveedor_id]"
				class="span3"
				data-ng-model="master.Ordencompra.proveedor_id"
				data-ng-options="i.id as i.cve for i in related.Proveedor"
				data-ng-required="true">
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="OrdencompraDivisa_id" class="control-label">Divisa:</label>
		<div class="controls input">
			<select id="OrdencompraDivisa_id" name="data[Ordencompra][divisa_id]"
				class="span1"
				data-ng-model="master.Ordencompra.divisa_id"
				data-ng-options="i.id as i.cve for i in related.Divisa"
				data-ng-required="true">
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="OrdencompraObser" class="control-label">Tipo de Cambio:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraTipodecambio" name="data[Ordencompra][tipodecambio]" field="Ordencompra.tipodecambio"
				data-ng-model="master.Ordencompra.tipodecambio"
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="span1" placeholder="T Cambio..." title="Tipo de cambio al que se realiza la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="OrdencompraRefer" class="control-label">Referencia Proveedor:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraRefer" name="data[Ordencompra][proveedor_refer]" field="Ordencompra.proveedor_refer"
				class="span2"
				data-ng-model="master.Ordencompra.folio"
				data-ng-minlength="0" data-ng-maxlength="16"
				class="date" placeholder="Folio..." title="Referencia de la Ordén de Ordencompra asignada por el Proveedor" />
		</div>
	</div>

	</div> <!-- div.span6 -->
	<div class="span1">&nbsp;</div>


	<div class="span5">

	<div class="control-group"><label for="OrdencompraSt" class="control-label">Estatus</label><div class="controls input"><input type="radio" name="data[Ordencompra][st]" id="OrdencompraStA" value="A" checked="checked"  />Activa <input type="radio" name="data[Ordencompra][st]" id="OrdencompraStC" value="C"  />Cancelada</div></div>

	<div class="control-group">
		<label for="OrdencompraObser" class="control-label">Suma:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraSuma" name="data[Ordencompra][suma]" field="Ordencompra.suma"
				data-ng-model="master.Ordencompra.obser"
				class="span2" placeholder="Suma..." title="Suma del detalle (precio, menos descuentos por partida, por cantidad)" />
		</div>
	</div>
	<div class="control-group">
		<label for="OrdencompraObser" class="control-label">Descuentos:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraDesc1" name="data[Ordencompra][desc1]" field="Ordencompra.desc1"
				data-ng-model="master.Ordencompra.desc1"
				class="span1" placeholder="Desc 1..." title="Primer Descuento" />
			<input type="text" id="OrdencompraDesc2" name="data[Ordencompra][desc2]" field="Ordencompra.desc2"
				data-ng-model="master.Ordencompra.desc2"
				class="span1" placeholder="Desc 2..." title="Segundo Descuento" />
		</div>
	</div>
	<div class="control-group">
		<label for="OrdencompraImporte" class="control-label">Importe:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraImporte" name="data[Ordencompra][importe]" field="Ordencompra.importe"
				data-ng-model="master.Ordencompra.obser" ng-required="true"
				class="span2" placeholder="Importe..." title="Importe (Suma menos Descuentos Generales)" />
		</div>
	</div>
	<div class="control-group">
		<label for="OrdencompraImpu1" class="control-label">Impuestos:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraImpu1" name="data[Ordencompra][impu1]" field="Ordencompra.impu1"
				data-ng-model="master.Ordencompra.impu1"
				class="span1" placeholder="Impu 1..." title="Primer Impuesto" />
			<input type="text" id="OrdencompraImpu2" name="data[Ordencompra][impu2]" field="Ordencompra.impu2"
				data-ng-model="master.Ordencompra.impu2"
				class="span1" placeholder="Impu 2..." title="Segundo Impuesto" />
		</div>
	</div>
	<div class="control-group">
		<label for="OrdencompraTotal" class="control-label">Total:</label>
		<div class="controls input">
			<input type="text" id="OrdencompraTotal" name="data[Ordencompra][total]" field="Ordencompra.total"
				data-ng-model="master.Ordencompra.total"
				class="span2" placeholder="Total..." title="Total con Descuentos e Impuestos incluidos" />
		</div>
	</div>

	</div> <!-- div.span5 -->

</div>

</pane>

<pane id="tabs-1" heading="Detalle">

		<div class="toolbar well well-small" data-ng-hide="master.Ordencompra.id>0">
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
			<tr data-ng-repeat="item in details" data-detail-id="{{item.Ordencompradet.id}}" class="item-row">
				<td class="span2">{{item.Articulo.arcveart}}</td>
				<td class="span2">{{item.Color.cve}}</td>
				<td class="">{{item.Articulo.ardescrip}}</td>
				<td class="cant">{{item.Ordencompradet.t0}}</td>
				<td class="precio">{{item.Ordencompradet.costo | currency}}</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete($index, item, true)"
							data-ng-hide="master.Ordencompra.id>0">
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
	<label for="OrdencompraObser" class="control-label">Observaciones</label>
	<div class="controls input">
		<textarea name="data[Ordencompra][obser]" field="Ordencompra.Obser" maxlength="255"
				class="span4" cols="30" rows="6" id="OrdencompraObser"
				data-ng-minlength="0" data-ng-maxlength="255"
		>
		</textarea>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="" title="Adjunta el documento original del proveedor">Documento Original:</label>
	<div class="controls input">
		<?php echo $this->Upload->edit('img/Ordencompra', $this->data['master']['Ordencompra']['folio']);?>
	</div>
</div>

</pane> <!-- pane#tabs4 -->

<pane id="tabs-2" heading="Entradas/Salidas">
		<div id="detailOrdencompraContentTable">
		<table class="table table-condensed table-bordered table-hover ax-detail-table">
			<thead>
			<tr>
				<th class="date">Fecha</th>
				<th class="refer">Folio</th>
				<th class="">Concepto</th>
				<th class="st">ST</th>
				<th class="id">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in relatedtransactions" data-detail-id="{{item.Ordencompra.id}}" class="item-row">
				<td class="date">{{item.Ordencompra.fecha}}</td>
				<td class="refers">{{item.Ordencompra.folio}}</td>
				<td class="">{{item.Ordencompra.concep}}</td>
				<td class="st">{{item.Ordencompra.st}}</td>
				<td class="id">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="showItem($index, item, true)">
							<i class="icon icon-search"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>
</pane> <!-- pane#tabs2 -->

<pane id="tabs-3" heading="C x P">
		<div id="detailCxPContentTable">
		<table class="table table-condensed table-bordered table-hover ax-detail-table">
			<thead>
			<tr>
				<th class="date">Fecha</th>
				<th class="refer">Folio</th>
				<th class="">Concepto</th>
				<th class="total">Cargo</th>
				<th class="total">Abono</th>
				<th class="id">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in relatedcxp" data-detail-id="{{item.Cxp.id}}" class="item-row">
				<td class="date">{{item.Cxp.fecha}}</td>
				<td class="refers">{{item.Cxp.folio}}</td>
				<td class="">{{item.Cxp.concep}}</td>
				<td class="span2">{{item.Cxp.abono | currency}}</td>
				<td class="span2">{{item.Cxp.cargo | currency}}</td>
				<td class="id">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="showItem($index, item, true)">
							<i class="icon icon-search"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>
</pane> <!-- pane#tabs3 -->

</tabs> <!-- div tabbable -->

</ng-form>

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

var emptyItem={Articulo: {'id': null, text: '', title:''}, t0: 0, costo: 0, Color:{}, ArticuloColor:[] };

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "t0":0};

	$scope.relatedtransactions=[
	{ Ordencompra: {id:1, folio:"E000990", fecha:"2013-05-12", st:"A", concep:"Entrada por adelanto de entrega"} },
	{ Ordencompra: {id:2, folio:"E000991", fecha:"2013-05-15", st:"A", concep:"Entrada por la totalidad de la órden de compra"} },
	{ Ordencompra: {id:3, folio:"S000999", fecha:"2013-05-16", st:"A", concep:"Salida a devolución por defecto"} }	
	];
	
	$scope.relatedcxp=[
	{ Cxp: {id:1, folio:"C0000001", fecha:"2013-05-10", cargo: 245600, concep:"COMPRA C0000001"} },
	{ Cxp: {id:2, folio:"PA003451", fecha:"2013-05-11", abono: 100000, concep:"PAGO POR ANTICIPO COMPRA C0000001"} }
	];
	
	/* Begins the angular controller's code specific to this View */
//	$scope.related={};
//	if ($scope._data != null && $scope._data.master != null) $scope.master=$scope._data.master; else $scope.master={};
//	if ($scope._data != null && $scope._data.details != null) $scope.details=$scope._data.details; else $scope.details=[];
//	if ($scope._data != null && $scope._data.related != null) $scope.related=$scope._data.related; else $scope.related={};

	$scope.currentItem=angular.copy(emptyItem);
	$scope.theResponse={};
	$scope.theDataToPost='';

	$scope.save = function() {
		var emptyArray={};
//		alert($('#OrdencompraTipoartmovbodega_id').val());
//		$('#OrdencompraTipoartmovbodega_id').val(master.Ordencompra.tipoartmovbodega_id);

		// Serialize Master
		var serializedData='_method=PUT&';
		angular.forEach($scope.master.Ordencompra, function(value, key) {
			if( angular.isString(value) || angular.isNumber(value) ) {
				serializedData=serializedData.concat(encodeURIComponent('data[' + 'Ordencompra' + ']' + '[' + key + ']') + '=' + encodeURIComponent(value) + '&');
			}
		} );

		// Serialize Detail
		var serializedDetailData='';
		var i=0;
		angular.forEach($scope.details, function(value, key) {
			angular.forEach(value.Ordencompradet, function(value, key) {
				if( angular.isString(value) || angular.isNumber(value) ) {
					serializedDetailData=serializedDetailData.concat(encodeURIComponent('data[' + 'Ordencompradet' + ']' +'[' + i + ']' + '[' + key + ']') + '=' + encodeURIComponent(value) + '&');
				}
			});
			i=i+1;			
		});

		serializedData=serializedData+serializedDetailData;
		console.log('FULL DATA TO SEND:: '+serializedData);
		
		$http.post($scope.app.actions.add, serializedData
		).then(function(response) {

		if(typeof response.data != 'undefined' && 
			typeof response.data.result != 'undefined' && response.data.result=='ok') {
			console.log('SERVER RESPONDED...');
			console.log(response);
			$scope.theResponse=response.data;
//			$scope.details=response.data.details;
			axAlert(response.data.message, 'success', false);
			return;
		}

		console.log('SERVER RESPONDED...');
		console.log(response);

		$scope.theResponse=response.data;
		});

	}

	$scope.addCurrentItem = function() {
		var currentLength=$scope.details.length;
		var item={
			Ordencompradet: {
				id: null,
				ordencompra_id: null,
				articulo_id: $scope.currentItem.Articulo.id,
				color_id: $scope.currentItem.Color.id,
				talla_id: 0,
				t0: $scope.currentItem.t0,
//				cant: $scope.currentItem.cant,
				costo: $scope.currentItem.costo
			},
			Articulo: $scope.currentItem.Articulo,
			Color: $scope.currentItem.Color
		}
		if($scope.details.push(item)>currentLength) {
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
				$scope.details.splice(index,1);
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
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
