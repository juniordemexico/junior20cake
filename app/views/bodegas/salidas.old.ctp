<div id="formContainer" class="row almacenmovil table-bodega">
<form id="itemForm" ng-submit="submit()" ng-controller="AxAppController"
	name="itemForm" class="form ng-cloack">

<div id="userContainer" class="section-container" style="margin-top: 4px;">
	<legend><small>Usuario: <strong>{{user.username}}</strong></small></legend>
</div>

<div id="folioContainer" class="section-container" style="margin-top: 16px;">
	<legend><span class="text-info">Folio</span> &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{currentTipomov.cve}}</strong>&nbsp;&nbsp;<strong>{{currentFolio}}</strong></legend>
  	<div class="control-row">
   		<input type="text" id="folio" name="current_folio" ng-model="currentFolio" class="input-large" placeholder="Folio..." maxlength="8" />
		<select id="tipoartmovbodega" name="TipoArtMovBodega" ng-model="currentTipomov" ng-options="t.cve for t in tipomov"></select>
 	</div>
</div>

<div id="ubicacionContainer" class="section-container" style="margin-top: 16px;">
	<legend><span class="text-info">Ubicación</span> &nbsp;&nbsp;<strong><small>Zona</small> {{ubicacion.zona}} &nbsp;&nbsp;<small>Fila</small> {{ubicacion.fila}} &nbsp;&nbsp;<small>Espacio</small> {{ubicacion.espacio}}</strong></legend>
  	<div class="control-group">
    	<div class="input">
      		<input type="text" id="ubicacioncve" name="ubicacionCve" ng-model="ubicacion.cve" class="input-large" placeholder="Clave de Ubicación..."/>
    	</div>
 	</div>
</div>

<div id="productoContainer" class="section-container" style="margin-top: 32px;">
	<legend><span class="text-info">Producto</span> &nbsp;&nbsp; <strong><em>{{item.articulo_descrip}}</em></strong></legend>
  	<div class="control-group">
    	<div class="input">
      		<input type="text" id="artcve" name="articuloCve" ng-model="item.articulo_cve" class="input-large" placeholder="Clave del Producto..."/>
    	</div>
    	<span class="help-inline hide">&nbsp;</span>
 	</div>
</div>

<div id="colorContainer" class="section-container" style="margin-top: 32px;"> 
	<legend><span class="text-info">Color</span> &nbsp;&nbsp;<strong><em>{{currentColor.cve}}</em></strong></legend>
	<div class="btn-group">
		<button type="button" 
			class="btn btn-info btn-small"
			id="btnColor{{$index}}"
			ng-model="currentColor"
			ng-repeat="oneColor in item.color"
			ng-click="$parent.currentColor=$parent.item.color[$index]"> &nbsp;
			&nbsp;{{oneColor.cve}}&nbsp;
		</button>
   	</div>
</div>

<div id="tallaContainer" class="section-container" style="margin-top: 32px;">
	<legend><span class="text-info">Talla</span> &nbsp;&nbsp;<strong><em>{{currentTalla.label}}</em></strong></legend>
	<div class="btn-group">
		<button
			type="button" 
			class="btn btn-warning btn-small" 
			id="btnTalla{{$index}}"
			ng-model="currentTalla"
			ng-repeat="oneTalla in item.talla"
			ng-click="$parent.currentTalla=$parent.item.talla[$index]"
			ng-show="$parent.item.talla[$index].label">
			&nbsp;{{oneTalla.label}}&nbsp;
		</button>
	</div>
    <span class="help-inline hide">&nbsp;</span>
</div>

<div id="cantidadContainer" class="section-container" style="margin-top: 32px;">
	<legend><span class="text-info">Cantidad de Salida</span> &nbsp;&nbsp;<strong><em>{{cantidad}}</em></strong></em></legend>
	<div class="control-group">
		<div class="input">
   			<input type="text" id="edtcantidad" name="edtCantidad" ng-model="cantidad" class="input-large" title="Talla {{currentTalla.label}}" placeholder="Cantidad en Talla  {{currentTalla.label}}" />
  		</div>
    	<span class="help-inline hide">&nbsp;</span>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-small" ng-click="minusCant(1)">&nbsp;&nbsp;&nbsp;-1&nbsp;&nbsp;&nbsp;</button>
		<button type="button" class="btn btn-small" ng-click="plusCant(1)">&nbsp;&nbsp;&nbsp;+1&nbsp;&nbsp;&nbsp;</button>
		<button type="button" class="btn btn-small" ng-click="minusCant(10)">&nbsp;&nbsp;&nbsp;-10&nbsp;&nbsp;&nbsp;</button>
		<button type="button" class="btn btn-small" ng-click="plusCant(10)">&nbsp;&nbsp;&nbsp;+10&nbsp;&nbsp;&nbsp;</button>
		<button type="button" class="btn btn-small" ng-click="minusCant(100)">&nbsp;&nbsp;&nbsp;-100&nbsp;&nbsp;&nbsp;</button>
		<button type="button" class="btn btn-small" ng-click="plusCant(100)">&nbsp;&nbsp;&nbsp;+100&nbsp;&nbsp;&nbsp;</button>
	</div>
	<br/><br/>
</div>


<div id="actionsContainer" class="section-container" style="margin-top: 24px;">
  <div class="form-actions section-container">
  	<button ng-click="save()" ng-disabled="disableSaveBtn"
		type="button" class="btn btn-primary btn-block">Guardar</button>
  	<button type="submit" id="submit" value="sumbit"
		style="z-index: -1; border: 0px none; margin: 0px; padding: 0px;width: 1px; height: 1px; background: transparent;"></button>
  </div>
  <span class="help-inline"><em class="text-info">Último Mensaje: <strong>{{lastMessage}}</strong></em></span>
</div>

<div id="cancelContainer" class="section-container" style="margin-top: 32px;">
	<legend><span class="text-info">Cancelar Transacción</span> &nbsp;&nbsp;</strong></legend>
	<div class="control-group">
 			<div class="input-append">
      		<input type="text" id="canceltransaction" name="cancelTransaction" ng-model="cancelTransaction" placeholder="Número de Transacción..." />
			<button type="button" class="btn btn-primary" ng-click="requestCancelTransaction()"><i class="icon icon-trash icon-white"></i> Cancelar</button>
    		</div>
     <span class="help-inline" ng-show="cancelTransactionMessage"><strong><em class="text-warning">{{cancelTransactionMessage}}</em></strong></span>
	</div>
</div>

<div id="printContainer" class="section-container" style="margin-top: 32px;">
	<legend><span class="text-info">Imprimir Etiqueta de Producto</span> &nbsp;&nbsp;</strong></legend>
	<div class="control-group">
 			<div class="input-append">
      		<input type="text" id="printlabel" name="printLabel" ng-model="printLabel" placeholder="Clave del Producto..." />
			<button type="button" class="btn btn-primary" ng-click="requestPrintLabel()"><i class="icon icon-print icon-white"></i> Imprimir</button>
    		</div>
     <span class="help-inline" ng-show="printLabelMessage"><strong><em class="text-warning">{{printLabelMessage}}</em></strong></span>
	</div>
</div>

<div id="scannerContainer" class="section-container" style="margin-top: 32px;">
	<div class="control-group">
    	<div class="controls">
      		<input type="text" id="scanInput" name="scanInput" ng-model="scanInput" class="" placeholder="Scanner Input"/>
    	</div>
   		<span class="help-inline"><em class="text-info">Última Lectura: {{lastScanInput}}</em></span>
  		</div>
	</div>
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
		{index : 0, label : '', cant: ''},
 		{index : 1, label : '', cant: ''},
 		{index : 2, label : '', cant: ''},
 		{index : 3, label : '', cant: ''},
 		{index : 4, label : '', cant: ''},
 		{index : 5, label : '', cant: ''},
 		{index : 6, label : '', cant: ''},
 		{index : 7, label : '', cant: ''},
 		{index : 8, label : '', cant: ''},
 		{index : 9, label : '', cant: ''}
	],
	color: [
	]
};

var printer=[
	{id: 11, cve: 'Zebra 01'},
	{id: 13, cve: 'Zebra 03'}
];

var user={
	id: <?php echo $session->read('Auth.User.id')?>,
	username: '<?php echo $session->read('Auth.User.username');?>'
}

var ubicacion={
	id : 1,
	cve : "A00-0000",
	zona : "A",
	fila : "01",
	espacio: "0000"
};

var tipomov=[
{id: -11, cve: 'SALIDA DIRECTA' },
{id: -100, cve: 'ORDEN DE SURTIDO' },
{id: -110, cve: 'PEDIDO' },
{id: -52, cve: 'CAMBIO UBICACION ORIGEN' },
{id: 11, cve: 'CANC SALIDA DIRECTA' }
];

function AxAppController( $scope, $http ) {
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

	$scope.getUrl = '/Articulos/getItemByCve';
	$scope.addUrl = '/Bodegas/addTransaction';

	$scope.printer = printer;			// This is the Controller's User Model
	$scope.user = user;					// This is the Controller's User Model
	$scope.item = item;					// This is the Controller's main Model
	$scope.ubicacion=ubicacion;			// This is the Controller's Ubication Model
	$scope.tipomov = tipomov;			// This is the Controller's Transaction Type
	
	$scope.printLabel = true;  // We need to print a barcode label after save the data?

	$scope.currentFolio='';
	$scope.currentTalla={};
	$scope.currentColor={};
	$scope.currentPrinter=printer[0];
	$scope.currentTipomov;
	
	$scope.scanInput = '';		// Every barcode scanner's reads are redirected through this
	
	$scope.lastCve='';
	$scope.lastUbicacionCve='';		// This is the Controller's Ubication Model
	$scope.lastMessage='';
	$scope.lastScanInput = '';	// Holds the last processed scanner read

	$scope.printLabel='';
	$scope.printLabelMessage='';

	$scope.cancelTransaction='';
	$scope.cancelTransactionMessage='';
	
	$scope.cantidad=0;			// This is the Controller's Ubication Model
	
	// We have all the required data in our form?
	$scope.disableSaveBtn=false;
/*
	$scope.isDataComplete = function() {
		return false;  
	};
*/	
	// Save and push this record to the server
	$scope.save = function() {
		console.log("Envia Forma: "+$scope.item.articulo_cve+', '+$scope.item.color_cve+', '+$scope.item.talla_index);
		$scope.item.cantidad=$scope.cantidad;

		$scope.item.color_id=$scope.currentColor.id;
		$scope.item.color_cve=$scope.currentColor.cve;

		if(typeof $scope.ubicacion.id == 'undefined' || !($scope.ubicacion.id>0)) {
			axAlert('Especifica el Tipo de Movimiento', 'warning', false);
			return false;
		}

		if(!($scope.currentTipomov.id!=0)) {
			axAlert('Especifica el Tipo de Movimiento', 'warning', false);
			return false;
		}

		$scope.disableSaveBtn=true;
		
		$http.get('/Bodegas/addtransaction?'+
				'articulo_id='+$scope.item.articulo_id+
				'&color_id='+$scope.item.color_id+
				'&talla_index='+$scope.currentTalla.index+
				'&cantidad='+$scope.cantidad+
				'&ubicacion_id='+$scope.ubicacion.id+
				'&tipoartmovbodega_id='+$scope.currentTipomov.id+
				'&folio='+$scope.currentFolio+
				'&printlabel='+$scope.printLabel+
				'&selectedprinter='+$scope.currentPrinter.id
		).then(function(response) {
			$scope.lastMessage=$scope.item.articulo_cve+' :: '+$scope.item.color_cve+' :: '+$scope.currentTalla.label+' >> '+$scope.cantidad;
			if(typeof response.data != 'undefined') {
				if(typeof response.data.result=='string' && response.data.result=='recibido' ) {
					axAlert(response.data.message, 'success', false);
					$scope.lastMessage=response.data.message;
					$scope.item.talla_index=null;
					$scope.item.talla_label='';
					$scope.currentTalla={};
					$scope.cantidad=0;
					if($('#ubicacioncve').val()!='') { 
						$('#thetallaindex').focus();
					}
					else {
						$('#ubicacioncve').focus();
					}				
				}
				else {
					axAlert(response.data.message, 'error', false);
					$scope.lastMessage=response.data.message;
				}
			}
			else {
					axAlert('Error Irrecuperable...'+response.data, 'error', false);
//					alert('ERROR IRRECUPERABLE...'+response.data);
			}
			$scope.disableSaveBtn=false;

   		});

	};

	// Save and push this record to the server

	$scope.submit = function() {
		alert('Un submit');
	};


	$scope.getUbicacion = function() {
		console.log('Get Ubicacion: '+$scope.ubicacion.cve);

		$http.get('/Bodegas/getubicacion/'+$scope.ubicacion.cve).then(function(response) {
			if(typeof response.data != 'undefined') {
				if(typeof response.data.result != 'undefined' ||
					typeof response.data.result == 'string' ||
					response.data.result=='error') {
					if(typeof response.data.errorMessage == 'string') {
						axAlert('Ubicación Inválida', 'warning', false);
					}
					$scope.ubicacion=ubicacion;
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
//				alert('Error: '+response.data.message);
				axAlert('Producto Inválido', 'warning', false);
				$scope.item.articulo_descrip='';
				$scope.item.articulo_id='';
			}
			else {
				$scope.item=response.data;

				$scope.item.color_id=$scope.item.color[0].id;
				$scope.item.color_cve=$scope.item.color[0].cve;
				$scope.currentColor={id: $scope.item.id, cve: $scope.item.cve};
			}

			}
       	});
	};

	$scope.getItem = function() {
		console.log('Get Item: '+$scope.item.articulo_cve);
		$http.get('/Bodegas/getitem/'+$scope.item.articulo_id+'/'+$scope.item.color_id+'/'+$scope.item.talla_index).then(function(response) {
			if(typeof response.data != 'undefined') {
				if(typeof response.data.result != 'undefined' ||
					typeof response.data.result == 'string') {
					alert('Error');
					axAlert('Error al solicitar el Producto', 'warning', false);
				}
				else {
					$scope.item=response.data;
				}
			}
       	});
	};

	$scope.requestPrintLabel = function() {
		$http.get('/Bodegas/etiquetaarticulo/'+$scope.printLabel).then(function(response) {
			if(typeof response.data != 'undefined') {
				$scope.printLabelMessage='Imprimió Etiqueta ' + $scope.printLabel;
				axAlert('Producto '+$scope.printLabel+' impreso.', 'info', false);
				$scope.printLabel='';
			}
       	});

	}

	$scope.requestCancelTransaction = function() {
		$http.get('/Bodegas/cancela/'+$scope.cancelTransaction).then(function(response) {
			if(typeof response.data != 'undefined') {
				$scope.cancelTransactionMessage='Se CANCELO transaccion ' + $scope.cancelTransaction;
				axAlert('Transacción <strong>'+$scope.cancelTransaction+'</strong> CANCELADO.', 'success', false);
				$scope.cancelTransaction='';
			}
       	});

	}

	$scope.minusCant = function(value) {
		var oldValue=parseInt($scope.cantidad);
		if(oldValue-value>=0) {
			$scope.cantidad=(oldValue>0?oldValue:0) - value;
		}
		else {
			$scope.cantidad=0;
		}
	}

	$scope.plusCant = function(value) {
		var oldValue=parseInt($scope.cantidad);
		$scope.cantidad=(oldValue>0?oldValue:0) + value;
	}

	$('#ubicacioncve').bind('blur', function() {
		$scope.ubicacion.cve=$('#ubicacioncve').val();
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


	$('#artcve').bind('blur', function() {
		$scope.item.articulo_cve=$('#artcve').val();
		if($scope.item.articulo_cve!=$scope.lastCve) {
			$scope.lastCve=$scope.item.articulo_cve;
			$scope.getItemByCve();
			if($scope.currentColor.id>0) {
				$('#btnTalla0').focus();
			}
			else {
				$('#btnColor0').focus();				
			}
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
				
				if($('#artcve').val()!='') {
					$('#edtcantidad').focus();
				}
				else {
					$('#artcve').focus();				
				}
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
				$scope.currentTalla={index: $scope.item.talla_index, label: $scope.item.talla_label};
				$scope.currentColor={id: $scope.item.color_id, cve: $scope.item.color_cve};

				$scope.lastScanInput=theValue;
				
//				alert('id::'+$scope.item.articulo_id+' color_id::'+$scope.item.color_id+' talla_index::'+theTallaIndex);
				$scope.getItem();
				$scope.cantidad='';

				if($('#ubicacioncve').val()!='') {
					$('#edtcantidad').focus();
				}
				else {
					$('#ubicacioncve').focus();				
				}
			}
			
			console.log('Processed scanner input:' + theValue);
			
			$scope.scanInput='';

		}
		
	});

}

/*
	//		var theDataObject=$.toJSON(theValue);
						
	//		alert(theDataObject.T);


			var Articulo = $resource('/Bodegas/getItemByCve/:cve',
 				{cve:$scope.item.articulo_cve} 	);

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
    <label class="checkbox" for="printLbl">Imprimir etiqueta
    <input type="checkbox" id="printLbl" name="printLabel" ng-model="printLabel" class="checkbox"/>
  </label>


<div>
<pre class="pre">
item = {{item | json}}
</pre>
<pre class="pre">
ubicacion = {{ubicacion | json}}
</pre>
</div>


<select>
		<option id="{{item.color[0].id}}">{{item.color[0].cve}}</option>
</select>




 <div class="control-group">
    <div class="controls input">
		<div class="input-prepend">
			<select id="thetallaindex" name="TheTallaIndex" ng-model="currentTalla" ng-options="t.label for t in item.talla"></select>
    	</div>
    </div>
    <span class="help-inline hide">Woohoo!</span>
 </div>


*/

</script>
