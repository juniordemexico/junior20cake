<header>
<div class="page-header">
<h1><small>Pedido Expo <strong class="text-info">{{data.Master.folio}}</strong></small></h1>
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
			<input type="text" id="VentaexpoFecha" name="data[Ventaexpo][fvence]" field="Ventaexpo.fvence"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="data.Master.fvence" data-ng-required="true"
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
		<label for="VentaexpoImpu1" class="control-label">Impuesto:</label>
		<div class="controls input">
			<input type="text" id="VentaexpoImpu1" name="data[Ventaexpo][impu1]" field="Ventaexpo.impu1"
				readonly="true"
				data-ng-readonly="true"
				data-ng-model="data.Master.impu1"
				class="span1 readonly" placeholder="Impu 1..." title="Primer Impuesto" />
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

	</div> <!-- div.span5 -->

</div>

</pane>

<pane id="tabs-1" heading="Detalle">



		<div class="gridStyle" ng-grid="gridOptions"></div>
<?php
/*
		<table class="table table-condensed table-bordered table-hover ax-detail-table">
			<thead>
			<tr>
				<th class="span2">Material</th>
				<th class="span2">Color</th>
				<th class="">Descripción</th>
				<th class="cant">T0</th>
				<th class="cant">Cant</th>
				<th class="precio">Precio</th>
				<th class="precio">Importe</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="i in data.Details" data-detail-id="{{i.Detail.id}}" class="item-row">
				<td class="span2">{{i.Articulo.arcveart}}</td>
				<td class="span2">{{i.Color.cve}}</td>
				<td class="">{{i.Articulo.ardescrip}}</td>
				<td class="cant" title="{{i.Detail.Tallas.tat0}}">{{i.Detail.t0}}</td>
				<td class="cant">{{i.Detail.cant}}</td>
				<td class="precio">{{i.Detail.precio | currency}}</td>
				<td class="precio">{{(i.Detail.cant)*i.Detail.precio | currency}}</td>
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
*/
?>

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

<div class="control-group">
	<label class="control-label" for="" title="Adjunta el documento original del cliente">Documento Original:</label>
	<div class="controls input">
		<?php echo $this->Upload->edit('img/Ventaexpo', $this->data['master']['Ventaexpo']['folio']);?>
	</div>
</div>

</pane> <!-- pane#tabs4 -->

</tabs> <!-- div tabbable -->

</form>


<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

var emptyItem={	
				"t0": 0,"t1": 0,"t2": 0,"t3": 0,"t4": 0,"t5": 0,"t6": 0,"t7": 0,"t8": 0,"t9": 0,
				"precio":0,
				Articulo: {'id': null, text: '', title:''},
				Talla: [{id:0, tadescrip: 'UNICA', tat0:'UNICA',}], "talla_id": 0,
				Color:{}, 
				ArticuloColor:[],
				Bases: {},
				Estilos: {}
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
	$scope.loadRelatedModels();
	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "talla_id": 1, "t0":0, "cant":0, "precio":0};
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

	$scope.addCurrentItem = function() {
		var currentLength=$scope.data.Details.length;
		var item={
			Detail: {
				id: null,
				articulo_id: $scope.currentItem.Articulo.id,
				color_id: $scope.currentItem.Color.id,
				talla_id: $scope.currentItem.talla_id,
				t0: parseInt($scope.currentItem.t0),
				t1: parseInt($scope.currentItem.t1),
				t2: parseInt($scope.currentItem.t2),
				t3: parseInt($scope.currentItem.t3),
				t4: parseInt($scope.currentItem.t4),
				t5: parseInt($scope.currentItem.t5),
				t6: parseInt($scope.currentItem.t6),
				t7: parseInt($scope.currentItem.t7),
				t8: parseInt($scope.currentItem.t8),
				t9: parseInt($scope.currentItem.t9),
				cant: parseInt($scope.currentItem.t0)+parseInt($scope.currentItem.t1),
				precio: Math.round($scope.currentItem.precio, 2),
				importe: (parseInt($scope.currentItem.t0)+parseInt($scope.currentItem.t1))*$scope.currentItem.precio.valueOf(),
			},
			Articulo: $scope.currentItem.Articulo,
			Color: $scope.currentItem.Color,
			Tallas: $scope.currentItem.Tallas,
			Bases: $scope.currentItem.Bases,
			Estilos: $scope.currentItem.Estilos
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
				$scope.currentItem.talla_id=response.data.item.Articulo.talla_id;
				$scope.currentItem.precio=Math.round(response.data.item.Articulo.arpva, 2);
				$scope.currentItem.t0=0;
				$scope.currentItem.t1=0;
				$scope.currentItem.t2=0;
				$scope.currentItem.t3=0;
				$scope.currentItem.t4=0;
				$scope.currentItem.t5=0;
				$scope.currentItem.t6=0;
				$scope.currentItem.t7=0;
				$scope.currentItem.t8=0;
				$scope.currentItem.t9=0;
				$scope.currentItem.Articulo=response.data.item.Articulo;
				$scope.currentItem.Articulo.text=response.data.item.Articulo.arcveart;
				$scope.currentItem.ArticuloColor=response.data.item.ArticuloColor;
				$scope.currentItem.Color=response.data.item.ArticuloColor[0];
				$scope.currentItem.Tallas=response.data.item.Tallas;
				$scope.currentItem.Bases=response.data.item.Bases;
				$scope.currentItem.Estilos=response.data.item.Estilos;
				console.log('getItemByCve RESPONSE: '+ JSON.stringify(response.data));
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

//    $scope.myData = $scope.data.Details;
/*
    $scope.detailEdit = function (row, cell, column){

//      $scope.selectedCell = cell;
//      $scope.selectedRow = row;
//      $scope.selectedColumn = column;

	row['cant']=parseInt(row['t0'],10)+
				parseInt(row['t1'],10)+
				parseInt(row['t2'],10)+
				parseInt(row['t3'],10)+
				parseInt(row['t4'],10)+
				parseInt(row['t5'],10)+
				parseInt(row['t6'],10)+
				parseInt(row['t7'],10)+
				parseInt(row['t8'],10)+
				parseInt(row['t9'],10);
				$scope.gridOptions.columnDefs[6].displayName=row['tl0'];
				$scope.gridOptions.columnDefs[7].displayName=row['tl1'];
				$scope.gridOptions.columnDefs[8].displayName=row['tl2'];
				$scope.gridOptions.columnDefs[9].displayName=row['tl3'];
				$scope.gridOptions.columnDefs[10].displayName=row['tl4'];
				$scope.gridOptions.columnDefs[11].displayName=row['tl5'];
				$scope.gridOptions.columnDefs[12].displayName=row['tl6'];
				$scope.gridOptions.columnDefs[13].displayName=row['tl7'];
				$scope.gridOptions.columnDefs[14].displayName=row['tl8'];
				$scope.gridOptions.columnDefs[14].displayName=row['tl9'];
		console.log('Edita: row:'+row[column]+' cell:'+cell+' column:'+column+' AKAJOE:'+row['linea_cve']);
//	  theRow[column]=theRow[];
    };
*/				
 
    $scope.gridOptions = { 
        data: 'items',
        enableCellSelection: true,
        enableRowSelection: false,
        enableCellEditOnFocus: true,
 		allowMultiSelect: false,
		showSelectionCheckbox: true,
       columnDefs: [
					{field: 'id', displayName: 'ID', enableCellEdit: false, pinned: true, width: '75', visible: false, groupable: true}, 
					{field: 'arcveart', displayName: 'Clave', enableCellEdit: false, pinned: true, width: '200', groupable: true}, 
					{field: 'color_cve', displayName: 'Color', enableCellEdit: false, pinned: true, width: '150', groupable: true}, 
					{field: 'base_cve', displayName: 'Base', enableCellEdit: false, pinned: true, width: '150', groupable: true}, 
					{field: 'linea_cve', displayName: 'Linea', enableCellEdit: false, pinned: true, width: '100', visible: false, groupable: true}, 
					{field: 'talla_cve', displayName: 'Tallas', enableCellEdit: false, pinned: true, width: '100', groupable: false}, 
					{field:'t0', displayName:'T0', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl0\')}}" title="Talla {{row.getProperty(\'tl0\')}}" maxlenght="6" />'},
					{field:'t1', displayName:'T1', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl1\')}}" title="Talla {{row.getProperty(\'tl1\')}}" maxlenght="6" />'},
					{field:'t2', displayName:'T2', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl2\')}}" title="Talla {{row.getProperty(\'tl2\')}}" maxlenght="6" />'},
					{field:'t3', displayName:'T3', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl3\')}}" title="Talla {{row.getProperty(\'tl3\')}}" maxlenght="6" />'},
					{field:'t4', displayName:'T4', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl4\')}}" title="Talla {{row.getProperty(\'tl4\')}}" maxlenght="6" />'},
					{field:'t5', displayName:'T5', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl5\')}}" title="Talla {{row.getProperty(\'tl5\')}}" maxlenght="6" />'},
					{field:'t6', displayName:'T6', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl6\')}}" title="Talla {{row.getProperty(\'tl6\')}}" maxlenght="6" />'},
					{field:'t7', displayName:'T7', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl7\')}}" title="Talla {{row.getProperty(\'tl7\')}}" maxlenght="6" />'},
					{field:'t8', displayName:'T8', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl8\')}}" title="Talla {{row.getProperty(\'tl8\')}}" maxlenght="6" />'},
					{field:'t9', displayName:'T9', enableCellEdit: true, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'tl9\')}}" title="Talla {{row.getProperty(\'tl9\')}}" maxlenght="6" />'},
					{field:'cant', displayName:'Cant', enableCellEdit: false, pinnable: false, width: '50', sortable: false, groupable: false, editableCellTemplate: '<input ng-class="{{\'colt\' + col.index}}" ng-input="COL_FIELD" ng-model="COL_FIELD" placeholder="{{row.getProperty(\'t0\')+row.getProperty(\'t1\')}}" title="Total de Piezas" maxlenght="6" />'},
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
//					{field:'cant', displayName:'Cant', enableCellEdit: false, pinnable: false},
//					{field:'precio', displayName:'Precio', enableCellEdit: false, pinnable: false},
					],
		groups: ['estilo_cve','linea_cve'],
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

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
