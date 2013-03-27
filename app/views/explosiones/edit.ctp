<header>
<div class="row page-header">
<h1>
{{master.Articulo.arcveart}} <small>{{master.Articulo.ardescrip}}</small>
</h1>
</div>
</header>

<?php echo $this->Form->create('Explosion', array('action'=>'/add', 'class'=>'form-search')); ?>
<?php echo $this->Form->hidden('Articulo.id', array("value"=>$articulo['Articulo']['id'])); ?>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Telas</a></li>
		<li><a href="#tabs-1" data-toggle="tab">Habilitación</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Servicios</a></li>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">

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

</div> <!-- div tabs0 -->

<div id="tabs-1" class="tab-pane">

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

</div> <!-- div tabs1 -->

<div id="tabs-2" class="tab-pane">

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

</div> <!-- div tabs2 -->

</div> <!-- div tab-content -->

</div> <!-- div tabbable -->

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
	
	$scope.getTelaByCve = function() {
		if($scope.currentTela.Articulo.text==$scope.oldValues.tela) {
			return;
		}
		
		$scope.oldValues.tela=$scope.currentTela.Articulo.text;
		
		$http.get('/Explosiones/getItemByCve/'+$scope.currentTela.Articulo.text
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
		$http.get('/Explosiones/getItemByCve/'+$scope.currentHabilitacion.Articulo.text
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
		$http.get('/Explosiones/getItemByCve/'+$scope.currentServicio.Articulo.text
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

	$scope.addTela = function() {
		tipo=1;
		$http.get('/Explosiones/add/'+$scope.master.Articulo.id+
				'/cve:'+$scope.currentTela.Articulo.arcveart+'/color_id:'+$scope.currentTela.Color.id+'/cant:'+$scope.currentTela.cant+
				'/insumopropio:'+($scope.currentTela.insumopropio==true?1:0)+'/tipoexplosionid:'+tipo
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

	$scope.addHabilitacion = function() {
		tipo=1;
		$http.get('/Explosiones/add/'+$scope.master.Articulo.id+
				'/cve:'+$scope.currentHabilitacion.Articulo.arcveart+'/color_id:'+$scope.currentHabilitacion.Color.id+'/cant:'+$scope.currentHabilitacion.cant+
				'/insumopropio:'+($scope.currentHabilitacion.insumopropio==true?1:0)+'/tipoexplosionid:'+tipo
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

	$scope.addServicio = function() {
		tipo=2;
		$http.get('/Explosiones/add/'+$scope.master.Articulo.id+
				'/cve:'+$scope.currentSevicio.Articulo.arcveart+'/color_id:'+$scope.currentServicio.Color.id+'/cant:'+$scope.currentServicio.cant+
				'/tipoexplosionid:'+tipo
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
				$http.get('/Explosiones/deleteItem/'+id
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

	// Binds and initializates a Twitter Bootstrap's Typeahead inside our AngularJS context
	$scope.bindTypeahead = function (el_id, func) {
	var	el=angular.element(document.getElementById(el_id));
	el.typeahead({
		source: function(typeahead, query) {
			if(this.ajax_call) this.ajax_call.abort();
			this.ajax_call = $.ajax({
				dataType: 'json',
				data: {	keyword: query },
				url: el.data('autocompleteUrl'),
				success: function(data) {
					typeahead.process(data);
				}
			});
		},
		property: 'value',
		onselect: function (obj) {
			setTimeout( function() {
				eval('$scope.'+el.data('ng-model')+' = obj.'+el.data('ng-onselect-field'));
				eval('$scope.'+func);
			}, 250);
       	}
	});
		
	}

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


/*

<p>
<div class="input-append">
<input type="text" name="data[Explosion][date]" data-ng-model="date" data-ui-date class="span2 ax-datepicker" placeholder="aaaa-mm-dd..." />
<span class="add-on"><i class="icon icon-calendar"></i></span>
</div>
</p>

<p>
	<select ui-select2 ng-model="perro" data-placeholder="Estado...">
			<option data-ng-repeat="item in datos" value="{{item}}">{{item}}</option>
	</select>
	<div class="pre">
		Model: {{perro}}
	</div>
</p>

			<input type="text" maxlength="24" class="span2 ax-autocomplete" 
			id="edttelacve" name="edtTelaCve"
			data-ng-model="currentTela.arcveart" data-ng-init="bindTypeahead('edttelacve', 'getTelaByCve()')"
			data-items="8" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1" data-ng-onselect-field="value"
			placeholder="Clave de Tela..." title="{{currentTela.ardescrip}}"
			/>

<body ng-controller="MainCtrl">
  <h1>Select2 + AJAX Demos</h1>
  <p><a href="https://gist.github.com/4279651">Fork the Original Gist</a></p>
  <h3>Version 1</h3>
  <p>Use a regular <code>&lt;select&gt;</code> tag and <code>ng-repeat</code></p>
  <pre>Selected: {{version1model|json}}</pre>
  <select ui-select2 ng-model="version1model" data-placeholder="-- Select One --" style="width:200px">
    <option></option>
    <option ng-repeat="item in items" value="{{item.id}}">{{item.text}}</option>
  </select>
  <h3>Version 2</h3>
  <p>Write your own Select2 query function</p>
  <pre>Selected: {{version2model|json}}</pre>
  <input ui-select2="version2" ng-model="version2model" style="width:200px" />
  <h3>Version 3</h3>
  <p>Use the Select2 data property, and preserve the reference</p>
  <pre>Selected: {{version3model|json}}</pre>
  <input ui-select2="version3" ng-model="version3model" style="width:200px" />
  <h3>Version 4</h3>
  <p>Use the Select2 ajax property</p>
  <pre>Selected: {{version4model|json}}</pre>
  <input ui-select2="version4" ng-model="version4model" style="width:200px" />
</body>
</html>





var app = angular.module('plunker', ['ui']);

app.controller('MainCtrl', function($scope, $http) {
  var items;
  

 var items;
  
  $http.get('data.json').success(function(response){
    // Version 1
    $scope.items = response;
    
    // Version 2
    items = response;
    
    // Version 3
    angular.extend($scope.version3.data, response);
  });

  // Requires us to write comparison code ourselves :(
  $scope.version2 = {
    query: function (query) {
      var data = {results: []};
      angular.forEach(items, function(item, key){
        if (query.term.toUpperCase() === item.text.substring(0, query.term.length).toUpperCase()) {
          data.results.push(item);
        }
      });
      query.callback(data);
    }
  };
    
  // Simply updating an existing reference :) (refer to $http.get() above)
  $scope.version3 = {
    data: []
  };
  
  // Built-in support for ajax
  $scope.version4 = {
    ajax: {
      url: "data.json",
      data: function (term, page) {
        return {}; // query params go here
      },
      results: function (data, page) { // parse the results into the format expected by Select2.
        // since we are using custom formatting functions we do not need to alter remote JSON data
        return {results: data};
      }
    }
  }
});
*/
</script>
