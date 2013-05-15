<header>
<div class="page-header">
<h1><small>Movimiento de Almacén <strong class="text-info">{{master.Entsal.esrefer}}</strong></small></h1>
</div>
</header>

<?php //echo $this->Form->create('Entsal', array('action'=>'/add', 'class'=>'form well', 'data-ng-form'=>"frmMaster")); ?>
<ng-form class="form form-horizontal" name="frmMaster">

<!-- Form's Tool / Button Bar -->
<div id="divFormToolBar" class="toolbar well well-small round-corners ax-toolbar">
	<div class="btn-group">	
		<button type="submit" class="btn btn-primary" data-ng-click="save()" data-ng-disabled="(frmMaster.$pristine || !frmMaster.$valid) || master.Entsal.id>0" alt="Guardar">
		<i class="icon icon-ok-circle icon-white"></i> Guardar
		</button>

		<button type="submit" class="btn btn-primary" data-ng-click="cancel()" data-ng-disabled="!(master.Entsal.id>0) || master.Entsal.esst=='1'" alt="Cancelar">
		<i class="icon icon-ok-circle icon-white"></i> Cancelar
		</button>
	</div>
	<div class="btn-group pull-right">	
		<button type="button" class="btn btn-primary" data-ng-click="print()" data-ng-disabled="!(master.Entsal.id>0)" title="Imprimir la transacción" alt="Imprimir">
		<i class="icon-print icon-white"></i>
		</button>
	</div>

</div>

<!-- Form's Tabbed Divs -->
<tabs id="tabs">

<pane id="tabs-0" heading="General" class="well">

<div class="row">
	<div class="span5">
	<div class="control-group">
		<label for="EntsalRefer" class="control-label">Folio:</label>
		<div class="controls input">
			<input type="text" id="EntsalRefer" name="data[Entsal][esrefer]" field="Entsal.esrefer"
				data-ng-model="master.Entsal.esrefer"
				class="date" placeholder="Folio..." title="Proporciona el Folio de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalEsfecha" class="control-label">Fecha:</label>
		<div class="controls input">
			<input type="text" id="EntsalEsfecha" name="data[Entsal][esfecha]" field="Entsal.esfecha"
				data-ui-date data-ui-date-format="yy-mm-dd"
				data-ng-model="master.Entsal.esfecha" data-ng-required="true"
				class="date" placeholder="Fecha..." title="Proporciona la Fecha de la transacción" />
		</div>
	</div>
	<div class="control-group">
		<label for="edtfecha" class="control-label">Almacén:</label>
		<div class="controls input">
			<select id="EntsalAlmacen_id" name="data[Entsal][almacen_id]"
				class="span2"
				data-ng-model="master.Entsal.almacen_id"
				data-ng-options="i.id as i.cve for i in related.Almacen"
				data-ng-required="true">
			</select>
		</div>
	</div>
	
	</div> <!-- div.span6 -->
	<div class="span1">&nbsp;</div>

	<div class="span6">

	<div class="control-group">
		<label for="EntsalTipoartmovbodega_id" class="control-label">Tipo de Mov:</label>
		<div class="controls input">
			<select id="EntsalTipoartmovbodega_id" name="data[Entsal][tipoartmovbodega_id]"
				class="span3"
				data-ng-model="master.Entsal.tipoartmovbodega_id"
				data-ng-options="i.id as i.cve for i in related.Tipoartmovbodega"
				data-ng-required="true">
			</select>
		</div>
	</div>
	<div class="control-group">
		<label for="EntsalEsconcep" class="control-label">Concepto:</label>
		<div class="controls input">
			<input type="text" id="EntsalEsconcep" name="data[Entsal][esconcep]" field="Entsal.esconcep"
				data-ng-model="master.Entsal.esconcep" ng-required="true"
				class="span4" placeholder="Concepto..." title="Concepto de la transacción" />
		</div>
	</div>

	</div> <!-- div.span5 -->

</div>

</pane>

<pane id="tabs-1" heading="Detalle">

		<div class="toolbar well well-small" data-ng-hide="master.Entsal.id>0">
			<input class="span3" data-ng-model="currentItem.Articulo"
				data-ui-select2="fieldItem" data-ui-event="{ change : 'getItemByCve()' }" 
				data-item-placeholder="Código del Material..."
				title="Proporciona el Código del Material ({{currentItem.Articulo.ardescrip}})" />

			<select class="span3" data-ng-model="currentItem.Color" 
				data-ng-options="c.cve for c in currentItem.ArticuloColor" 
				title="Elige el Color del Material" />
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" maxlength="8" data-ng-model="currentItem.cant"
				class="cant" placeholder="Cant..." title="Especifica la cantidad" />
			&nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn" type="button" data-ng-click="addItem(1, currentItem)" 
				data-ng-disabled="(!(currentItem.Articulo.id>0)||!(currentItem.cant>0))">
				<i class="icon icon-plus-sign"></i> Agregar
			</button>
		</div>

		<div id="detailContentTable">
		<table class="table table-condensed table-bordered table-hover ax-detail-table">
			<thead>
			<tr>
				<th class="span2">Material</th>
				<th class="span2">Color</th>
				<th class="">Descripción</th>
				<th class="cant">Cant</th>
				<th class="span1">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr data-ng-repeat="item in details" data-detail-id="{{item.Entsaldet.id}}" class="item-row">
				<td class="span2">{{item.Articulo.arcveart}}</td>
				<td class="span2">{{item.Color.cve}}</td>
				<td class="">{{item.Articulo.ardescrip}}</td>
				<td class="cant">{{item.Entsaldet.esdcant}}</td>
				<td class="span1">
					<button type="button" class="btn btn-mini ax-btn-detail-delete"
							data-ng-click="detailDelete(item.Entsal.id, item, true)"
							data-ng-hide="master.Entsal.id>0">
							<i class="icon icon-trash"></i>
					</button>
				</td>
			</tr>
			</tbody>
		</table>
		</div>

</pane> <!-- div tabs0 -->

</tabs> <!-- div tabbable -->

</ng-form>

<pre>
	{{currentItem|json}}
</pre>

<script>
/* AxApp application's AxAppCtrl controller code */

var emptyItem={Articulo: {'id': null, text: '', title:''}, cant: 0, Color:{}, ArticuloColor:[] };
	
myAxApp.controller('AxAppCtrl', function( $scope, $http ) {

	/* Main View Configuration, Routes and other symbols */
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
	$scope.base={
				url: '/<?php e($this->name)?>',
				controller: '<?php e(ucfirst($this->name))?>',
				action: '<?php echo $this->action?>',
				querystring: '<?php echo '[...el querystring...]'?>',
				timestamp: '<?php date('Y-m-d H:i:s')?>',
				date: '<?php echo date('Y-m-d')?>'
				};

	$scope.user={
				id: <?php e($session->read('Auth.User.id'));?>,
				username: '<?php e($session->read('Auth.User.username'))?>',
				group_id: <?php e($session->read('Auth.User.group_id'))?>
				};

	$scope.actions={	cancel: $scope.base.url+'/'+'cancel.json',
						delete: $scope.base.url+'/'+'delete.json',
						print: $scope.base.url+'/'+'print.json',
						getItemByCve: $scope.base.url+'/'+'getItemByCve.json'
					};

	/* Sets the data object/array generated by the CakePHP's controller  */
	// ------------Begin Controller's Data----------------------------------------
	$scope._data=<?php e(json_encode($this->data))?>;
	// ------------End Controller's Data------------------------------------------


	/* Begins the angular controller's code specific to this View */
	$scope.related={};
	if ($scope._data != null && $scope._data.master != null) $scope.master=$scope._data.master; else $scope.master={};
	if ($scope._data != null && $scope._data.details != null) $scope.details=$scope._data.details; else $scope.details=[];
	if ($scope._data != null && $scope._data.related != null) $scope.related=$scope._data.related; else $scope.related={};
	
	$scope.oldValues={"arcveart":"", "articulo_id": null, "color_id": null, "cant":0};

	$scope.currentItem=JSON.parse(JSON.stringify(emptyItem));

	$scope.getItemByCve = function() {
		if($scope.currentItem.Articulo.text==$scope.oldValues.arcveart) {
			return;
		}

		$scope.oldValues.arcveart=$scope.currentItem.Articulo.text;
axAlert($scope.actions.getItemByCve+
				'?cve='+$scope.currentItem.Articulo.text);

		$http.get($scope.actions.getItemByCve+
				'?cve='+$scope.currentItem.Articulo.text
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.currentItem.Articulo=response.data.item.Articulo;
				$scope.currentItem.Articulo.text=$scope.currentItem.Articulo.arcveart;
				$scope.currentItem.ArticuloColor=response.data.item.ArticuloColor;
				$scope.currentItem.Color=response.data.item.ArticuloColor[0];
				$scope.currentItem.cant=0;
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

	// Binds and initializates a Twitter Bootstrap's Typeahead inside our AngularJS context
	$scope.fieldItem = {
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

});

/*
	$scope.setCaracteristicas = function () {
		$http.get($scope.base.controller+'/setCaracteristicas.json'+
				'?articulo_id='+$scope.master.Articulo.id+
				'&molde='+$scope.master.Explosiondato.molde
		).then(function(response) {

		if(typeof response.data != 'undefined' && 
			typeof response.data.result != 'undefined' && response.data.result=='ok') {
			axAlert(response.data.message, 'success', false);
			return;
		}
		axAlert( (typeof response.data.result != 'undefined')?
				response.data.message:
				'Error Desconocido',
		 		response.data.result, false);
       	});		
	}
*/

/*	
	$scope.addItem = function( tipoexplosion_id, current ) {
	
		$http.get($scope.base.controller+'/add.json'+
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
			return;
		}
		axAlert( (typeof response.data.result != 'undefined')?
				response.data.message:
				'Error Desconocido',
		 		response.data.result, false);
       	});	
	}
*/

/*
	$scope.detailDelete = function(id, itemObj, askConfirmation) {
		bootbox.confirm('Seguro de ELIMINAR la partida ' + itemObj.Articulo.arcveart + ' de la explosion ?', 
		function(result) {
    		if (result) {
				$http.get($scope.base.controller+'/deleteItem.json?id='+id
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
*/

/*
	$scope.updateCantidad = function(id, value) {
		$http.get('/Explosiones/updateCantidad/'+id+'/'+value
		).then(function(response) {
			if(typeof response.data != 'undefined' && 
				typeof response.data.result != 'undefined' && response.data.result=='ok') {
				$scope.details=response.data.details;
				axAlert(response.data.message, 'success', false);
				return;
			}
			axAlert( (typeof response.data.result != 'undefined')?
					response.data.message:
					'Error Desconocido',
			 		response.data.result, false);
       	});
	}
*/


</script>
