<div id="formContainer" class="row">
<form id="itemForm" ng-submit="submit()" ng-controller="AxAppController" 
	name="itemForm" class="form well span5">
 
  <div class="control-group">
    <div class="controls input">
		<div class="input-prepend">
			<span class="add-on">Ubicación:</span>
      		<input type="text" id="ubicacioncve" name="ubicacionCve" ng-model="ubicacion.cve" class="span3"/>
    	</div>
    </div>
    <span class="help-inline hide">Woohoo!</span>
 </div>
 <div>Zona: <strong>{{ubicacion.zona}}</strong> Fila:<strong>{{ubicacion.fila}}</strong> Espacio:<strong>{{ubicacion.espacio}}</strong></div>
<br/><br/>	

  <div class="control-group">
    <div class="controls input">
		<div class="input-prepend">
			<span class="add-on">Producto:</span>
      		<input type="text" id="artcve" name="articuloCve" ng-model="item.articulo_cve" class="span3"/>
    	</div>
    </div>
    <span class="help-inline hide">Woohoo!</span>
 </div>
 <div><strong>{{item.articulo_descrip}}</strong></div>
<br/><br/>	
 
  <div class="control-group">
    <label class="control-label" for="colcve">Color:</label>
    <div class="controls">
      <input type="text" id="colcve" name="colorCve" ng-model="item.color_cve" class="span3" readonly class="readonly"/>
    </div>
    <span class="help-inline hide">Woohoo!</span>
  </div>
<br/><br/>

  <div class="control-group">
    <label class="control-label" for="colcve">TALLA {{item.talla_label}} <small>({{item.talla_cve}})</small>:</label>
    <div class="controls">
      <input type="text" id="edtcantidad" name="edtCantidad" ng-model="cantidad" class="span3" title="{{item.talla_label}}" placeholder="{{item.talla_label}}"/>
    </div>
    <span class="help-inline hide">Woohoo!</span>
  </div>
<br/><br/>

  <div class="form-actions">
  <button type="submit" id="submit" value="sumbit"
	style="z-index: -1; border: 0px none; margin: 0px; padding: 0px;width: 1px; height: 1px; background: transparent;"></button>
  <button ng:click="save()" ng:disabled="{{isDataComplete}}"
	type="button" class="btn btn-primary btn-block">Guardar</button>
  </div>

  <div class="control-group">
    <div class="controls">
      <input type="text" id="scanInput" name="scanInput" ng-model="scanInput" class="span4" placeholder="Scanner Input"/>
    </div>
    <p><span class="help-inline"><em class="text-info">Last read: {{lastScanInput}}</em></span></p>
  </div>


<div>
<pre class="pre">
item = {{item | json}}
</pre>
<pre class="pre">
ubicacion = {{ubicacion | json}}
</pre>
</div>

</form><!-- div itemForm -->


</div>

<script>

// http://plnkr.co/edit/vU2y87

angular.element(window).bind('keydown', function(e) {
	if (e.keyCode === 16) {
		el=document.getElementById('scanInput');
//		el.value='';
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
	articulo_id : '',
	articulo_cve : '',
	articulo_descrip : '',
	color_id : '',
	color_cve : '',
	talla_id : 0,
	talla_cve : '',
	talla_index : '',
	talla_label : '',
	talla: [
		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''},
 		{cant : '', label : ''}
	],
	color: [
		{id:1, cve:'UNICO'}
	]

};

var ubicacion={
	id :0 ,
	cve : "",
	zona : "",
	fila : "",
	espacio: ""
};

var user={
	user_id : '1',
	username : 'IDD',
};

function AxAppController( $scope, $http ) {
	$scope.getUrl = '/Articulos/getItemByCve';
	$scope.addUrl = '/Invfisicosmovil/addItem';

	$scope.user = user;			// This is the Controller's User Model
	$scope.item = item;			// This is the Controller's main Model
	$scope.ubicacion=ubicacion;			// This is the Controller's Ubication Model
	$scope.lastUbicacionCve='';			// This is the Controller's Ubication Model
	
	$scope.isKit = false;		// We have a product kit or package with more than one units?
	$scope.printLabel = false;  // We need to print a barcode label after save the data?

	$scope.scanInput = '';		// Every barcode scanner's reads are redirected through this
	$scope.lastScanInput = '';	// Holds the last processed scanner read

	$scope.lastCve='';

	$scope.cantidad='';			// This is the Controller's Ubication Model
	
	// We have all the required data in our form?
	$scope.isDataComplete = function() {
		return false;  
	};
	
	// Save and push this record to the server
	$scope.save = function() {
		console.log($scope.item);
		alert($scope.item.articulo_cve+' :: '+$scope.printLabel+' :: '+$scope.isKit+' :: '+
				$scope.item.talla[0].cant + $scope.item.talla[0].label );
	};


	$scope.getUbicacion = function() {
		console.log('Get Ubicacion: '+$scope.ubicacion.cve);
	//	alert('Get Ubicacion:'+$scope.ubicacion.cve);

			$http.get('/Invfisicosmovil/getubicacion/'+$scope.ubicacion.cve).then(function(response) {
				if(typeof response.data != 'undefined') {
					if(typeof response.data.result != 'undefined' ||
						typeof response.data.result == 'string' ||
						response.data.result=='error') {
						if(typeof response.data.errorMessage == 'string') {
							alert('Error: '+response.data.errorMessage);						
						}
					}
					else {
						$scope.ubicacion=response.data;
					}

				}
       		});


	};

	$scope.getItemByCve = function() {
		console.log('Get By Cve Item: '+$scope.item.articulo_cve);

			$http.get('/Articulos/getItemByCve/'+$scope.item.articulo_cve).then(function(response) {
				if(typeof response.data != 'undefined') {
					if(typeof response.data.result != 'undefined' ||
						typeof response.data.result == 'string') {
					//	alert('Error');
					}
					else {
						$scope.item=response.data;
					}

				}
       		});


	};

	$scope.getItem = function() {
		console.log('Get Item: '+$scope.item.articulo_cve);
			$http.get('/Invfisicosmovil/getitem/'+$scope.item.articulo_id+'/'+$scope.item.color_id+'/'+$scope.item.talla_index).then(function(response) {
				if(typeof response.data != 'undefined') {
					if(typeof response.data.result != 'undefined' ||
						typeof response.data.result == 'string') {
						alert('Error');
					}
					else {
						$scope.item=response.data;
					}

				}
       		});


	};
/*
	$('#artcve').bind('blur', function() {
		$scope.item.articulo_cve=$('#artcve').val();
		if($scope.item.articulo_cve!=$scope.lastCve) {
			$scope.lastCve=$scope.item.articulo_cve;
			$scope.getItemByCve();
		}
	});
*/
	$('#ubicacioncve').bind('blur', function() {
		$scope.ubicacion.cve=$('#ubicacioncve').val();
		if($scope.ubicacion.cve!=$scope.lastUbicacionCve) {
			$scope.lastUbicacionCve=$scope.ubicacion.cve;
			$scope.getUbicacion();
		}
	});


	$('#scanInput').bind('blur', function() {
		var theValue=$scope.scanInput;
		if(typeof theValue != 'undefined' && typeof theValue == 'string' &&
			theValue!='') {
			// Checks for the Init Character '$'
			if(theValue.substring(0,1)=='$') {
				theValue=theValue.substring(1,32);
			}
			// Checks if the value already has json's brackets '{}'
			if(theValue.substring(0,1)!='{') {
				theValue='{' + theValue + '}';
			}
			
			theValue=theValue.replace(/\%/g,':');
			theValue=theValue.replace('t:u','"t":"u"');
			theValue=theValue.replace('t:p','"t":"p"');
			theValue=theValue.replace('id:','"id":');
			var theType=theValue.substring(6,7);
			$scope.lastScanInput=theValue;


			if(theType=='u') {
				var theData=theValue.substring(14,theValue.length-1);
				$scope.ubicacion.cve=theData;
				var el=$('#ubicacioncve');
				el.val(theData);

				$scope.getUbicacion();
				
				var el=document.getElementById('artcve');
				el.focus();
			}
			
			if(theType=='p') {
				var theData=theValue.substring(14,theValue.length-1);
				var theData=theData.split(',');
				var theId=theData[0];
				var theColorId=theData[1].substring(2,theData[1].length);
				var theTallaIndex=theData[2].substring(2,theData[2].length);
				
				$scope.item.articulo_id=theId;
				$scope.item.color_id=theColorId;
				$scope.item.talla_index=theTallaIndex;
				$scope.lastScanInput=theValue;
				
//				alert('id::'+$scope.item.articulo_id+' color_id::'+$scope.item.color_id+' talla_index::'+theTallaIndex);
				$scope.getItem();
				$scope.cantidad='';

				var el=document.getElementById('edtcantidad');
				el.focus();
			
			}
			
			console.log('Processed scanner input:' + theValue);
			
			$scope.scanInput='';

		}
		
	});

}

/*
	//		var theDataObject=$.toJSON(theValue);
						
	//		alert(theDataObject.T);


			var Articulo = $resource('/Invfisicosmovil/getItemByCve/:cve',
 				{cve:$scope.item.articulo_cve} 	);

	<select>
		<option id="{{item.color[0].id}}">{{item.color[0].cve}}</option>
	</select>


  <div class="control-group">
  <div class="controls controls-row">
<?php for($i=5; $i<10; $i++ ): ?> 
   <input type="text" id="cant<?php e($i)?>" name="cantidad<?php e($i)?>" ng-model="item.talla[<?php e($i)?>].cant" 
	placeholder="{{item.talla[<?php e($i)?>].label}}" title="Talla {{item.talla[<?php e($i)?>].label}}"
	class="span1" ng-show="item.talla[<?php e($i)?>].label" />
<?php endfor; ?>
  </div>
  </div>
 
  <div class="control-group">
  <div class="controls controls-row">
<?php for($i=0; $i<5; $i++ ): ?> 
   <input type="text" id="cant<?php e($i)?>" name="cantidad<?php e($i)?>" ng-model="item.talla[<?php e($i)?>].cant" 
	placeholder="{{item.talla[<?php e($i)?>].label}}" title="Talla {{item.talla[<?php e($i)?>].label}}"
	class="span1" ng-show="item.talla[<?php e($i)?>].label" />
<?php endfor; ?>
  </div>
  </div>


  <div class="control-group">
    <label class="checkbox" for="printLbl">Imprimir etiquetas
    <input type="checkbox" id="printLbl" name="printLabel" ng-model="printLabel" class="checkbox"/>
  </label>

*/

</script>
