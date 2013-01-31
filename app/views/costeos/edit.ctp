<div id="detailContent" class="row-fluid">

<?php echo $this->Form->create('Explosion', array('action'=>'/add', 'class'=>'form-search')); ?>
<?php echo $this->Form->hidden('Articulo.id'); ?>

<div class="page-header">
<h1>
<span tooltip-placement="right" tooltip="{{currentMaster.Articulo.ardescrip}}">{{currentMaster.Articulo.arcveart}}</span>

{{currentMaster.Articulo.arcveart}}	<small>{{currentMaster.Articulo.ardescrip}}</small>
</h1>

<div class="well">
<ul class="thumbnails">
	<li class="span3"><h4>Telas: <em class="text-info">{{total.tela.importe | currency}}</em></h4></li>
	<li class="span3"><h4>Habilitación: <em class="text-warning">{{total.habilitacion.importe | currency}}</em></h4></li>
	<li class="span3"><h4>Servicios: <em class="text-success">{{total.servicio.importe | currency}}</em></h4></li>
	<li class="span3"><h4>TOTAL: <em class="text-error">{{calculateTotal() | currency}}</em></h4></li>
</ul>
<div class="progress">
  <div class="bar bar-info" style="width: {{total.tela.porcentaje}}%;"></div>
  <div class="bar bar-warning" style="width: {{total.habilitacion.porcentaje}}%;"></div>
  <div class="bar bar-success" style="width: {{total.servicio.porcentaje}}%;"></div>
</div>

<button type="button" class="btn btn-info btn-block" ng-show="1">
A U T O R I Z A R &nbsp; C O S T E O
</button>

</div>

</div>

<div id="tabs" class="tabbable">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs-0" data-toggle="tab" class="text-info">Telas</a></li>
		<li><a href="#tabs-1" data-toggle="tab" class="text-warning">Habilitación</a></li>
		<li><a href="#tabs-2" data-toggle="tab" class="text-success">Servicios</a></li>
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
				<th class="span2">Modificado</th>
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
				<td class="span2"><small>{{itemTela.Explosion.modified}}</small></td>
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
				<th class="span2">Modificado</th>
			</tr>
			</thead>
			<tbody>
			<tr id="{{itemHabilitacion.Explosion.id}}" class="t-row" ng-repeat="itemHabilitacion in currentHabilitacion">
				<td class="span2" id="{{itemHabilitacion.Explosion.material_id}}">{{itemHabilitacion.Articulo.arcveart}}</td>
				<td class="">{{itemHabilitacion.Articulo.ardescrip}}</td>
				<td class="span1">{{itemHabilitacion.Explosion.cant}}</td>
				<td class="span3">
				<div class="btn-group" ng-show="itemHabilitacion.Costo[0].ArticuloProveedor.proveedor_id>0">
					<a class="btn dropdown-toggle btn-warning" data-toggle="dropdown" href="#">
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
				<td class="span2"><small>{{itemHabilitacion.Explosion.modified}}</small></td>
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
				<th class="span2">Modificado</th>
			</tr>
			</thead>
			<tbody>
			<tr id="{{itemServicio.Explosion.id}}" class="t-row" ng-repeat="itemServicio in currentServicio">
				<td class="span2" id="{{itemServicio.Explosion.material_id}}">{{itemServicio.Articulo.arcveart}}</td>
				<td class="">{{itemServicio.Articulo.ardescrip}}</td>
				<td class="span1">{{itemServicio.Explosion.cant}}</td>
				<td class="span3">
				<div class="btn-group" ng-show="itemServicio.Costo[0].ArticuloProveedor.proveedor_id>0">
					<a class="btn dropdown-toggle btn-success" data-toggle="dropdown" href="#">
						<strong>{{itemServicio.Explosion.pcosto}}</strong>
						({{itemServicio.Proveedor.prcvepro}})
						
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">					
						<li ng-repeat="itemCostoServicio in itemServicio.Costo" ng-click="setCosto(itemServicio.Explosion.id,itemCostoServicio.ArticuloProveedor.proveedor_id)">
						{{itemCostoServicio.ArticuloProveedor.costo}} 
						<small>(
						<strong>{{itemCostoServicio.Proveedor.prcvepro}}</strong>
						{{itemCostoServicio.Proveedor.prnom}}
						)</small>
						</li>
  					</ul>
				</div>
				</td>
				<td class="span2"><small>{{itemServicio.Explosion.modified}}</small></td>
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

angular.module('AxAppOggi', ['ui']);
angular.module('AxAppOggi', ['ui.bootstrap']);

/* The Form's AngularJS Controller */

function AxCtrl_<?php e($this->name)?>_<?php e($this->action)?>( $scope, $http ) {

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

	$scope.currentMaster=$scope._data.master;
	$scope.currentTela=$scope._data.details.tela;
	$scope.currentHabilitacion=$scope._data.details.habilitacion;
	$scope.currentServicio=$scope._data.details.servicio;

	$scope.total= {global: 0,
					tela: {importe:0,porcentaje:0}, 
					habilitacion: {importe:0,porcentaje:0}, 
					servicio: {importe:0,porcentaje:0}
					};

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

	// Calculate Totals
	$scope.calculateTotal = function() {
		// Total de Habilitacion
		var total=0;
		angular.forEach($scope.currentTela, function(item) {
			total+=(item.Explosion.cant * 
					(typeof item.Explosion.pcosto!='undefined'?item.Explosion.pcosto:0) 
					);
		});
		$scope.total.tela.importe=total;

		// Total de Habilitacion
		total=0;
		angular.forEach($scope.currentHabilitacion, function(item) {
			total+=(item.Explosion.cant * 
					(typeof item.Explosion.pcosto!='undefined'?item.Explosion.pcosto:0) 
					);
		});
		$scope.total.habilitacion.importe=total;

		var total=0;
		angular.forEach($scope.currentServicio, function(item) {
			total+=(item.Explosion.cant * 
					(typeof item.Explosion.pcosto!='undefined'?item.Explosion.pcosto:0) 
					);
		});
		$scope.total.servicio.importe=total;

		// Calculate the Global Total
		$scope.total.global=$scope.total.tela.importe+
							$scope.total.habilitacion.importe+
							$scope.total.servicio.importe;

		// Calculate the group's percentages
		$scope.total.tela.porcentaje=(100*$scope.total.tela.importe)/$scope.total.global;
		$scope.total.habilitacion.porcentaje=(100*$scope.total.habilitacion.importe)/$scope.total.global;
		$scope.total.servicio.porcentaje=(100*$scope.total.servicio.importe)/$scope.total.global;

		// Returns the Global Total
		return $scope.total.global;
	}

}

</script>
