<header>
<div class="row page-header">
<h1>{{master.Proveedor.prcvepro}} <small>{{master.Proveedor.prnom}}</small></h1>
</div>
</header>

<?php echo $this->Form->create('Proveedor', array('action'=>'/costoarticulo', 'class'=>'form-search')); ?>

<input type="hidden" name="_method" value="PUT" />

<!-- Form's Tabbed Divs -->
<tabs id="tabs">

<pane id="tabs-0" heading="Materiales" class="well">

		<h4>Materiales relacionados:</h4><br />

		<div class="controls controls-row well well-small">
			<input class="col5"
				data-ui-select2="fieldMaterial" 
				data-ng-model="currentMaterial.Articulo" 
				data-ui-event="{ change : 'getMaterialByCve()' }"
				data-item-placeholder="Clave de Material..."
				title="{{currentMaterial.Articulo.ardescrip}}" />
				&nbsp;&nbsp;
			<select id="ArticuloProveedorUnidad_id" name="data[Articulo][unidad_id]"
				field="ArticuloProveedor.unidad_id"
				class="col2"
				data-ng-model="currentMaterial.unidad_id"
				data-ng-options="i.id as i.cve for i in related.Unidad"
				data-ng-required="true">
			</select>
			&nbsp;&nbsp;
			<input type="text" maxlength="4" class="precio"
				data-ng-model="currentMaterial.ancho"
				placeholder="Ancho..." title="Especificar el ancho cuando se trate de telas" />
			&nbsp;&nbsp;
			<input type="text" maxlength="12" class="precio"
				data-ng-model="currentMaterial.costo"
				placeholder="Costo..." title="Costo según el proveedor especificado" />
			&nbsp;&nbsp;
			<input type="text" maxlength="32" class="col4"
				data-ng-model="currentMaterial.composicion"
				placeholder="Composición..." title="Composición del Material" />
			&nbsp;&nbsp;
			<input type="text" maxlength="32" class="col4"
				data-ng-model="currentMaterial.origen"
				placeholder="Origen..." title="Origen del Material" />
				&nbsp;&nbsp;
				&nbsp;&nbsp;
			<button id="submitMaterial" class="btn" type="button"
			data-ng-click="addItem()"
			data-ng-disabled="(!(currentMaterial.Articulo.id>0)||!(currentMaterial.costo>0))"
			><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>
		
		<div id="detailContentMaterialTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="">Material</th>
				<th class="precio">Unidad</th>
				<th class="precio">Ancho</th>
				<th class="precio">Costo</th>
				<th class="col4">Composicion</th>
				<th class="col4">Origen</th>
				<th class="fecha">Autorización</th>
				<th class="st">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details.material" id="row_{{item.ArticuloProveedor.id}}"
				class="item-row">
				<td class="" title="{{item.Articulo.ardescrip}}">{{item.Articulo.arcveart}}</td>
				<td class="precio" title="{{item.Unidad.nom}}">{{item.Unidad.cve}}</td>
				<td class="precio">{{item.ArticuloProveedor.ancho}}</td>
				<td class="precio">
					<input type="text" 
						class="cant bluraction detailCosto" 
						title="Especifica el Costo del Material" 
						placeholder="Costo..."
						data-ng-model="item.ArticuloProveedor.costo"
						data-ui-event="{ blur : 'changeCosto(item)' }" 
					/>
				</td>
				<td class="col4">{{item.ArticuloProveedor.composicion}}</td>
				<td class="col4">{{item.ArticuloProveedor.origen}}</td>
				<td class="fecha">
					<span data-ng-hide="item.ArticuloProveedor.fautoriza">
						<button type="button" class="btn btn-small" data-ng-click="detailAuthorize(item.ArticuloProveedor.id, item, true)">
							<i class="icon icon-ok"></i>
						</button>
					</span>
					{{item.ArticuloProveedor.fautoriza}}
				</td>
				<td class="st">
					<button type="button" class="btn btn-mini"
						data-ng-click="detailDelete(item.ArticuloProveedor.id, item, true)">
						<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div> <!-- detailContentMaterialTable -->
</pane>

<pane id="tabs-1" heading="Servicios" class="well">
		<h4>Servicios relacionados:</h4><br />
		<div class="controls controls-row well well-small">
			<input class="col5"
				data-ui-select2="fieldServicio"
				data-ng-model="currentServicio.Articulo" 
				data-ui-event="{ change : 'getServicioByCve()' }" 
				data-item-placeholder="Clave de Servicio..."
				title="{{currentServicio.Articulo.ardescrip}}" />
			&nbsp;&nbsp;
			<input type="text" maxlength="12" class="precio"
				data-ng-model="currentServicio.costo"
				placeholder="Costo..." title="Costo según el proveedor especificado" />
			&nbsp;&nbsp;
			<button id="submitServicio" class="btn" type="button"
			data-ng-click="addServicio()"
			data-ng-disabled="(!(currentServicio.Articulo.id>0)||!(currentServicio.costo>0))">
			<i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentServicioTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="">Servicio</th>
				<th class="precio">Costo</th>
				<th class="fecha">Autorizado</th>
				<th class="st">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details.servicio" id="row_{{item.ArticuloProveedor.id}}"
				class="item-row">
				<td class="" title="{{item.Articulo.ardescrip}}">{{item.Articulo.arcveart}}</td>
				<td class="precio">
					<input type="text" 
						class="cant bluraction detailCosto" 
						title="Especifica el Costo del Servicio" 
						placeholder="Costo..."
						data-ng-model="item.ArticuloProveedor.costo"
						data-ui-event="{ blur : 'changeCosto(item)' }" 						
					/>
				</td>
				<td class="fecha">
					<span data-ng-hide="item.ArticuloProveedor.fautoriza">
						<button type="button" class="btn btn-small" data-ng-click="detailAuthorize(item.ArticuloProveedor.id, item, true)">
							<i class="icon icon-ok"></i>
						</button>
					</span>
					{{item.ArticuloProveedor.fautoriza}}
				</td>
				<td class="st">
					<button type="button" class="btn btn-mini"
						data-ng-click="detailDelete(item.ArticuloProveedor.id, item, true)">
						<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div> <!-- detailContentServicioTable -->
</pane>
</tabs>

<?php echo $this->Form->End();?>


<script>

var emptyItem={Articulo: {id: null, text: '', title:''}, costo: '', composicion: '', ancho: '', origen:'', unidad_id:1 };

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>
	
	/* Sets the data object/array generated by the CakePHP's controller  */
	// ------------Begin Controller's Data----------------------------------------
	$scope._data=<?php e(json_encode($this->data));?>;
	// ------------End Controller's Data------------------------------------------

	/* Begins the angular controller's code specific to this View */

	$scope.master=$scope._data.master;
	$scope.details=$scope._data.details;

	$scope.oldValues={"material":"","servicio":""};
	
	$scope.currentMaterial=angular.copy(emptyItem);
	$scope.currentServicio=angular.copy(emptyItem);

	$scope.fieldMaterial = {
		ajax: {
			url: "/Articulos/autocomplete/tipo:1",
      		data: function (term, page) {
        		return {keyword: term}; // query params go here
			},
			results: function (data, page) { // parse the results into the format expected by Select2.
        		return {results: data};
			}
		}
	};

	$scope.fieldServicio = {
		ajax: {
			url: "/Articulos/autocomplete/tipo:2",
      		data: function (term, page) {
        		return {keyword: term}; // query params go here
			},
			results: function (data, page) { // parse the results into the format expected by Select2.
        		return {results: data};
      		}
    	}
  	};
	
	$scope.addItem = function() {
		$http.get('/Proveedores/addCostoArticulo.json'+
				'?proveedor_id='+$scope.master.Proveedor.id+
				'&material_id='+$scope.currentMaterial.Articulo.id+
				'&costo='+$scope.currentMaterial.costo+
				'&composicion='+$scope.currentMaterial.composicion+
				'&origen='+$scope.currentMaterial.origen+
				'&ancho='+$scope.currentMaterial.ancho+
				'&unidad_id='+$scope.currentMaterial.unidad_id
		).then(function(response) {
		if(typeof response.data != 'undefined' && 
			typeof response.data.result != 'undefined' && response.data.result=='ok') {
			$scope.details=response.data.details;
			$scope.currentMaterial=angular.copy(emptyItem);
			axAlert(response.data.message, 'success', false);
		}
		else {
			if(typeof response.data.result != 'undefined') {
				axAlert(response.data.message, 'error', false);
			}
			else {
				console.log(angular.toJson(response));
				axAlert('Error Desconocido', 'error', false);
			}
		}
		});
	}

	$scope.addServicio = function() {
		$http.get('/Proveedores/addCostoArticulo.json'+
				'?proveedor_id='+$scope.master.Proveedor.id+
				'&material_id='+$scope.currentServicio.Articulo.id+
				'&costo='+$scope.currentServicio.costo
		).then(function(response) {
		if(typeof response.data != 'undefined' && 
			typeof response.data.result != 'undefined' && response.data.result=='ok') {
			$scope.details=response.data.details;
			$scope.currentServicio=angular.copy(emptyItem);
			axAlert(response.data.message, 'success', false);
		}
		else {
			if(typeof response.data.result != 'undefined') {
				axAlert(response.data.message, 'error', false);
			}
			else {
				axAlert('Error Desconocido', 'error', false);
			}
		}
		});
	}

	$scope.changeCosto = function(itemObj) {
		$http.get('/Proveedores/changeCosto.json'+
		'?id='+itemObj.ArticuloProveedor.id+
		'&costo='+itemObj.ArticuloProveedor.costo
		).then(function(response) {
		if(typeof response.data != 'undefined' && 
			typeof response.data.result != 'undefined' && response.data.result=='ok') {					
			$scope.details=response.data.details;
			axAlert(response.data.message, 'success', false);
		}
		else {
			if(typeof response.data.result != 'undefined') {
				axAlert(response.data.message, 'error', false);
			}
			else {
				axAlert('Error Desconocido', 'error', false);
			}
		}
    	});	
	}

	$scope.detailAuthorize = function(index, itemObj, askConfirmation) {
		var title = 'Confirmación';
		var msg = '¿ Autorizar el material ' + itemObj.Articulo.arcveart +
				' con un costo de ' + itemObj.ArticuloProveedor.costo + ' ?';
		var btns = [{result:0, label: 'Cancelar'}, {result:1, label: 'OK', cssClass: 'btn-primary'}];
		$dialog.messageBox(title, msg, btns)
		.open()
		.then( function(result) {
			if(result) {
				$http.get('/Proveedores/authorizeCostoArticulo.json?id='+itemObj.ArticuloProveedor.id
				).then(function(response) {
				if(typeof response.data != 'undefined' && 
					typeof response.data.result != 'undefined' && response.data.result=='ok') {					
					$scope.details=response.data.details;
					axAlert(response.data.message, 'success', false);
				}
				else {
					if(typeof response.data.result != 'undefined') {
						axAlert(response.data.message, 'error', false);
					}
					else {
						axAlert('Error Desconocido', 'error', false);
					}
				}
       			});
			}
		});
	}

	$scope.detailDelete = function(index, itemObj, askConfirmation) {
		var title = 'Confirmación';
		var msg = '¿ Seguro de ELIMINAR del detalle de '+itemObj.Articulo.arcveart +
				' con el proveedor ' + $scope.master.Proveedor.prcvepro + ' ?';
		var btns = [{result:0, label: 'Cancelar'}, {result:1, label: 'OK', cssClass: 'btn-primary'}];
		$dialog.messageBox(title, msg, btns)
		.open()
		.then( function(result) {
			if(result) {
				$http.get('/Proveedores/deleteCostoArticulo.json?id='+itemObj.ArticuloProveedor.id
				).then(function(response) {
				if(typeof response.data != 'undefined' && 
					typeof response.data.result != 'undefined' && response.data.result=='ok') {					
					$scope.details=response.data.details;
					axAlert(response.data.message, 'success', false);
				}
				else {
					if(typeof response.data.result != 'undefined') {
						axAlert(response.data.message, 'error', false);
					}
					else {
						axAlert('Error Desconocido', 'error', false);
					}
				}
       			});
			}
		});
	}

	$scope.getMaterialByCve = function() {
		if($scope.currentMaterial.Articulo.text==$scope.oldValues.material) {
			return;
		}
		
		$scope.oldValues.material=$scope.currentMaterial.Articulo.text;
		
		$http.get('/Proveedores/getItemByCve.json?cve='+$scope.currentMaterial.Articulo.text
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentMaterial.Articulo=response.data.item.Articulo;
				$scope.currentMaterial.Articulo.text=$scope.currentMaterial.Articulo.arcveart;
				$scope.currentMaterial.costo='';
				$scope.currentMaterial.origen='';
				$scope.currentMaterial.composicion='';
				$scope.currentMaterial.origen='';
				$scope.currentMaterial.ancho='';
				$scope.currentMaterial.divisa_id=1;
				
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
				$scope.currentMaterial=angular.copy(emptyItem);
				$scope.currentMaterial.Articulo.text=$scope.oldValues.material;
			}
       	});
	}

	$scope.getServicioByCve = function() {
		if($scope.currentServicio.Articulo.text==$scope.oldValues.servicio) {
			return;
		}

		$scope.oldValues.servicio=$scope.currentServicio.Articulo.text;
		$http.get('/Proveedores/getItemByCve.json?cve='+$scope.currentServicio.Articulo.text
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentServicio.Articulo=response.data.item.Articulo;
				$scope.currentServicio.Articulo.text=$scope.currentServicio.Articulo.arcveart;
				$scope.currentServicio.costo=0;
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
				$scope.currentServicio=angular.copy(emptyItem);
				$scope.currentServicio.Articulo.text=$scope.oldValues.servicio;
			}
       	});
	}

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
