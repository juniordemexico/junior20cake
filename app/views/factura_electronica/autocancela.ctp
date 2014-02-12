<div class="span12 index-form">

<div id="gridWrapper">
	<h3 class="text-info">Last Folio: {{lastItem}}</h3>
	<div class="toolbar">
		<button type="button" class="btn btn-primary" data-ng-click="cancelaCFDIBatch();" >
			<i class="icon icon-ok"></i> Iniciar Proceso Automático
		</button>
	</div>
	<div class="well well-small">
		Current Item:
		<pre style="height: 48px; min-height: 48px; overflow: scroll;">
			{{currentItem|json}}
		</pre>
	</div>
	<ul data-ng-repeat="i in items"   style="width: 85%; text-align: left; font-size: 12px; line-height: 18px; font-family: Menlo, Courier, Arial, sans-serif;">
		<li id="fac_{{i.Factura.id}}" data-ng-click="cancelaCFDI(i.Factura)" >
			<strong>{{i.Factura.farefer}}</strong>
			<i class="icon icon-ok" ng-hide="!i.Factura.yaprocesada"></i>
			&nbsp;&nbsp;&nbsp;&nbsp;{{url}}/{{i.Factura.farefer}}</small>
			
		</li>
	</ul>

</div>

</div> <!-- index-form -->

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

	// Load Related Models

	$scope.url='/FacturaElectronica/cancelacfdi';
	$scope.lastItem=-1;
	$scope.currentItem={};

	var pausa={};

	// todos los items (facturas) vienen en $scope.items

	$scope.cancelaCFDIBatch = function() {
//		$scope.currentItem=angular.copy(obj);    // Clonamos el ultimo objeto
//		$scope.lastItem=angular.copy(obj.farefer);  // Clonamos el Folio del ultimo objeto
		var log={};
		angular.forEach($scope.items, function(value, key) {
			//obj.yaprocesada=true;	// hace visible el icono de OK
			pausa=$timeout(function() { 
				/*alert(value.Factura.farefer);*/
				console.log($scope.url+'/'+value.Factura.id);
				window.open($scope.url+'/'+value.Factura.id)
				value.Factura.yaprocesada=true;
				$scope.lastItem=value.Factura.farefer;
				},
				8000, true);
		}, log);
		
	}
	
	$scope.cancelaCFDI = function(obj) {
		$scope.currentItem=angular.copy(obj);    // Clonamos el ultimo objeto
		$scope.lastItem=angular.copy(obj.id);  // Clonamos el Folio del ultimo objeto
		console.log($scope.url+'/'+obj.id);
		window.open($scope.url+'/'+obj.id);
		$scope.lastItem=obj.farefer;
		obj.yaprocesada=true;	// hace visible el icono de OK
	}

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>
