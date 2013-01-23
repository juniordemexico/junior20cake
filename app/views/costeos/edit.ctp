<div id="detailContent" class="row-fluid" ng-controller="AxAppController">

<div class="page-header">
<h1>{{currentMaster.Articulo.arcveart}}	<small>{{currentMaster.Articulo.ardescrip}}</small>
</h1>
</div>


<?php echo $this->Form->create('Explosion', array('action'=>'/add', 'class'=>'form-search')); ?>
<?php echo $this->Form->hidden('Articulo.id'); ?>

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
			<input type="text" maxlength="16" id="material_cve" name="data[Proveedor][material_cve]" 
			class="span2" placeholder="Clave de Tela..."
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<button id="btnMaterialSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

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

				<div class="btn-group">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
						<strong>{{itemTela.Explosion.pcosto}}</strong>
						({{itemTela.Proveedor.prcvepro}})

						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">					
						<li ng-repeat="itemCostoTela in itemTela.Costo">
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

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->
			<input type="text" maxlength="16" id="material_cve" name="data[Proveedor][material_cve]"
			class="span2" placeholder="Clave de Habilitación..."
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:1"
			/>
			<button id="btnHabilSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

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
				<div class="btn-group">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
						<strong>{{itemHabilitacion.Explosion.pcosto}}</strong>
						({{itemHabilitacion.Proveedor.prcvepro}})

						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">					
						<li ng-repeat="itemCostoHabilitacion in itemHabilitacion.Costo">
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

		<div class="controls controls-row well well-small">
			<!-- Typeahead term -->
			<input type="text" maxlength="16" id="material_cve" name="data[Proveedor][material_cve]"
			class="span2" placeholder="Clave de Servicio..."
			data-items="10" data-provide="typeahead" data-type="json" data-min-length="2"
			data-autocomplete-url="/Articulos/autocomplete/tipo:3"
			/>
			<button id="btnServicioSubmit" class="btn" type="button"><i class="icon icon-plus-sign"></i> Agregar</button>
		</div>

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
				<div class="btn-group">
					<a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
						<strong>{{itemServicio.Explosion.pcosto}}</strong>
						({{itemServicio.Proveedor.prcvepro}})

						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">					
						<li ng-repeat="itemCostoServicio in itemServicio.Costo">
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

}

</script>

<?php
$this->Js->get('.detailDelete')->event(
'click', "
var theID=this.parentElement.parentElement.id;
bootbox.confirm('Seguro de ELIMINAR la partida ' + $('#'+theID).data('cve') + ' de la explosion ?', 
function(result) {
    if (result) {
		$.ajax({
			dataType: 'html', 
			type: 'post', 
			url: '/Explosiones/delete/'+theID,
			success: function (data, textStatus) {
			if(data=='OK') {
				$( '#'+theID ).remove();
			}
			else {
				bootbox.alert( '<label class=\"label label-warning\"><i class=\"icon icon-alert\"></i> Atencion!</label><br/><code>'+data+'<code>' );
			}
			},
		});

    }
}
);
"
, array('stop' => true));

?>