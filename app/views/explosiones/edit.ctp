<header>
<div class="row-fluid page-header">
<h1>{{master.Articulo.arcveart}} <small>{{master.Articulo.ardescrip}}</small></h1>
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

			<input type="hidden" maxlength="16" id="TelaId" name="data[Explosion][TelaId]"/>

			<input type="text" maxlength="24" id="edtTelaCve" name="data[Explosion][Telacve]" 
			class="span2" placeholder="Clave de Tela..."
			ng-model="currentTela.arcveart"
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			title="{{currentTela.ardescrip}}" ui-reset=" 'kaka' "
			/>

			<?php

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
					onselect: function (obj) {
						$('#MaterialId').val(obj.id);
						$('#edtTelaCve').attr('title', obj.title);
						axAlert('<strong>'+obj.value+'</strong>'+'<br/>'+obj.title, 'info', false, 'Tela');
		        	}
			    });
			"), 
			array('inline'=>false)
			);
			?>

			<input type="text" maxlength="8" id="edtTelaCant" name="data[Explosion][TelaCant]"
				ng-model="currentTela.cant" class="span1"
				placeholder="Trazo..." 
				title="Especifique la cantidad requerida por unidad producida" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" class="detailPropio" id="chkTelaInsumoPropio" name="data[Explosion][TelaPropio]"
				ng-model="currentTela.insumopropio"
				title="Marcar en caso de ser un insumo propio" />
			Insumo Propio
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button id="submitTela" class="btn" type="button" 
			data-url="/Explosiones/add"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

		<div id="detailContentTelaTable" class="row">
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
					<input type="text" class="cant" data-ng-model="item.Explosion.cant" title="Especifica la cantidad de la Tela" />
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

			<input type="hidden" maxlength="16" id="HabilId" name="data[Explosion][HabilId]"/>

			<input type="text" maxlength="24" id="edtHabilCve" name="data[Explosion][HabilCve]"
				class="span2"
				ng-model="currentHabilitacion.arcveart" ui-reset
				data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
				data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			 	placeholder="Clave del Material..."
				title="{{currentHabilitacion.ardescrip}}"
			/>
			<input type="text" maxlength="8" id="edtHabilCant" name="data[Explosion][HabilCant]" 
				ng-model="currentHabilitacion.cant" class="span1"
				placeholder="Cant..." title="Especifique la cantidad requerida por unidad producida" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="checkbox" class="detailPropio" id="chkHabilInsumoPropio" name="data[Explosion][HabilPropio]"
				ng-model="currentHabilitacion.insumopropio"
				title="Marcar en caso de ser un insumo propio"
			/>
			Insumo Propio
			&nbsp;&nbsp;&nbsp;&nbsp;

			<button id="submitHabil" class="btn" type="button"
			data-url="/Explosiones/add"
			>
			<i class="icon icon-plus-sign"></i> Agregar</button>

			<?php
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
			?>
			
		</div>

		<div id="detailContentHabilTable" class="row">
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
					<input type="text" class="cant" data-ng-model="item.Explosion.cant" data-ng-change="updateCantidad(item.Explosion.id,item.Explosion.cant)" title="Especifica la cantidad de la Tela" />
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
			<input type="hidden" maxlength="24" id="ServicioId" name="data[Explosion][ServicioId]"/>

			<input type="text" maxlength="16" id="edtServicioCve" name="data[Explosion][ServicioCve]"
				ng-model="currentServicio.arcveart" class="span2" 
				placeholder="Clave del Servicio..." ui-reset
				data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
				data-autocomplete-url="/Articulos/autocomplete/tipo:2"
				title="{{currentServicio.ardescrip}}"
			/> &nbsp;&nbsp;
			<input type="text" maxlength="16" id="edtServicioCant" name="data[Explosion][ServicioCant]" class="span1"
			ng-model="currentServicio.cant" 
			placeholder="Cant..." 
			title="Especifique la cantidad requerida por unidad producida" />
			<button id="submitServicio" class="btn" type="button"
			data-url="/Explosiones/add"
			>
			<i class="icon icon-plus-sign"></i> Agregar</button>

			<?php
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
					<input type="text" class="cant" data-ng-model="item.Explosion.cant" title="Especifica la cantidad de la Tela" />
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

<?php

// Event for Changing an item's costo

$this->Js->get('.detailCantidad')->event(
'blur', "

var el=$('#'+this.id);
var theID=el.data('id');
var theCve=el.data('value');
var theValue=el.val();
var theUrl=el.data('url');

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theID+'?value='+theValue,
	success: function (data, textStatus) {
		if(data=='OK') {
			axAlert('Insumo ' + theCve + ' Actualizado con Costo ' + theValue, 'success', false);
			return true;
		}
		else {
			axAlert('Respuesta ('+textStatus+'):<br />'+data, 'error');
			return false;
		}
	},
});

"
, array('stop' => true));



// Add Detail Button Event

$this->Js->get('#submitTela')->event(
'click', "

var el=$('#'+this.id);
var theTipoExplosion=1;
var theArticuloID=$('#ArticuloId').val();
var theCve=$('#edtTelaCve').val();
var theCant=$('#edtTelaCant').val();
var theInsumoPropio=(($('#chkTelaInsumoPropio').attr('checked')=='checked')?1:0);
var theUrl=el.data('url');

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theArticuloID+'/cve:'+theCve+'/cant:'+theCant+'/insumopropio:'+theInsumoPropio+'/tipoexplosionid:'+theTipoExplosion,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert(data, 'success', false);
			$('#detailContentTelaTable').load('/Explosiones/detailtela/'+theArticuloID);
			return true;
		}
		else {
			axAlert('Respuesta ('+textStatus+'):<br />'+data, 'error');
			return false;
		}
	},
});

"
, array('stop' => true));

$this->Js->get('#submitHabil')->event(
'click', "

var el=$('#'+this.id);
var theTipoExplosion=1;
var theArticuloID=$('#ArticuloId').val();
var theCve=$('#edtHabilCve').val();
var theCant=$('#edtHabilCant').val();
var theInsumoPropio=(($('#chkHabilInsumoPropio').attr('checked')=='checked')?1:0);
var theUrl=el.data('url');

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theArticuloID+'/cve:'+theCve+'/cant:'+theCant+'/insumopropio:'+theInsumoPropio+'/tipoexplosionid:'+theTipoExplosion,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert(data, 'success', false);
			$('#detailContentHabilTable').load('/Explosiones/detailhabil/'+theArticuloID);
			return true;
		}
		else {
			axAlert('Respuesta ('+textStatus+'):<br />'+data, 'error');
			return false;
		}
	},
});

"
, array('stop' => true));


$this->Js->get('#submitServicio')->event(
'click', "

var el=$('#'+this.id);
var theTipoExplosion=2;
var theArticuloID=$('#ArticuloId').val();
var theCve=$('#edtServicioCve').val();
var theCant=$('#edtServicioCant').val();
var theUrl=el.data('url');

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theArticuloID+'/cve:'+theCve+'/cant:'+theCant+'/tipoexplosionid:'+theTipoExplosion,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert(data, 'success', false);
			$('#detailContentServicioTable').load('/Explosiones/detailservicio/'+theArticuloID);
			return true;
		}
		else {
			axAlert('Respuesta ('+textStatus+'):<br />'+data, 'error');
			return false;
		}
	},
});

"
, array('stop' => true));
?>

<script>

var emptyItem={id: null, arcveart: '', ardescrip: '', cant: '', insumopropio: 0};

function AxAppCtrl( $scope, $http ) {

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

				
	$scope.actions={	setItem: $scope.base.url+'/'+$scope.base.controller+'/'+'additem',
						changeItem: $scope.base.url+'/'+$scope.base.controller+'/'+'changeitem'
					};

	/* Sets the data object/array generated by the CakePHP's controller  */
	// ------------Begin Controller's Data----------------------------------------
	$scope._data=<?php e(json_encode($this->data));?>;
	// ------------End Controller's Data------------------------------------------


	/* Begins the angular controller's code specific to this View */

	$scope.master=$scope._data.master;
	$scope.details=$scope._data.details;

/*
	$scope.currentTela= JSON.parse(JSON.stringify(emptyItem));
	$scope.currentHabilitacion=JSON.parse(JSON.stringify(emptyItem));
	$scope.currentServicios=JSON.parse(JSON.stringify(emptyItem));
*/	
	// Set an Item's Cost
	$scope.setCosto = function(explosion_id, proveedor_id) {
		$http.get('/Costeos/setcosto/'+$scope.currentMaster.Articulo.id+
		'?explosion_id='+explosion_id+'&proveedor_id='+proveedor_id
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope._data=response.data.data;

				$scope.currentMaster=$scope._data.master;
				$scope.currentTela=$scope._data.details.tela;
				$scope.currentHabilitacion=$scope._data.details.habilitacion;
				$scope.currentServicio=$scope._data.details.servicio;

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
//				axAlert(response.data.message, 'success', false);
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

/*
	$('.detailCantidad').bind('blur', function() {
		if($scope.ubicacion.cve!=$scope.lastUbicacionCve) {
			$scope.lastUbicacionCve=$scope.ubicacion.cve;
			$scope.getUbicacion();
			if($('#artcve').val()!='') {
				$('#edtcantidad').focus();
			}
			else {
				$('#artcve').focus();				
			}

		}
	});
*/

}

</script>
