<div id="formContainer" class="row">
<form id="itemForm" ng-submit="submit()" ng-controller="AxAppController" 
	name="itemForm" class="form well span5">
 
  <div class="control-group">
    <label class="control-label" for="artcve">Producto:</label>
    <div class="controls">
		<input type="hidden" id="item_id" name="item_id" ng-model="item_id" />
		<input type="text" id="artcve" name="articuloCve" ng-model="item.articulo_cve" class="span3" />
    </div>
    <span class="help-inline"><small>{{item.articulo_descrip}}</small></span>
    <span class="help-inline hide">Woohoo!</span>
 </div>
 
  <div class="control-group">
    <label class="control-label" for="colcve">Color:</label>
    <div class="controls">
      <input type="text" id="colcve" name="colorCve" ng-model="item.color_cve" class="span3"/>
    </div>
    <span class="help-inline hide">Woohoo!</span>
  </div>

  <div class="control-group">
    <label class="checkbox" for="kit">Paquete
    <input type="checkbox" id="kit" name="isKit" ng-model="isKit" class="checkbox"/>
  </label>

  <div class="control-group">
  <div class="controls controls-row">
<?php for($i=0; $i<5; $i++ ): ?> 
   <input type="text" id="cant<?php e($i)?>" name="cantidad<?php e($i)?>" ng-model="item.talladetail[<?php e($i)?>].cant" 
	placeholder="{{item.talladetail[<?php e($i)?>].label}}" title="Talla {{item.talladetail[<?php e($i)?>].label}}"
	class="span1" ng-show="item.talladetail[<?php e($i)?>].label" />
<?php endfor; ?>
  </div>
  </div>

  <div class="control-group">
  <div class="controls controls-row">
<?php for($i=5; $i<10; $i++ ): ?> 
   <input type="text" id="cant<?php e($i)?>" name="cantidad<?php e($i)?>" ng-model="item.talladetail[<?php e($i)?>].cant" 
	placeholder="{{item.talladetail[<?php e($i)?>].label}}" title="Talla {{item.talladetail[<?php e($i)?>].label}}"
	class="span1" ng-show="item.talladetail[<?php e($i)?>].label" />
<?php endfor; ?>
  </div>
  </div>
 
  <div class="control-group">
    <label class="checkbox" for="printLbl">Imprimir etiquetas
    <input type="checkbox" id="printLbl" name="printLabel" ng-model="printLabel" class="checkbox"/>
  </label>

  <div class="form-actions">
  <button type="submit" id="submit" value="sumbit"
	style="z-index: -1; border: 0px none; margin: 0px; padding: 0px;width: 1px; height: 1px; background: transparent;"></button>
  <button ng:click="save()" ng:disabled="{{isDataComplete}}"
	type="button" class="btn btn-primary btn-block">Guardar</button>
  </div>

  <div class="control-group">
    <div class="controls">
		<input type="text" id="scanInput" name="scanInput" ng-model="scanInput" class="span4" placeholder="Scanner input..." />
    	<span class="help-inline">Last read: {{lastScanInput}}</span>
    </div>
  </div>

</form><!-- div itemForm -->
</div>

<script>

// http://plnkr.co/edit/vU2y87   by me ;)

angular.element(window).bind('keydown', function(e) {
	if (e.keyCode === 32) {
		el=document.getElementById('scanInput');
		el.focus();
	}
});

var item={
	user_id : 1,
	username : 'IDD',
	item_id : 0,
	articul o_id : '111',
	articulo_cve : 'POWE',
	articulo_descrip : 'PANTALON POWER',
	color_id : '222',
	color_cve : 'BLACK',
	descrip : 'Pantalon',
	talla_id : 0,
	talla_cve : '',
	talladetail: [
		{cant : '', label : '28'},
 		{cant : '', label : '29'},
 		{cant : '', label : '30'},
 		{cant : '', label : '31'},
 		{cant : '', label : '32'},
 		{cant : '', label : '33'},
 		{cant : '', label : '34'},
 		{cant : '', label : '36'},
 		{cant : '', label : '38'},
 		{cant : '', label : '40'}
	]
};

function AxAppController( $scope, $http, $templateCache ) {
	$scope.method = 'GET';
	$scope.getUrl = '/Invfisicosmovil/itemData';
	$scope.addUrl = '/Invfisicosmovil/addItem';

	$scope.item = item;			// This is the Controller's main Model

	$scope.isKit = false;		// We have a product kit or package with more than one units?
	$scope.printLabel = false;  // We need to print a barcode label after save the data?

	$scope.scanInput = '';		// Every barcode scanner's reads are redirected through this
	$scope.lastScanInput = '';	// Holds the last processed scanner read

	// We have all the required data in our form?
	$scope.isDataComplete = function() {
		return true;  
	};
	
	// Save and push this record to the server
/*
	$scope.save = function() {
		console.log($scope.item);
		alert($scope.item.articulo_cve+' :: '+$scope.printLabel+' :: '+$scope.isKit+' :: '+
				$scope.item.talladetail[0].cant + $scope.item.talladetail[0].label );
	};
*/

	// This action is used as a form's "onChange" generic event.
  	$scope.submit = function() {
		console.log('Raw scanner input:' + $scope.scanInput);
		var scannedInput=$scope.scanInput;
		if(typeof scannedInput != 'undefined' && typeof scannedInput == 'string') {
			scannedInput='{' + scannedInput + '}';
			$scope.scanInput=scannedInput;
			$scope.lastScanInput=scannedInput;
		}
		
		console.log('Processed scanner input:' + $scope.scanInput);
		$scope.scanInput='';
		alert('un submit');
		return false;
	};
}

</script>
