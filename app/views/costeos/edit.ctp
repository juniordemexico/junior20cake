<div id="detailContent" class="row-fluid" ng-controller="AxAppController">

<?php echo $this->Form->create('Explosion', array('action'=>'/add', 'class'=>'form-search')); ?>
<?php echo $this->Form->hidden('Articulo.id'); ?>

<div class="page-header">
<h1>{{currentMaster.Articulo.arcveart}}	<small>{{currentMaster.Articulo.ardescrip}}</small>
</h1>
</div>

<div class="well">
	Telas: {{total.tela}} <br/>
	Habilitación: {{total.habilitacion}}<br/>
	Servicios: {{total.servicio}}<br/>
	Costeo Total: {{total.tela+total.habilitacion+total.servicio}}<br/>
</div>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab">Telas</a></li>
		<li><a href=" #tabs-1" data-toggle="tab">Habilitación</a></li>
		<li><a href="#tabs-2" data-toggle="tab">Servicios</a></li>
	</ul>

<div class="tab-content">

<div id="tabs-0" class="tab-pane active">

		<div id="detailContentTelaTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="span2">Tela</th>
				<th class="">Descripcion</th>
				<th class="span2">Promedio</th>
				<th class="span3">Costo</th>
				<th class="span1">Inventario Propio</th>
			</tr>
			</thead>
			<tbody>
			<tr id="{{itemTela.Explosion.id}}" class="t-row" ng-repeat="itemTela in currentTela">
				<td class="span2" id="{{itemTela.Explosion.material_id}}">{{itemTela.Articulo.arcveart}}</td>
				<td class="">{{itemTela.Articulo.ardescrip}}</td>
				<td class="span1">{{itemTela.Explosion.cant}}</td>
				<td class="span3">

				<div class="btn-group" ng-show="itemTela.Costo[0].ArticuloProveedor.proveedor_id>0">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
						<strong>{{itemTela.Explosion.pcosto}}</strong>
						({{itemTela.Proveedor.prcvepro}})

						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">					
						<li ng-repeat="itemCostoTela in itemTela.Costo" ng-click="setCosto(itemTela.Explosion.id,itemCostoTela.ArticuloProveedor.proveedor_id)">
						{{itemCostoTela.ArticuloProveedor.costo}}
						<small>(
						<strong>{{itemCostoTela.Proveedor.prcvepro}}</strong>
						{{itemCostoTela.Proveedor.prnom}}
						)</small>
						</li>
  					</ul>
				</div>

				</td>
				<td class="span1"><i class="icon icon-ok" ng-show="itemTela.Explosion.insumopropio"></i></td>
			</tr>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs0 -->

<div id="tabs-1" class="tab-pane">

		<div id="detailContentHabilitacionTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="cveart">Material</th>
				<th class="">Descripcion</th>
				<th class="span1">Cantidad</th>
				<th class="span3">Costo</th>
				<th class="span1">Inventario Propio</th>
			</tr>
			</thead>
			<tbody>
			<tr id="{{itemHabilitacion.Explosion.id}}" class="t-row" ng-repeat="itemHabilitacion in currentHabilitacion">
				<td class="span2" id="{{itemHabilitacion.Explosion.material_id}}">{{itemHabilitacion.Articulo.arcveart}}</td>
				<td class="">{{itemHabilitacion.Articulo.ardescrip}}</td>
				<td class="span1">{{itemHabilitacion.Explosion.cant}}</td>
				<td class="span3">
				<div class="btn-group" ng-show="itemHabilitacion.Costo[0].ArticuloProveedor.proveedor_id>0">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
						<strong>{{itemHabilitacion.Explosion.pcosto}}</strong>
						({{itemHabilitacion.Proveedor.prcvepro}})

						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">					
						<li ng-repeat="itemCostoHabilitacion in itemHabilitacion.Costo" ng-click="setCosto(itemHabilitacion.Explosion.id,itemCostoHabilitacion.ArticuloProveedor.proveedor_id)">
						{{itemCostoHabilitacion.ArticuloProveedor.costo}} 
						<small>(
						<strong>{{itemCostoHabilitacion.Proveedor.prcvepro}}</strong>
						{{itemCostoHabilitacion.Proveedor.prnom}}
						)</small>
						</li>
  					</ul>
				</div>

				</td>
				<td class="span1"><i class="icon icon-ok" ng-show="itemHabilitacion.Explosion.insumopropio"></i></td>
			</tr>
			</tbody>
		</table>
		</div>

</div> <!-- div tabs1 -->

<div id="tabs-2" class="tab-pane">

		<div id="detailContentServicioTable">
		<table class="table table-condensed">
			<thead>
			<tr>
				<th class="cveart">Servicio</th>
				<th class="">Descripcion</th>
				<th class="span2">Cantidad</th>
				<th class="span3">Costo</th>
			</tr>
			</thead>
			<tbody>
			<tr id="{{itemServicio.Explosion.id}}" class="t-row" ng-repeat="itemServicio in currentServicio">
				<td class="span2" id="{{itemServicio.Explosion.material_id}}">{{itemServicio.Articulo.arcveart}}</td>
				<td class="">{{itemServicio.Articulo.ardescrip}}</td>
				<td class="span1">{{itemServicio.Explosion.cant}}</td>
				<td class="span3">
				<div class="btn-group" ng-show="itemServicio.Costo[0].ArticuloProveedor.proveedor_id>0">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
						<strong>{{itemServicio.Explosion.pcosto}}</strong>
						({{itemServicio.Proveedor.prcvepro}})

						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">					
						<li ng-repeat="itemCostoServicio in itemServicio.Costo" ng-click="setCosto(itemServicio.Explosion.id,itemServicio.ArticuloProveedor.proveedor_id)">
						{{itemCostoServicio.ArticuloProveedor.costo}}
						<small>(
						<strong>{{itemCostoServicio.Proveedor.prcvepro}}</strong>
						{{itemCostoServicio.Proveedor.prnom}}
						)</small>
						</li>
  					</ul>
				</div>
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

function AxAppController( $scope, $http ) {
//	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

	$scope.baseUrl = '/<?php echo $this->controller->name;?>';
	$scope.changeAction = $scope.baseUrl+'setItem';
	
	$scope._data=<?php echo json_encode($this->data);?>;
	
	$scope.currentMaster=$scope._data.master;
	$scope.currentTela=$scope._data.details.tela;
	$scope.currentHabilitacion=$scope._data.details.habilitacion;
	$scope.currentServicio=$scope._data.details.servicio;

	$scope.total= {global:1 ,tela: 5, habilitacion: 10, servicio: 25};
/*
	$scope.calculateTotals = function() {
		var total={global: 0, tela: 0, habilitacion: 0, servicio: 0};
		angular.forEach($scope.currentHabilitacion, function(item) {
			total=total+=item.Explosion.pcosto;
		});
		
		$scope.total.=total;
	}
*/
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
				if(typeof response.result != 'undefined') {
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
