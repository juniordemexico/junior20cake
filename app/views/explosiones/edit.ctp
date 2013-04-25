<header>
<div class="row page-header">
<h1>
{{master.Articulo.arcveart}} <small>{{master.Articulo.ardescrip}}</small>
</h1>
</div>
</header>

<?php echo $this->Form->create('Explosion', array('action'=>'/add', 'class'=>'form')); ?>

<tabs id="tabs">

<pane id="tabs-0" heading="Caracteristicas">
	<div class="control-group">
		<label for="ExplosiondatosMolde" class="control-label">Molde:</label>
		<div class="controls input">
			<input type="text" id="ExplosiondatosMolde" data-ng-model="master.Explosiondatos.molde" name="data[Explosiondatos][molde]" field="Explosiondatos.Molde" class="span4" maxlenght="32" placeholder="Código del Molde..." />
		</div>
	</div>
</pane>

<pane id="tabs-1" heading="Telas">
		<div class="controls controls-row well well-small">
			<input class="span2" data-ng-model="currentTela.Articulo"
				data-ui-select2="fieldTela" data-ui-event="{ change : 'getTelaByCve()' }" 
				data-item-placeholder="Clave de Tela..."
				title="{{currentTela.Articulo.ardescrip}}" />

			<select class="span2" data-ng-model="currentTela.Color" data-ng-options="c.cve for c in currentTela.ArticuloColor" >
			</select>
			<input type="text" maxlength="8"
				data-ng-model="currentTela.cant" class="span1"
				placeholder="Trazo..." 
				title="Especifique la cantidad requerida por unidad producida" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" class="detailPropio"
				data-ng-model="currentTela.insumopropio"
				title="Marcar en caso de ser un insumo propio" />
			Insumo Propio
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addTela()" 
				data-ng-disabled="(!(currentTela.Articulo.id>0)||!(currentTela.cant>0))">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>
		</div>

		<div id="detailContentTelaTable">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="span2">Tela</th>
				<th class="">Descripción</th>
				<th class="span2">Color</th>
				<th class="span1">Trazo</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details.tela" id="row_{{item.Explosion.id}}" class="item-row">
				<td class="span2">{{item.Articulo.arcveart}}</td>
				<td class="">{{item.Articulo.ardescrip}}</td>
				<td class="span2">{{item.Color.cve}}</td>
				<td class="span1">
					<input type="text" class="cant" data-ng-model="item.Explosion.cant" ui-event="{ blur : 'updateCantidad(item.Explosion.id,item.Explosion.cant)' }" title="Especifica la cantidad de la Tela" />
				</td>
				<td class="span1">
					<input type="checkbox" 
						ng-checked="item.Explosion.insumopropio==1"
						data-ng-click="toggleInsumoPropio(item.Explosion.id, item)" 
						title="Marcar en caso de ser un insumo propio"
					/>
				</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete(item.Explosion.id, item, true)"
					>
							<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>

</pane> <!-- div tabs0 -->

<pane id="tabs-2" heading="Habilitación">

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->			

			<input class="span2" data-ng-model="currentHabilitacion.Articulo"
				data-ui-select2="fieldHabilitacion" data-ui-event="{ change : 'getHabilitacionByCve()' }" 
				data-item-placeholder="Clave de Material..."
				title="{{currentHabilitacion.Articulo.ardescrip}}" />

			<select class="span2" data-ng-model="currentHabilitacion.Color" data-ng-options="c.cve for c in currentHabilitacion.ArticuloColor" >
			</select>
			<input type="text" maxlength="8"
				data-ng-model="currentHabilitacion.cant" class="span1"
				placeholder="Cant..." 
				title="Especifique la cantidad requerida por unidad producida" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" class="detailPropio"
				data-ng-model="currentHabilitacion.insumopropio"
				title="Marcar en caso de ser un insumo propio" />
			Insumo Propio
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addHabilitacion()" 
				data-ng-disabled="(!(currentHabilitacion.Articulo.id>0)||!(currentHabilitacion.cant>0))">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>
			
		</div>

		<div id="detailContentHabilTable">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="span2">Material</th>
				<th class="">Descripcion</th>
				<th class="span2">Color</th>
				<th class="span1">Cantidad</th>
				<th class="span1">Inventario Propio</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details.habilitacion" id="row_{{item.Explosion.id}}" class="item-row">
				<td class="span2">{{item.Articulo.arcveart}}</td>
				<td class="">{{item.Articulo.ardescrip}}</td>
				<td class="span2">{{item.Color.cve}}</td>
				<td class="span1">
					<input type="text" class="cant" ui-event="{ blur : 'updateCantidad(item.Explosion.id,item.Explosion.cant)' }" data-ng-model="item.Explosion.cant"  title="Especifica la cantidad del Material" />
				</td>
				<td class="span1">
					<input type="checkbox" 
						ng-checked="item.Explosion.insumopropio==1"
						data-ng-click="toggleInsumoPropio(item.Explosion.id, item)" 
						title="Marcar en caso de ser un insumo propio"
					/>
				</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete(item.Explosion.id, item, true)"
					>
							<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>

</pane> <!-- div tabs1 -->

<pane id="tabs-3" heading="Servicios">

		<div class="controls controls-row well well-small">
			<input class="span2" data-ng-model="currentServicio.Articulo"
				data-ui-select2="fieldServicio" data-ui-event="{ change : 'getServicioByCve()' }" 
				data-item-placeholder="Clave de Servicio..."
				title="{{currentServicio.Articulo.ardescrip}}" />

			<input type="text" maxlength="8"
				data-ng-model="currentServicio.cant" class="span1"
				placeholder="Cant..." 
				title="Especifique la cantidad requerida por unidad producida" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addServicio()" 
				data-ng-disabled="(!(currentServicio.Articulo.id>0)||!(currentServicio.cant>0))">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>
		</div>

		<div id="detailContentServicioTable">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th class="span2">Servicio</th>
				<th class="">Descripcion</th>
				<th class="span1">Cantidad</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details.servicio" id="row_{{item.Explosion.id}}" class="item-row">
				<td class="span2">{{item.Articulo.arcveart}}</td>
				<td class="">{{item.Articulo.ardescrip}}</td>
				<td class="span1">
					<input type="text" class="cant" ui-event="{ blur : 'updateCantidad(item.Explosion.id,item.Explosion.cant)' }" 
						data-ng-model="item.Explosion.cant" title="Especifica la cantidad del Servicio" />
				</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete(item.Explosion.id, item, true)"
					>
							<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>

</pane> <!-- div tabs2 -->

</tabs> <!-- div tabbable -->

<?php echo $this->Form->end();?>


<script>


var emptyItem={Articulo: {id: null, text: '', title:''}, cant: '', insumopropio: 0, Color:{}, ArticuloColor:[] };
	
myAxApp.controller('AxAppCtrl', function( $scope, $http ) {

	/* Main View Configuration, Routes and other symbols */
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
	$scope.base={
				url: '/<?php e($this->name)?>',
				controller: '<?php e($this->name)?>',
				action: '<?php echo $this->action;?>'
				};

	$scope.user={
				id: <?php e($session->read('Auth.User.id'));?>,
				username: '<?php e($session->read('Auth.User.username'))?>',
				group_id: <?php e($session->read('Auth.User.group_id'))?>
				};

	$scope.actions={	setItem: $scope.base.url+'/'+$scope.base.controller+'/'+'addTela',
						changeItem: $scope.base.url+'/'+$scope.base.controller+'/'+'changeitem'
					};

	$scope.date=new Date();

	/* Sets the data object/array generated by the CakePHP's controller  */
	// ------------Begin Controller's Data----------------------------------------
	$scope._data=<?php e(json_encode($this->data));?>;
	// ------------End Controller's Data------------------------------------------


	/* Begins the angular controller's code specific to this View */

	$scope.master=$scope._data.master;
	$scope.details=$scope._data.details;

	$scope.oldValues={"tela":"","habilitacion":"","servicio":""};
	
	$scope.currentTela=JSON.parse(JSON.stringify(emptyItem));
	$scope.currentHabilitacion=JSON.parse(JSON.stringify(emptyItem));
	$scope.currentServicio=JSON.parse(JSON.stringify(emptyItem));

	$scope.addTela = function () { $scope.addItem(1, $scope.currentTela ); }
	$scope.addHabilitacion = function () { $scope.addItem(2, $scope.currentHabilitacion ); }
	$scope.addServicio = function () { $scope.addItem(3, $scope.currentServicio ); }

	$scope.addItem = function( tipoexplosion_id, current ) {
	
		$http.get('/Explosiones/add.json'+
				'?articulo_id='+$scope.master.Articulo.id+
				'&material_id='+current.Articulo.id+
				'&color_id='+current.Color.id+
				'&cant='+current.cant+
				'&insumopropio='+(typeof current.insumopropio != 'undefined' && current.insumopropio==true?1:0)+
				'&tipoexplosion_id='+tipoexplosion_id
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

	$scope.detailDelete = function(id, itemObj, askConfirmation) {
		bootbox.confirm('Seguro de ELIMINAR la partida ' + itemObj.Articulo.arcveart + ' de la explosion ?', 
		function(result) {
    		if (result) {
				$http.get('/Explosiones/deleteItem.json?id='+id
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

	$scope.toggleInsumoPropio = function(id, itemObj) {
		$http.get('/Explosiones/toggleInsumoPropio/'+id
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

	$scope.updateCantidad = function(id, value) {
		$http.get('/Explosiones/updateCantidad/'+id+'/'+value
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


	$scope.getTelaByCve = function() {
		if($scope.currentTela.Articulo.text==$scope.oldValues.tela) {
			return;
		}
		
		$scope.oldValues.tela=$scope.currentTela.Articulo.text;

		$http.get('/Explosiones/getItemByCve.json'+
				'?articulo_id='+$scope.master.Articulo.id+
				'&cve='+$scope.currentTela.Articulo.text
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentTela.Articulo=response.data.item.Articulo;
				$scope.currentTela.Articulo.text=$scope.currentTela.Articulo.arcveart;
				$scope.currentTela.ArticuloColor=response.data.item.ArticuloColor;
				$scope.currentTela.Color=response.data.item.ArticuloColor[0];
				$scope.currentTela.cant=0;
				$scope.currentTela.insumopropio=0;
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
				$scope.currentTela=JSON.parse(JSON.stringify(emptyItem));
				$scope.currentTela.Articulo.text=$scope.oldValues.tela;
			}
       	});
	}

	$scope.getHabilitacionByCve = function() {
		if($scope.currentHabilitacion.Articulo.text==$scope.oldValues.habilitacion) {
			return;
		}
		$scope.oldValues.habilitacion=$scope.currentHabilitacion.Articulo.text;

		$http.get('/Explosiones/getItemByCve.json'+
				'?articulo_id='+$scope.master.Articulo.id+
				'&cve='+$scope.currentHabilitacion.Articulo.text
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentHabilitacion.Articulo=response.data.item.Articulo;
				$scope.currentHabilitacion.Articulo.text=$scope.currentHabilitacion.Articulo.arcveart;
				$scope.currentHabilitacion.ArticuloColor=response.data.item.ArticuloColor;
				$scope.currentHabilitacion.Color=response.data.item.ArticuloColor[0];
				$scope.currentHabilitacion.cant=0;
				$scope.currentHabilitacion.insumopropio=0;
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
				$scope.currentHabilitacion=JSON.parse(JSON.stringify(emptyItem));
				$scope.currentHabilitacion.Articulo.text=$scope.oldValues.habilitacion;
			}
       	});	
	}


	$scope.getServicioByCve = function() {
		if($scope.currentServicio.Articulo.arcveart==$scope.oldValues.servicio) {
			return;
		}
		$scope.oldValues.servicio=$scope.currentServicio.Articulo.text;

		$http.get('/Explosiones/getItemByCve.json'+
				'?articulo_id='+$scope.master.Articulo.id+
				'&cve='+$scope.currentServicio.Articulo.text
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentServicio.Articulo=response.data.item.Articulo;
				$scope.currentServicio.Articulo.text=$scope.currentServicio.Articulo.arcveart;
				$scope.currentServicio.ArticuloColor=response.data.item.ArticuloColor;
				$scope.currentServicio.Color=response.data.item.ArticuloColor[0];
				$scope.currentServicio.cant=0;
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
				$scope.currentServicio=JSON.parse(JSON.stringify(emptyItem));
				$scope.currentServicio.Articulo.text=$scope.oldValues.servicio;
			}
       	});
	
	}


	// Binds and initializates a Twitter Bootstrap's Typeahead inside our AngularJS context
	$scope.fieldTela = {
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

	$scope.fieldHabilitacion = {
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

});


</script>
