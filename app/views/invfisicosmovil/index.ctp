<div id="formContainer" class="row">
<form id="itemForm" ng-submit="submit()" ng-controller="AxAppController" 
	name="itemForm" class="form well span5">
 
  <div class="control-group">
    <label class="control-label" for="artcve">Producto:</label>
    <div class="controls">
      <input type="text" id="artcve" name="articuloCve" ng-model="item.articulo_cve" class="span3"/>
    </div>
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
    <input type="text" id="cantt0" name="cantidadT0" ng-model="item.talladetail[0].cant" 
	placeholder="{{item.talladetail[0].label}}" title="{{item.talladetail[0].label}}" class="span1" />
    <input type="text" id="cantt1" name="cantidadT1" ng-model="item.talladetail[1].cant" 
	placeholder="{{item.talladetail[1].label}}" title="{{item.talladetail[1].label}}" class="span1" />
    <input type="text" id="cantt2" name="cantidadT2" ng-model="item.talladetail[2].cant" 
	placeholder="{{item.talladetail[2].label}}" title="{{item.talladetail[2].label}}" class="span1" />
    <input type="text" id="cantt3" name="cantidadT3" ng-model="item.talladetail[3].cant" 
	placeholder="{{item.talladetail[3].label}}" title="{{item.talladetail[3].label}}" class="span1" />
    <input type="text" id="cantt4" name="cantidadT4" ng-model="item.talladetail[4].cant"
	placeholder="{{item.talladetail[4].label}}" title="{{item.talladetail[4].label}}" class="span1" />
  </div>
  </div>

  <div class="control-group">
  <div class="controls controls-row">
    <input type="text" id="cantt5" name="cantidadT5" ng-model="item.talladetail[5].cant"
	placeholder="{{item.talladetail[5].label}}" title="{{item.talladetail[5].label}}" class="span1" />
    <input type="text" id="cantt6" name="cantidadT6" ng-model="item.talladetail[6].cant"
	placeholder="{{item.talladetail[6].label}}" title="{{item.talladetail[6].label}}" class="span1" />
    <input type="text" id="cantt7" name="cantidadT7" ng-model="item.talladetail[7].cant"
	placeholder="{{item.talladetail[7].label}}" title="{{item.talladetail[7].label}}" class="span1" />
    <input type="text" id="cantt8" name="cantidadT8" ng-model="item.talladetail[8].cant" 
	placeholder="{{item.talladetail[8].label}}" title="{{item.talladetail[8].label}}" class="span1" />
    <input type="text" id="cantt9" name="cantidadT9" ng-model="item.talladetail[9].cant" 
	placeholder="{{item.talladetail[9].label}}" title="{{item.talladetail[9].label}}" class="span1 " />
  </div>
  </div>
 
  <div class="control-group">
    <label class="checkbox" for="printLbl">Imprimir etiquetas
    <input type="checkbox" id="printLbl" name="printLabel" ng-model="printLabel" class="checkbox"/>
  </label>

  <div class="form-actions">
  <input type="submit" id="submit" value="sumbit" class="hide" />
  <button ng:click="save()" ng:disabled="{{isDataComplete}}"
	type="button" class="btn btn-primary btn-block">Guardar</button>
  </div>

  <div class="control-group">
    <label class="control-label label" for="colcve">Scanner </label>
    <div class="controls">
      <input type="text" id="scanInput" name="scanInput" ng-model="scanInput" class="span4"/>
    </div>
    <p><span class="help-inline"><em class="text-info">{{scanInput}}</em></span></p>
	<p>Last read: {{lastScanInput}}</p>
  </div>

</form><!-- div itemForm -->
</div>

<?php 

$item=array(
'user_id'=>1,
'articulo_id'=>0,
'color_id'=>0,
'talla_id'=>0,
'talladetail'=> array(
	't0'=>array('cant'=>4, 'label'=>'28'),
	't1'=>array('cant'=>4, 'label'=>'29'),
	't2'=>array('cant'=>4, 'label'=>'30'),
	't3'=>array('cant'=>4, 'label'=>'31'),
	't4'=>array('cant'=>4, 'label'=>'32')
	)
);

echo "KAKAJOE::\n<br/><pre>".
json_encode($item).
"</pre>";

?>

<script>

// http://plnkr.co/edit/vU2y87

angular.element(window).bind('keydown', function(e) {
	if (e.keyCode === 32) {
		el=document.getElementById('scanInput');
		el.focus();
//    $scope.$apply(function() {
//      $scope.subpage = false;
//    });
	}
});

var itemTalladetail={}
var item={
	user_id : '1',
	username : 'IDD',
	articulo_id : '111',
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

function AxAppController( $scope ) {

	$scope.item = item;			// This is the Controller's main Model

	$scope.isKit = false;		// We have a product kit or package with more than one units?
	$scope.printLabel = false;  // We need to print a barcode label after save the data?

	$scope.scanInput = '';		// Every barcode scanner's reads are redirected through this
	$scope.lastScanInput = '';	// Holds the last processed scanner read

	// We have all the required data in our form?
	$scope.isDataComplete = function() {
		return false;  
	};
	
	// Save and push this record to the server
	$scope.save = function($scope) {
		console.log(this.item);
		alert(this.item.articulo_cve+' :: '+this.printLabel+' :: '+this.isKit+' :: '+
				this.item.talladetail[0].cant + this.item.talladetail[0].label );
	};

	// This action is used as a form's "onChange" generic event.
  	$scope.submit = function($scope) {
		console.log('Raw scanner input:' + this.scanInput);
		
		var scannedInput=this.scanInput;
		
		if(typeof scannedInput != 'undefined' && typeof scannedInput == 'string') {
			scannedInput='{' + scannedInput + '}';
			this.scanInput=scannedInput;
			this.lastScanInput=scannedInput;
		}
		
		console.log('Processed scanner input:' + this.scanInput);
		this.scanInput='';
		return false;
	};
}

</script>
