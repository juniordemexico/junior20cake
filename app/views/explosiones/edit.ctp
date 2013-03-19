<header>
<div class="row-fluid page-header">
<h1><span tooltip="{{master.Articulo.ardescrip}}">{{master.Articulo.arcveart}}</span> <small>{{master.Articulo.ardescrip}}</small></h1>
</div>
</header>

<div id="detailContent" class="row">

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
			<!-- Typeahead term -->
			<span tooltip="{{currentTela.ardescrip}}">
			<input type="text" maxlength="24" class="span2" id="edttelacve" name="edtTelaCve"
			ng-model="currentTela.arcveart" ui-event="{ blur : 'getTelaByCve()' }"
			placeholder="Clave de Tela..." title="{{currentTela.ardescrip}}"
			/>
			</span>
			<?php
//			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
//			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
/*
			echo $this->Html->scriptBlock($this->Js->domReady("
				var cvearttela_el = $('#edtTelaCve');
				cvearttela_el.typeahead({
					source: function(typeahead, query) {
						if(this.ajax_call)
							this.ajax_call.abort();
						this.ajax_call = $.ajax({
							dataType: 'json',
							data: {
								keyword: query,
//								proveedor_id: $('#Proveedor.id').val()
							},
							url: cvearttela_el.data('autocompleteUrl'),
							success: function(data) {
								typeahead.process(data);
							}
						});
					},
					property: 'value',

//					onselect: function (obj) {
//						AxAppCtrl.getItemByCve.val(obj.cve);
//		        	}
			    });
			"), 
			array('inline'=>false)
			);
*/
			?>
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
			<button class="btn" type="button" data-ng-click="addTela()">
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

			<span tooltip="{{currentHabilitacion.ardescrip}}">
			<input type="text" maxlength="24" class="span2"
			ng-model="currentHabilitacion.arcveart" ui-event="{ blur : 'getHabilitacionByCve()' }"
			placeholder="Clave del Material..." title="{{currentHabilitacion.ardescrip}}"
			/>
			</span>

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
			<button class="btn" type="button" data-ng-click="addHabilitacion()">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>

			<?php
			/*
			echo $this->Html->scriptBlock($this->Js->domReady("
				var cvearthabil_el = $('#edtHabilCve');
				cvearthabil_el.typeahead({
				source: function(typeahead, query) {
					if(this.ajax_call) this.ajax_call.abort();
					this.ajax_call = $.ajax({
					dataType: 'json',
					data: {
						keyword: query,
//						proveedor_id: $('#Proveedor.id').val()
					},
					url: cvearthabil_el.data('autocompleteUrl'),
					success: function(data) {
						typeahead.process(data);
					}
					});
				},
				property: 'value',
				onselect: function (obj) {
					$('#HabilId').val(obj.id);
					$('#edtHabilCve').attr('title', obj.title);
					axAlert('<strong>'+obj.value+'</strong>'+'<br/>'+obj.title, 'info', false, 'Tela');
					}
				});
			"), 
			array('inline'=>false)
			);
*/
			?>
			
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
			<!-- Typeahead term -->
			<span tooltip="{{currentSevicio.ardescrip}}">
			<input type="text" maxlength="24" class="span2"
			ng-model="currentServicio.arcveart" ui-event="{ blur : 'getServicioByCve()' }"
			placeholder="Clave del Servicio..." title="{{currentServicio.ardescrip}}"
			/>
			</span>

			<input type="text" maxlength="8"
				data-ng-model="currentServicio.cant" class="span1"
				placeholder="Cant..." 
				title="Especifique la cantidad requerida por unidad producida" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addServicio()">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>

			<?php
/*
			echo $this->Html->scriptBlock($this->Js->domReady("
				var cveartserv_el = $('#edtServicioCve');
				cveartserv_el.typeahead({
				source: function(typeahead, query) {
					if(this.ajax_call) this.ajax_call.abort();
					this.ajax_call = $.ajax({
					dataType: 'json',
					data: {
						keyword: query,
//						proveedor_id: $('#Proveedor.id').val()
					},
					url: cveartserv_el.data('autocompleteUrl'),
					success: function(data) {
						typeahead.process(data);
					}
					});
				},
				property: 'value',
				onselect: function (obj) {
					$('#ServicioId').val(obj.id);
					$('#edtServicioCve').attr('title', obj.title);
					axAlert('<strong>'+obj.value+'</strong>'+'<br/>'+obj.title, 'info', false, 'Tela');
					}
				});
			"), 
			array('inline'=>false)
			);
*/
			?>

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
</div>

<script>

angular.module('AxApp', ['ui','ui.bootstrap']);


var emptyItem={id: null, arcveart: '', ardescrip: '', cant: '', insumopropio: 0, Color:{}, ArticuloColor:[] };

var AxAppCtrl= function( $scope, $http ) {

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
		if($scope.currentTela.arcveart==$scope.oldValues.tela) {
			return;
		}
		$scope.oldValues.tela=$scope.currentTela.arcveart;
		$http.get('/Explosiones/getItemByCve/'+$scope.currentTela.arcveart
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentTela=response.data.item.Articulo;
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
			}
       	});
	
	}

	$scope.getHabilitacionByCve = function() {
		if($scope.currentHabilitacion.arcveart==$scope.oldValues.habilitacion) {
			return;
		}
		$scope.oldValues.habilitacion=$scope.currentHabilitacion.arcveart;
		$http.get('/Explosiones/getItemByCve/'+$scope.currentHabilitacion.arcveart
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentHabilitacion=response.data.item.Articulo;
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
			}
       	});
	
	}

	$scope.getServicioByCve = function() {
		if($scope.currentServicio.arcveart==$scope.oldValues.servicio) {
			return;
		}
		$scope.oldValues.servicio=$scope.currentServicio.arcveart;
		$http.get('/Explosiones/getItemByCve/'+$scope.currentServicio.arcveart
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentSevicio=response.data.item.Articulo;
				$scope.currentServicio.ArticuloColor=response.data.item.ArticuloColor;
				$scope.currentSevicio.Color={};
				$scope.currentServicio.cant=0;
				$scope.currentServicio.insumopropio=0;
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

	$scope.addTela = function() {
		tipo=1;
		$http.get('/Explosiones/add/'+$scope.master.Articulo.id+
				'/cve:'+$scope.currentTela.arcveart+'/color_id:'+$scope.currentTela.Color.id+'/cant:'+$scope.currentTela.cant+
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
				'/cve:'+$scope.currentHabilitacion.arcveart+'/color_id:'+$scope.currentHabilitacion.Color.id+'/cant:'+$scope.currentHabilitacion.cant+
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
				'/cve:'+$scope.currentSevicio.arcveart+'/cant:'+$scope.currentServicio.cant+
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

}

</script>
