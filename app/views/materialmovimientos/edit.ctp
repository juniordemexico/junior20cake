<header>
<div class="page-header">
<h1><small>Movimiento de Almacén <strong class="text-info">{{master.Entsal.esrefer}}</strong></small></h1>
</div>
</header>

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<button type="submit" class="btn btn-primary" data-ng-click="save()" data-ng-disabled="(formMaster.$pristine || !formMaster.$valid) || master.Entsal.id>0 || !details.length>0" alt="Guardar">
		<i class="icon icon-ok-circle icon-white"></i> Guardar
		</button>

		<button type="submit" class="btn btn-primary" data-ng-click="alert('mierda')" data-ng-disabled="false && !(master.Entsal.id>0) || master.Entsal.st=='C'" alt="Cancelar">
		<i class="icon icon-ok-circle icon-white"></i> Cancelar
		</button>
	</div>
	<div class="btn-group pull-right">	
		<button type="button" class="btn btn-info" data-ng-click="saveDetailsToCache()" title="Guardar el detalle en Cache" alt="Cache">
		<i class="icon-plus-sign icon-white"></i>
		</button>
		<button type="button" class="btn btn-info" data-ng-click="loadDetailsFromCache()" title="Cargar el detalle del Cache" alt="Cache">
		<i class="icon-page icon-white"></i>
		</button>
		<button type="button" class="btn btn-primary" data-ng-click="print()" data-ng-disabled="!(master.Entsal.id>0)" title="Imprimir la transacción" alt="Imprimir">
		<i class="icon-print icon-white"></i>
		</button>
		<button type="button" class="btn btn-primary" data-ng-click="share()" data-ng-disabled="!(master.Entsal.id>0)" title="Enviar por email la transacción" alt="Compartir">
		<i class="icon-share icon-white"></i>
		</button>
	</div>

</div>

<?php //echo $this->Form->create('Entsal', array('action'=>'/add', 'class'=>'form well', 'data-ng-form'=>"formMaster")); ?>
<form class="form form-horizontal" id="formmaster" name="formMaster" method="post" accept-charset="utf-8">

<input type="hidden" name="_method" value="PUT" />

<!-- Form's Tabbed Divs -->
<tabs id="tabs">

<pane id="tabs-0" heading="General" class="well">

<div class="row">
	<div class="span5">
	<div class="control-group">
		<label for="EntsalRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<input type="text" id="EntsalRefer" name="data[Entsal][esrefer]" field="Entsal.esrefer"
				data-ng-model="master.Entsal.esrefer"
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="date" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalEsfecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<input type="text" id="EntsalEsfecha" name="data[Entsal][esfecha]" field="Entsal.esfecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="master.Entsal.esfecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalAlmacen_id" class="control-label">Almacén:</label>
		<div class="controls input">
			<select id="EntsalAlmacen_id" name="data[Entsal][almacen_id]"
				field="Entsal.almacen_id"
				class="span2"
				data-ng-model="master.Entsal.almacen_id"
				data-ng-options="i.id as i.cve for i in related.Almacen"
				data-ng-required="true">
			</select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Estatus:</label>
		<div class="controls group">
		<div class="btn-group">
			<button type="button" id="EntsalStA" class="btn" data-ng-class="{'btn-success': master.Entsal.st==app.estatus.Activo}" name="data[Entsal][st]" data-ng-model="master.Entsal.st" data-btn-radio="'A'" data-ng-disabled="master.Entsal.st==estatus.Cancelado">Activo</button>
			<button type="button" id="EntsalStC" class="btn" data-ng-class="{'btn-danger': master.Entsal.st==app.estatus.Cancelado}" name="data[Entsal][st]" data-ng-model="master.Entsal.st" data-btn-radio="'C'" data-ng-disabled="master.Entsal.st==estatus.Activo">Cancelado</button>
		</div>
		</div>
	</div>

	<div class="control-group">
		<label for="CompraRefer" class="control-label">Referencia Compra:</label>
		<div class="controls input">
			<input type="text" id="CompraRefer" name="data[Compra][folio]" field="Compra.folio"
				class="span2"
				data-ng-model="master.Compra.folio"
				data-ng-minlength="0" data-ng-maxlength="16"
				class="date" placeholder="Folio..." title="Si este movimiento corresponde a una Compra, proporciona su Folio." />
		</div>
	</div>

	<div class="control-group">
		<label for="ProduceRefer" class="control-label">Referencia Órden de Prod:</label>
		<div class="controls input">
			<input type="text" id="ProduceRefer" name="data[Produce][folio]" field="Produce.folio"
				class="span2"
				data-ng-model="master.Produce.folio"
				data-ng-minlength="0" data-ng-maxlength="16"
				class="date" placeholder="Folio..." title="Si este movimiento corresponde a una Órden de Producción, proporciona su Folio." />
		</div>
	</div>

	</div> <!-- div.span6 -->
	<div class="span1">&nbsp;</div>

	<div class="span6">

	<div class="control-group">
		<label for="EntsalTipoartmovbodega_id" class="control-label">Tipo de Mov:</label>
		<div class="controls input">
<?php
//			<input type="hidden" id="EntsalTipoartmovbodega_id" 
//			name="data[Entsal][tipoartmovbodega_id]" field="Entsal.tipoartmovbodega_id" />
?>
			<select id="EntsalTipoartmovbodega_id" name="data[Entsal][tipoartmovbodega_id]"
				field="Entsal.tipoartmovbodega_id"
				class="span3"
				data-ng-model="master.Entsal.tipoartmovbodega_id"
				data-ng-options="i.id as i.cve for i in related.Tipoartmovbodega"
				data-ng-required="true">
			</select>
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalEsconcep" class="control-label">Concepto:</label>
		<div class="controls input">
			<input type="text" id="EntsalEsconcep" name="data[Entsal][esconcep]" field="Entsal.esconcep"
				data-ng-model="master.Entsal.esconcep" ng-required="true"
				data-ng-minlength="1" data-ng-maxlength="32" data-ng-required="true"
				class="span4" placeholder="Concepto..." title="Concepto de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="CompraObser" class="control-label">Observaciones:</label>
		<div class="controls input">
			<textarea name="data[Entsal][obser]" field="Entsal.Obser" maxlength="255"
				class="span4" cols="30" rows="4" id="EntsalObser"
				data-ng-model="master.Entsal.esobser"
				data-ng-minlength="0" data-ng-maxlength="255"
				placeholder="Observaciones..."
			></textarea>
		</div>
	</div>

	</div> <!-- div.span5 -->

</div>

</pane>

<pane id="tabs-1" heading="Detalle">

		<div class="toolbar well well-small" data-ng-hide="master.Entsal.id>0">
			<input class="span3" data-ng-model="currentItem.Articulo"
				data-ui-select2="fieldItem" data-ui-event="{ change : 'getItemByCve()' }" 
				data-item-placeholder="Código del Material..."
				title="Proporciona el Código del Material ({{currentItem.Articulo.ardescrip}})" />

			<select class="span3" data-ng-model="currentItem.Color" 
				data-ng-options="c.cve for c in currentItem.ArticuloColor" 
				title="Elige el Color del Material" />
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" maxlength="8" data-ng-model="currentItem.cant"
				data-ng-minlength="1" data-ng-maxlength="10"
				class="cant" placeholder="Cant..." title="Especifica la cantidad" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addCurrentItem()" 
				data-ng-disabled="(!(currentItem.Articulo.id>0)||!(currentItem.cant>0))">
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
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details" data-detail-id="{{item.Entsaldet.id}}" class="item-row">
				<td class="span2">{{item.Articulo.arcveart}}</td>
				<td class="span2">{{item.Color.cve}}</td>
				<td class="">{{item.Articulo.ardescrip}}</td>
				<td class="cant">{{item.Entsaldet.esdt0}}</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete($index, item, true)"
							data-ng-hide="master.Entsal.id>0">
							<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>

</pane> <!-- div tabs0 -->

</tabs> <!-- div tabbable -->

</form>

<div style="margin-top:100px;">

<pre>
{{theResponse |json}}
</pre>

</div>

<script>
/* AxApp application's AxAppCtrl controller code */
var emptyItem={Articulo: {'id': null, text: '', title:''}, Color:{}, ArticuloColor:[] };

<?php echo $this->AxUI->initAppController(); //Initialize WebUI Controller ?>

	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "cant":0};

	$scope.currentItem=angular.copy(emptyItem);
	$scope.theResponse={};
	$scope.theDataToPost='';
	
	
	$scope.save = function() {
		var emptyArray={};
//		alert($('#EntsalTipoartmovbodega_id').val());
//		$('#EntsalTipoartmovbodega_id').val(master.Entsal.tipoartmovbodega_id);

		// Serialize Master
		var serializedData='_method=PUT&';
		angular.forEach($scope.master.Entsal, function(value, key) {
			if( angular.isString(value) || angular.isNumber(value) ) {
				serializedData=serializedData.concat(encodeURIComponent('data[' + 'Entsal' + ']' + '[' + key + ']') + '=' + encodeURIComponent(value) + '&');
			}
		} );

		// Serialize Detail
		var serializedDetailData='';
		var i=0;
		angular.forEach($scope.details, function(value, key) {
			angular.forEach(value.Entsaldet, function(value, key) {
				if( angular.isString(value) || angular.isNumber(value) ) {
					serializedDetailData=serializedDetailData.concat(encodeURIComponent('data[' + 'Entsaldet' + ']' +'[' + i + ']' + '[' + key + ']') + '=' + encodeURIComponent(value) + '&');
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
/*
		axAlert( (typeof response.data.result != 'undefined')?
				response.data.message:
				'Error Desconocido',
				response.data.result, false);
*/
		});

	}

	$scope.addCurrentItem = function() {
		var currentLength=$scope.details.length;
		var item={
			Entsaldet: {
				id: null,
				entsal_id: null,
				articulo_id: $scope.currentItem.Articulo.id,
				color_id: $scope.currentItem.Color.id,
				talla_id: 0,
				esdt0: $scope.currentItem.cant,
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
				$scope.currentItem.cant=0;
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

<?php echo $this->AxUI->getAppGlobalMethods(); ?>

<?php echo $this->AxUI->closeAppController(); ?>

<?php echo $this->AxUI->getAppDefaults();?>

</script>
