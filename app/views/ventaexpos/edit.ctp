<header>
<div class="page-header">
<h1><small>Pedido Expo <strong class="text-info">{{data.Master.folio}}</strong></small> <small class="text-info">( {{Cliente.clcvecli}} {{Cliente.cltda}} ) {{Cliente.clnom}}</small></h1>

</div>
</header>

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<button type="submit" class="btn btn-primary" data-ng-click="save()" data-ng-disabled="saveText=='GUARDANDO' || ( (formMaster.$pristine || !formMaster.$valid) || data.Master.id>0)" alt="Guardar">
		<i class="icon icon-ok-circle icon-white"></i> {{saveText}}
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
			<input type="text" id="VentaexpoRefer" name="data[Ventaexpo][folio]" field="Ventaexpo.folio"
				data-ng-model="data.Master.folio" 
				data-ng-minlength="1" data-ng-maxlength="8" data-ng-required="true"
				class="date" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoFecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<input type="text" id="VentaexpoFecha" name="data[Ventaexpo][fecha]" field="Ventaexpo.fecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="data.Master.fecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoFvence" class="control-label">Vencimiento:</label>
		<div class="controls input">
			<input type="text" id="VentaexpoFvence" name="data[Ventaexpo][fvence]" field="Ventaexpo.fvence"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="data.Master.fvence" data-ng-required="false"
				class="date" placeholder="Vencimiento..." title="Proporciona la Fecha de Vencimiento del Pedido" />
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoVendedor_id" class="control-label">Vendedor:</label>
		<div class="controls input">
			<select id="VentaexpoVendedor_id" name="data[Ventaexpo][vendedor_id]"
				class="span3"
				data-ng-model="data.Master.vendedor_id"
				data-ng-options="i.id as i.cve for i in related.Vendedor"
				>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="VentaexpoCliente_id" class="control-label">Cliente:</label>
		<div class="controls input">
			<select id="VentaexpoCliente_id" name="data[Ventaexpo][cliente_id]"
				class="span3"
				data-ng-change="clienteChange()"
				data-ng-model="data.Master.cliente_id"
				data-ng-options="i.id as i.cve for i in related.Cliente"
				>
			</select>
		</div>
	</div>


	</div> <!-- div.span6 -->
	<div class="span1">&nbsp;</div>


	<div class="span5">

	<div class="control-group">
		<label for="VentaexpoSuma" class="control-label">Suma:</label>
		<div class="controls input">
			<input type="text" id="VentaexpoSuma" name="data[Ventaexpo][suma]" field="Ventaexpo.suma"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.suma"
				class="span2 readonly" placeholder="Suma..." title="Suma del detalle (precio, menos descuentos por partida, por cantidad)" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentaexpoImporte" class="control-label">Importe:</label>
		<div class="controls input">
			<input type="text" id="VentaexpoImporte" name="data[Ventaexpo][importe]" field="Ventaexpo.importe"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.importe"
				class="span2 readonly" placeholder="Importe..." title="Importe (Suma menos Descuentos Generales)" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentaexpoImpoimpu" class="control-label">Impuesto:</label>
		<div class="controls input">
			<input type="text" id="VentaexpoImpoimpu" name="data[Ventaexpo][impoimpu]" field="Ventaexpo.impoimpu"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.impoimpu"
				class="span1 readonly" placeholder="Impuesto..." title="Impuesto" />
		</div>
	</div>
	<div class="control-group">
		<label for="VentaexpoTotal" class="control-label"><strong>Total:</strong></label>
		<div class="controls input">
			<input type="text" id="VentaexpoTotal" name="data[Ventaexpo][total]" field="Ventaexpo.total"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.total"
				class="span2 readonly" placeholder="Total..." title="Total con Descuentos e Impuestos incluidos" />
		</div>
	</div>

	<div class="control-group">
		<label for="btncopytocache" class="control-label"><strong>Portapapeles:</strong></label>
		<div class="controls input">
			<button type="button" id="btncopytocache" name="btnCopyToCache" data-ng-click="saveAllDetailToCache()"
			title="Presiona para copiar las partidas de este pedido hacia el portapapeles">
				<i class="icon icon-plus-sign"></i>Copiar
			</button>
			<button type="button" id="btncopyfromcache" name="btnCopyFromCache" data-ng-click="loadAllDetailFromCache()"
			title="Presiona para copiar las partidas del portapapeles hacia este pedido">
				<i class="icon icon-chevron-down"></i>Pegar
			</button>
		</div>
	</div>

	</div> <!-- div.span5 -->

</div>

</pane>

<pane id="tabs-1" heading="Detalle">
	<div style="margin-bottom: 16px;">
		<table class="">
			<thead>
				<th class="">Paquete</th>
				<th class="span1">{{currentItem.tl0}}</th>
				<th class="span1">{{currentItem.tl1}}</th>
				<th class="span1">{{currentItem.tl2}}</th>
				<th class="span1">{{currentItem.tl3}}</th>
				<th class="span1">{{currentItem.tl4}}</th>
				<th class="span1">{{currentItem.tl5}}</th>
				<th class="span1">{{currentItem.tl6}}</th>
				<th class="span1">{{currentItem.tl7}}</th>
				<th class="span1">{{currentItem.tl8}}</th>
				<th class="span1">{{currentItem.tl9}}</th>
				<th class="span1">Tot</th>
			</thead>
			<tbody>
				<td>
				<select id="Proporcionpedidos" name="data[Proporcionpedidos][id]"
					class="span3"
					data-ng-model="currentProporcionpedido"
					data-ng-options="i.cve for i in related.Proporcionpedido"
				>
				</select>
				</td>
				<td>{{currentProporcionpedido.t0}}</td>
				<td>{{currentProporcionpedido.t1}}</td>
				<td>{{currentProporcionpedido.t2}}</td>
				<td>{{currentProporcionpedido.t3}}</td>
				<td>{{currentProporcionpedido.t4}}</td>
				<td>{{currentProporcionpedido.t5}}</td>
				<td>{{currentProporcionpedido.t6}}</td>
				<td>{{currentProporcionpedido.t7}}</td>
				<td>{{currentProporcionpedido.t8}}</td>
				<td>{{currentProporcionpedido.t9}}</td>
				<td>{{currentProporcionpedido.cant}}</td>
			</tbody>
		</table>
	</div>

	<div class="gridStyle" ng-grid="gridOptions"></div>

</pane> <!-- div tabs1 -->

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

var emptyTalla={tl0:"T0", tl1:"T1", tl2:"T2", tl3:"T3", tl4:"T4", tl5:"T5", tl6:"T6", tl7:"T7", tl8:"T8", tl9:"T9" };
var emptyItem={	
				"t0": 0,"t1": 0,"t2": 0,"t3": 0,"t4": 0,"t5": 0,"t6": 0,"t7": 0,"t8": 0,"t9": 0,
				"precio":0,
				Articulo: {'id': null, text: '', title:''},
				Talla: [{id:0, tadescrip: 'UNICA', tat0:'UNICA',}], "talla_id": 0,
				Color:{}, 
				ArticuloColor:[],
				Bases: {},
				Estilos: {},
				Proporcionpedido: {}
//				"cant": function() {return this.t0+this.t1+this.t2;},
//				"importe": function() {return 0;}
				};

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

	// Load Related Models
	$scope.saveText='Guardar';
	$scope.loadRelatedModels();
	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "talla_id": 1, "t0":0, "cant":0, "precio":0};
//	$scope.currentItem={};
	$scope.currentProporcionpedido={};
	$scope.currentItem=angular.copy(emptyTalla);
	$scope.selectedItems=[];
	$scope.selectedCell={};
	$scope.selectedRow={};
    $scope.selectedColumn={};
	$scope.Cliente={};
	$scope.myItems={};
	
	if(!angular.isDefined($scope.data.Master.id) && $scope.data.Master.id>0) {
		$scope.data.Master.impo1=16;
		$scope.data.Master.suma=0;
		$scope.data.Master.importe=0;
		$scope.data.Master.impoimpu=0;
		$scope.data.Master.total=0;
		$scope.data.Details=[];
	}

	/* Begins the angular controller's code specific to this View */
	$scope.theRespose={};
	$scope.save = function() {
		// Serialize the full form, including details items
		$scope.data.Details=[];
		$scope.saveText='GUARDANDO';

		$scope.data.Master.suma=0;
		angular.forEach($scope.items, function(value, key) {
			if( angular.isDefined(value.cant) && angular.isNumber(value.cant) && value.cant>0 ) {
				$scope.data.Details.push({
					"Detail": {
						'id': null,
						'ventaexpo_id': null,
						'articulo_id': value.id,
						'color_id': value.color_id,
						'talla_id': value.talla_id,
						'precio': value.precio,
						't0': value.t0,
						't1': value.t1,
						't2': value.t2,
						't3': value.t3,
						't4': value.t4,
						't5': value.t5,
						't6': value.t6,
						't7': value.t7,
						't8': value.t8,
						't9': value.t9,
						'cant': value.cant,
						'importe': value.importe}
					}
				);
				$scope.data.Master.suma=( parseFloat($scope.data.Master.suma) + parseFloat(value.importe) ).toFixed(2);
			}
		});
		
		$scope.totalize($scope.data.Details);
/*
		$scope.data.Master.importe=$scope.data.Master.suma;
		$scope.data.Master.impo1=16;
		$scope.data.Master.impoimpu=(parseFloat($scope.data.Master.importe) * 0.16).toFixed(2);
		$scope.data.Master.total=( parseFloat($scope.data.Master.importe) + parseFloat($scope.data.Master.impoimpu) ).toFixed(2);
*/
		if(!$scope.data.Master.suma>0) {
			axAlert('El Pedido esta Vacio', 'warning');
			$scope.saveText='Guardar';
			return;
		}
		
		var serializedData=$scope.serializeToServer( {
							"Master" 	: $scope.data.Master,
							"Details"	: $scope.data.Details
							},
							$scope.data.masterModel,
							$scope.data.detailModel
						);

		console.log(serializedData);
		
		// Send the PUT request to the server
		$http.post('/Ventaexpos/save.json', serializedData
		).then(function(response) {
			// We got a response to process
			$scope.theResponse=response.data;
			if( angular.isDefined(response.data) && angular.isDefined(response.data.result) ) {
				console.log("RESPUESTA data: "+angular.toJson(response.data));
				if(response.data.result=='ok') {
					axAlert(response.data.message, 'success', false);
					$scope.items=angular.copy(items);
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

	$scope.totalize = function( items ) {
		$scope.data.Master.suma=0;
		var item={};
		if( items.length>0 ) {
			angular.forEach( items, function(value, key) {
				if( angular.isDefined(value.id) ) {
					item=value;
				}
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

//    $scope.myData = $scope.data.Details;

    $scope.detailEdit = function (row, cell, column) {
		if($scope.selectedRow!=row) {
			$scope.currentItem = angular.copy(row);
//			$scope.currentItem= {t0: row['tl0'], t1: row['tl1'], t2: row['tl2'], t3: row['tl3'],t4: row['tl4'],
//			  					t5: row['tl5'], t6: row['tl6'], t7: row['tl7'], t8: row['tl8'], t9: row['tl9'] };
		}
		$scope.selectedRow = row;
		$scope.selectedCell = cell;
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
		$scope.totalize( $scope.items );
	};
	
    $scope.detailCopy = function (row, cell, column) {
		var itemCant={
			t0: row['t0'],
			t1: row['t1'],
			t2: row['t2'],
			t3: row['t3'],
			t4: row['t4'],
			t5: row['t5'],
			t6: row['t6'],
			t7: row['t7'],
			t8: row['t8'],
			t9: row['t9']
		};
		localStorageService.add($scope.app.localCachePrefix+'detailsClipboard', angular.toJson(itemCant));
		axAlert('Detalle guardado en cache local', 'warning', false);
    };

    $scope.detailPaste = function (row, cell, column) {
		var itemCantString;
		if( itemCantString=localStorageService.get($scope.app.localCachePrefix+'detailsClipboard') ) {
			if( angular.isDefined(itemCantString) && angular.isString(itemCantString) ) {
				var itemCant=angular.fromJson(itemCantString);
				if (angular.isDefined(itemCant.t0) && angular.isDefined(row['tl0']) && row['tl0']!='') row['t0']=parseInt(itemCant.t0,10);
				if (angular.isDefined(itemCant.t1) && angular.isDefined(row['tl1']) && row['tl1']!='') row['t1']=parseInt(itemCant.t1,10);
				if (angular.isDefined(itemCant.t2) && angular.isDefined(row['tl2']) && row['tl2']!='') row['t2']=parseInt(itemCant.t2,10);
				if (angular.isDefined(itemCant.t3) && angular.isDefined(row['tl3']) && row['tl3']!='') row['t3']=parseInt(itemCant.t3,10);
				if (angular.isDefined(itemCant.t4) && angular.isDefined(row['tl4']) && row['tl4']!='') row['t4']=parseInt(itemCant.t4,10);
				if (angular.isDefined(itemCant.t5) && angular.isDefined(row['tl5']) && row['tl5']!='') row['t5']=parseInt(itemCant.t5,10);
				if (angular.isDefined(itemCant.t6) && angular.isDefined(row['tl6']) && row['tl6']!='') row['t6']=parseInt(itemCant.t6,10);
				if (angular.isDefined(itemCant.t7) && angular.isDefined(row['tl7']) && row['tl7']!='') row['t7']=parseInt(itemCant.t7,10);
				if (angular.isDefined(itemCant.t8) && angular.isDefined(row['tl8']) && row['tl8']!='') row['t8']=parseInt(itemCant.t8,10);
				if (angular.isDefined(itemCant.t9) && angular.isDefined(row['tl9']) && row['tl9']!='') row['t9']=parseInt(itemCant.t9,10);
				row['cant']=
					(angular.isDefined(row['t0'])?parseInt(row['t0'],10):0)+
					(angular.isDefined(row['t1'])?parseInt(row['t1'],10):0)+
					(angular.isDefined(row['t2'])?parseInt(row['t2'],10):0)+
					(angular.isDefined(row['t3'])?parseInt(row['t3'],10):0)+
					(angular.isDefined(row['t4'])?parseInt(row['t4'],10):0)+
					(angular.isDefined(row['t5'])?parseInt(row['t5'],10):0)+
					(angular.isDefined(row['t6'])?parseInt(row['t6'],10):0)+
					(angular.isDefined(row['t7'])?parseInt(row['t7'],10):0)+
					(angular.isDefined(row['t8'])?parseInt(row['t8'],10):0)+
					(angular.isDefined(row['t9'])?parseInt(row['t9'],10):0);
				row['importe']=( parseFloat(row['cant']) * parseFloat(row['precio'])).toFixed(2);
				$scope.totalize( $scope.items );
			}
			else {
				axAlert('El Detalle en el cache local esta vacio');				
			}
		}
		else {
			axAlert('El cache local no contiene Detalle');
		}
    };

	$scope.detailDelete = function(row, cell, column) {
		delete row['t0'];
		delete row['t1'];
		delete row['t2'];
		delete row['t3'];
		delete row['t4'];
		delete row['t5'];
		delete row['t6'];
		delete row['t7'];
		delete row['t8'];
		delete row['t9'];
		delete row['cant'];
		delete row['importe'];
		$scope.totalize( $scope.items );
	}

	$scope.clienteChange = function () {
		angular.forEach($scope.related.ClienteLista, function(value, key) {
			if(value.id==$scope.data.Master.cliente_id) {
				$scope.Cliente.clcvecli=value.clcvecli;
				$scope.Cliente.cltda=value.cltda;
				$scope.Cliente.clnom=value.clnom;
			}
		});
	}
	$scope.updateCurrentItem = function ( row ) {
		$scope.currentItem=angular.copy(row);
	}
	
    $scope.gridOptions = { 
        data: 'items',
        enableCellSelection: true,
        enableRowSelection: false,
        enableCellEditOnFocus: true,
 		allowMultiSelect: false,
		showSelectionCheckbox: false,
		selectedItems: $scope.selectedItems,
		columnDefs: [
			{field: 'id', displayName: 'ID', enableCellEdit: false, pinned: true, width: '75', visible: false, groupable: true}, 
			{field: 'arcveart', displayName: 'Clave', enableCellEdit: false, pinned: true, width: '150', groupable: true}, 
			{field: 'color_cve', displayName: 'Color', enableCellEdit: false, pinned: true, width: '125', groupable: true}, 
			{field: 'base_cve', displayName: 'Base', enableCellEdit: false, pinned: true, width: '120', groupable: true}, 
			{field: 'linea_cve', displayName: 'Linea', enableCellEdit: false, pinned: true, width: '100', visible: false, groupable: true}, 
			{field: 'talla_cve', displayName: 'Tallas', enableCellEdit: false, pinned: true, width: '100', groupable: false, visible: false}, 
			{field: 'precio', displayName: 'Precio', enableCellEdit: false, pinned: true, width: '75', groupable: false, visible: true, cellFilter: 'currency'}, 
			{field:'t0', displayName:'T0', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl0\')}}" title="Talla {{row.getProperty(\'tl0\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t1', displayName:'T1', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl1\')}}" title="Talla {{row.getProperty(\'tl1\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t2', displayName:'T2', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl2\')}}" title="Talla {{row.getProperty(\'tl2\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t3', displayName:'T3', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl3\')}}" title="Talla {{row.getProperty(\'tl3\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t4', displayName:'T4', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl4\')}}" title="Talla {{row.getProperty(\'tl4\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t5', displayName:'T5', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl5\')}}" title="Talla {{row.getProperty(\'tl5\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t6', displayName:'T6', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl6\')}}" title="Talla {{row.getProperty(\'tl6\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t7', displayName:'T7', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl7\')}}" title="Talla {{row.getProperty(\'tl7\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t8', displayName:'T8', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl8\')}}" title="Talla {{row.getProperty(\'tl8\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'t9', displayName:'T9', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl9\')}}" title="Talla {{row.getProperty(\'tl9\')}}" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'cant', displayName:'Cant', enableCellEdit: false, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input data-ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'t0\')+row.getProperty(\'t1\')}}" title="Total de Piezas" maxlenght="6" style="width:36px;" ng-change="detailEdit(row.entity, row.getProperty(col.field), col.field)" />'},
			{field:'importe', displayName:'Importe', enableCellEdit: false, pinnable: false, width: '70', sortable: false, groupable: false, visible: false },
			{field:'copiar', displayName:'Editar', enableCellEdit: false, pinnable: false, width: '120', sortable: false, groupable: false,cellTemplate: '<div class="btn-group"><button class="btn btn-small"  ng-class="{{\'colt\' + col.index}}" ng-click="detailCopy(row.entity, row.getProperty(col.field), col.field)" title="Copiar"><i class="icon icon-share-alt"></i></button><button class="btn btn-small" ng-class="{{\'colt\' + col.index}}" ng-click="detailPaste(row.entity, row.getProperty(col.field), col.field)" title="Pegar"><i class="icon  icon-chevron-down"></i></button><button class="btn btn-small" ng-class="{{\'colt\' + col.index}}" ng-click="detailDelete(row.entity, row.getProperty(col.field), col.field)" title="Borrar"><i class="icon  icon-trash"></i></button></div>'},
			//		{field:'pegar', displayName:'Pegar', enableCellEdit: false, pinnable: false, width: '50', sortable: false, groupable: false,cellTemplate: '<button class="btn btn-small"  ng-class="{{\'colt\' + col.index}}" ng-click="detailPaste(row.entity, row.getProperty(col.field), col.field)"><i class="icon "></i></button>'},
			{field:'tl0', displayName:'TL0', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl1', displayName:'TL1', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl2', displayName:'TL2', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl3', displayName:'TL3', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl4', displayName:'TL4', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl5', displayName:'TL5', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl6', displayName:'TL6', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl7', displayName:'TL7', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl8', displayName:'TL8', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field:'tl9', displayName:'TL9', enableCellEdit: true, pinnable: false, width: '50', visible: false, sortable: false, groupable: false},
			{field: 'estilo_cve', displayName: 'Estilo', enableCellEdit: false, pinned: true, width: '100', visible: false, groupable: true}, 
//			{field:'cant', displayName:'Cant', enableCellEdit: false, pinnable: false},
//			{field:'precio', displayName:'Precio', enableCellEdit: false, pinnable: false},
			],
		groups: ['linea_cve','estilo_cve'],
		showGroupPanel: false,
		showFilter: true,
    };
//		cellTemplate: '<div class="ngCellText" ng-class="col.colIndex()" title="col.tl0"><span ng-cell-text>{{COL_FIELD CUSTOM_FILTERS}}</span></div>'
	
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
	
	$scope.saveAllDetailToCache = function() {
		var items=[];
		
		if( $scope.items.length>0 ) {
			var i=0;
			console.log('Tengo ' + $scope.items.length + ' Articulos en total');
			
			angular.forEach( $scope.items, function(value, key) {
				var item={};
				if( angular.isDefined(value.id) ) {
					item=angular.copy(value);
				}
				if( angular.isDefined(value.Detail) && angular.isDefined(value.Detail.id) ) {
					item=angular.copy(value.Detail);
				}
				if( angular.isDefined(item.cant) && angular.isNumber(item.cant) && item.cant>0 ) {
					i=i+1;
					console.log('Uno mas (' + i + ')::'+angular.toJson(item));
					this.push(item);
				}
			}, items);
			console.log(  angular.toJson(items) );
		}

		localStorageService.add($scope.app.localCachePrefix+'allDetailsClipboard', angular.toJson(items));
		axAlert(i + ' Partidas guardadas en el portapapeles local', 'warning', false);
	}


	$scope.loadAllDetailFromCache = function() {
		var details=false;
		var items=[];
		var myItem={};
		var i=0;
		if( details=localStorageService.get($scope.app.localCachePrefix+'allDetailsClipboard') ) {
			
			if( details != 'undefined' && angular.isString(details) ) {
// Begin clipboard to working array
				items=angular.fromJson(details);
				axAlert(items.length+' Items de Detalle cargados del cache', 'warning', false);

				angular.forEach( items, function(value, key) {
					myItem=angular.copy(value);

					angular.forEach( $scope.items, function(value, key) {
						if(value.id==myItem.id && value.color_id==myItem.color_id) {
							i=i+1;
							if(angular.isDefined(myItem.t0)) value.t0=myItem.t0;
							if(angular.isDefined(myItem.t1)) value.t1=myItem.t1;
							if(angular.isDefined(myItem.t2)) value.t2=myItem.t2;
							if(angular.isDefined(myItem.t3)) value.t3=myItem.t3;
							if(angular.isDefined(myItem.t4)) value.t4=myItem.t4;
							if(angular.isDefined(myItem.t5)) value.t5=myItem.t5;
							if(angular.isDefined(myItem.t6)) value.t6=myItem.t6;
							if(angular.isDefined(myItem.t7)) value.t7=myItem.t7;
							if(angular.isDefined(myItem.t8)) value.t8=myItem.t8;
							if(angular.isDefined(myItem.t9)) value.t9=myItem.t9;
							if(angular.isDefined(myItem.cant)) value.cant=myItem.cant;
							value.importe=( parseFloat(value.cant) * parseFloat(value.precio)).toFixed(2)
						}
					});
				});
				$scope.totalize( $scope.items );
				
// Ends clipboard to working array
			}
			else {
				axAlert('El Detalle en el cache local esta vacio');				
			}
		}
		else {
			if(typeof $scope.data.Details == 'undefined' || !$scope.data.Details ) {
				$scope.data.Details=[];
			}
			axAlert('El cache local no contiene Detalle');
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
