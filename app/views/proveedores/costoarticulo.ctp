<header>
<div class="row page-header">
<h1>{{master.Proveedor.prcvepro}} <small>{{master.Proveedor.prnom}}</small></h1>
</div>
</header>

<?php echo $this->Form->create('Proveedor', array('action'=>'/costoarticulo', 'class'=>'form-search')); ?>

<div id="detailContent" class="row">
	<div id="detailContentMaterial" class="span6">
		<h4>Materiales relacionados:</h4><br />

		<div class="controls controls-row well well-small">
			<input class="span2" data-ng-model="currentMaterial.Articulo"
				data-ui-select2="fieldMaterial" data-ui-event="{ change : 'getMaterialByCve()' }" 
				data-item-placeholder="Clave de Material..."
				title="{{currentMaterial.Articulo.ardescrip}}" />
			<input type="text" maxlength="12" class="precio"
				data-ng-model="currentMaterial.costo"
				placeholder="Costo..." title="Costo según el proveedor especificado" />
			<button id="submitMaterial" class="btn" type="button"
			data-url="/Proveedores/addCostoArticulo"
			data-ng-click="deleteCostoArticulo(item.ArticuloProveedor.id)" 
			data-ng-disabled="(!(currentMaterial.Articulo.id>0)||!(currentMaterial.costo>0))"
			><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>
		
		<div id="detailContentMaterialTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="">Material</th>
				<th class="precio">Costo</th>
				<th class="fecha">Autorizado</th>
				<th class="st">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details.Material" id="row_{{item.ArticuloProveedor.id}}"
				class="item-row">
				<td class="" title="{{item.Articulo.ardescrip}}">{{item.Articulo.arcveart}}</td>
				<td class="precio">
					<input type="text" 
						class="cant bluraction detailCosto" 
						title="Especifica el Costo del Material" 
						placeholder="Costo..."
						data-type="changeaction"
						data-url="/Proveedores/changeCosto" 
						data-id="{{item.ArticuloProveedor.id}}" 
						data-value="{{item.Articulo.arcveart}}"
						value="{{item.ArticuloProveedor.costo}}" 
					/>
				</td>
				<td class="fecha"><span data-ng-hide="item.ArticuloProveedor.fautoriza">No</span>{{item.ArticuloProveedor.fautoriza}}</td>
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
	</div> <!-- detailContentMaterial -->


	<div id="detailContentServicio" class="span6">
		<h4>Servicios relacionados:</h4><br />
		<div class="controls controls-row well well-small">
			<input class="span2" data-ng-model="details.Servicio.Articulo"
				data-ui-select2="fieldServicio" data-ui-event="{ change : 'getServicioByCve()' }" 
				data-item-placeholder="Clave de Servicio..."
				title="{{currentServicio.Articulo.ardescrip}}" />
			<input type="text" maxlength="12" class="precio"
				data-ng-model="currentServicio.costo"
				placeholder="Costo..." title="Costo según el proveedor especificado" />
			<button id="submitServicio" class="btn" type="button"
			data-url="/Proveedores/addCostoArticulo"
			><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>
		
		<div id="detailContentServicioTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="">Material</th>
				<th class="precio">Costo</th>
				<th class="fecha">Autorizado</th>
				<th class="st">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details.Servicio" id="row_{{item.ArticuloProveedor.id}}"
				class="item-row">
				<td class="" title="{{item.Articulo.ardescrip}}">{{item.Articulo.arcveart}}</td>
				<td class="precio">
					<input type="text" 
						class="cant bluraction detailCosto" 
						title="Especifica el Costo del Servicio" 
						placeholder="Costo..."
						data-type="changeaction"
						data-url="/Proveedores/changeCosto" 
						data-id="{{item.ArticuloProveedor.id}}" 
						data-value="{{item.Articulo.arcveart}}"
						value="{{item.ArticuloProveedor.costo}}" 
					/>
				</td>
				<td class="fecha">{{item.ArticuloProveedor.fautoriza}}</td>
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
	</div> <!-- detailContentServicio -->

	</div> <!-- detailContent -->
<?php echo $this->Form->End();?>



<?php

$this->Js->get('#submitMaterial')->event(
'click', "

var el=$('#'+this.id);
var theProveedorID=$('#ProveedorId').val();
var theCve=$('#edtMaterialCve').val();
var thePCosto=$('#edtMaterialPCosto').val();
var theUrl=el.data('url');

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theProveedorID+'/cve:'+theCve+'/pcosto:'+thePCosto,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert(data, 'success', false);
			$('#detailContentMaterialTable').load('/Proveedores/detailcostomaterial/'+theProveedorID);
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



// Add Detail Button Event::SERVICIOS

$this->Js->get('#submitServicio')->event(
'click', "

var el=$('#'+this.id);
var theProveedorID=$('#ProveedorId').val();
var theCve=$('#edtServicioCve').val();
var thePCosto = $('#edtServicioPCosto').val();
var theUrl =el.data('url');

$.ajax({
	dataType: 'html',
	type: 'post',
	url: theUrl+'/'+theProveedorID+'/cve:'+theCve+'/pcosto:'+thePCosto,
	success: function (data, textStatus) {
		if(data.substring(0,2)=='OK') {
			axAlert(data, 'success', false);
			$('#detailContentServicioTable').load('/Proveedores/detailcostoservicio/'+theProveedorID);
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

// Event for Changing an item's costo

$this->Js->get('.detailCosto')->event(
'blur', "
var el=$('#'+this.id);
var theID=el.data('id');
var theCve=el.data('value');
var theValue=el.val();
var theUrl=el.data('url');

if(!(theValue>0)) return;

$.ajax({
	dataType: 'html', 
	type: 'post',
	url: theUrl+'/'+theID+'?costo='+theValue,
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

?>

<script>

var emptyItem={Articulo: {id: null, text: '', title:''}, costo: '0' };
	
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

				
	$scope.actions={	setItem: $scope.base.url+'/'+$scope.base.controller+'/'+'addMaterial',
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

	$scope.oldValues={"material":"","servicio":""};
	
	$scope.currentMaterial=JSON.parse(JSON.stringify(emptyItem));
	$scope.currentServicio=JSON.parse(JSON.stringify(emptyItem));

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
				$scope.currentMaterial.costo=0;
				axAlert(response.data.message, 'success', false);
			}
			else {
				if(typeof response.data.result != 'undefined') {
					axAlert(response.data.message, 'error', false);
				}
				else {
					axAlert('Error Desconocido', 'error', false);
				}
				$scope.currentMaterial=JSON.parse(JSON.stringify(emptyItem));
				$scope.currentMaterial.Articulo.text=$scope.oldValues.material;
			}
       	});
	}

	$scope.detailDelete = function(id, itemObj, askConfirmation) {
		bootbox.confirm('Seguro de ELIMINAR el costo de ' + itemObj.Articulo.arcveart + 
						' con el proveedor ' + $scope.master.Proveedor.prcvepro + ' ? ::'+itemObj.ArticuloProveedor.id, 
		function(result) {
    		if (result) {
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


});

</script>
