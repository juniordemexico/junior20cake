<div id="formContainer" class="row almacenmovil table-bodega">
<form id="itemForm" ng-submit="submit()" ng-controller="AxAppController"
	name="itemForm" class="form ng-cloak">

<div id="userContainer" class="section-container" style="margin-top: 4px;">
	<legend><small>Usuario: <strong>{{user.username}}</strong></small>
	</legend>
	<div>
		<button id="btnScanFocus" name="btn_scan_focus" type="button" class="btn btn-mini" ng-click="scanFocus()">Leer Código</button>
	</div>
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
	<legend><span class="text-info">Material</span> &nbsp;&nbsp; <strong><em>{{item.articulo_descrip}}</em></strong></legend>
  	<div class="control-group">
    	<div class="input">
      		<input type="text" id="artcve" name="articuloCve" ng-model="item.articulo_cve" class="input-large" placeholder="Clave del Material..."/>
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

<div id="tallaContainer" class="section-container hide" style="margin-top: 32px;">
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
	<legend><span class="text-info">Cantidad</span> &nbsp;&nbsp;<strong><em>{{cantidad}}</em></strong></em>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-small" ng-click="minusCant(1)">&nbsp;&nbsp;&nbsp;-1&nbsp;&nbsp;&nbsp;</button>
			<button type="button" class="btn btn-small" ng-click="plusCant(1)">&nbsp;&nbsp;&nbsp;+1&nbsp;&nbsp;&nbsp;</button>
			<button type="button" class="btn btn-small" ng-click="minusCant(10)">&nbsp;&nbsp;&nbsp;-10&nbsp;&nbsp;&nbsp;</button>
			<button type="button" class="btn btn-small" ng-click="plusCant(10)">&nbsp;&nbsp;+10&nbsp;&nbsp;&nbsp;</button>
			<button type="button" class="btn btn-small" ng-click="minusCant(100)">&nbsp;&nbsp;-100&nbsp;&nbsp;&nbsp;</button>
			<button type="button" class="btn btn-small" ng-click="plusCant(100)">&nbsp;&nbsp;+100&nbsp;&nbsp;&nbsp;</button>
		</div>
	</legend>
	<div class="control-group">
		<div class="input">
    			<input type="text" id="edtcantidad" name="edtCantidad" ng-model="cantidad"
 					ng-change="calculateTotal()"
					class="input-large" title="Talla {{currentTalla.label}}" placeholder="Cantidad en Talla  {{currentTalla.label}}" />
  		</div>
    	<span class="help-inline hide">&nbsp;</span>
	</div>
</div>

<div id="printlabelsContainer" class="section-container" style="margin-top: 40px;">
	<legend><span class="text-info">Etiquetas</span> &nbsp;&nbsp;<strong ng-show="printLabel"><em>{{currentPrinter.cve}} &nbsp;&nbsp;
	<small ng-show="printLabelPerPackage">( {{etiquetas.paquetes}} paquetes. {{etiquetas.unidades}} pzas. )</small>
	<small ng-show="!printLabelPerPackage">( {{cantidad}} pzas. )</small>
	</em></strong>
		<div class="btn-group pull-right">
			<button
				type="button" 
				class="btn btn-small" 
				id="btnPrinterSelect{{$index}}"
				ng-model="currentPrinter"
				ng-repeat="onePrinter in printer"
				ng-click="$parent.currentPrinter=$parent.printer[$index]"
				>
				{{onePrinter.cve}}
			</button>
		</div>

	</legend>
	
  	<div class="control-row">
    	<label class="checkbox" for="printlabel"> Imprimir Etiquetas de Esta Entrada
    		<input type="checkbox" id="printlabel" name="printLabel" 
				ng-model="printLabel" class="checkbox"
			/>
  		</label>
		&nbsp;&nbsp;&nbsp;&nbsp;
    	<label class="checkbox" for="printlabelperpackage" ng-disabled="!printLabel"
				title="Seleccionar para UNA Etiqueta Por Paquete. Y UNA por Pieza para los Picos.">
			Por Paquetes &nbsp;&nbsp;<small>(de 10 unidades)</small>
    		<input type="checkbox" id="printlabelperpackage" name="printLabelPerPackage" 
				ng-model="printLabelPerPackage" ng-disabled="!printLabel"
				class="checkbox"
			/>
  		</label>
	</div>
</div>

<div id="actionsContainer" class="section-container" style="margin-top: 36px;">
  <div class="form-actions section-container">
  	<button ng-click="save()" type="button" class="btn btn-primary btn-block">
		Guardar
	</button>
  	<button type="submit" id="submit" value="sumbit"
		style="z-index: -1; border: 0px none; margin: 0px; padding: 0px;width: 1px; height: 1px; background: transparent;"></button>
  	</div>
	<em class="text-info">Actividad:</em>
  	<div id="divUltimoMensaje" style="overflow-y: scroll; min-height: 32px; max-height: 100px;">
	<ul  style="overflow-y: scroll; min-height: 32px; max-height: 100px;">
		<li ng-repeat="lastMessage in lastMessages">
			<span class="help-inline">{{lastMessage}}</span>
		</li>
	</ul>
	</div>
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


/*
angular.element(window).bind('keydown', function(e) {
	if (e.keyCode === 16) {
		el=document.getElementById('scanInput');
		el.focus();

//    $scope.$apply(function() {
//      $scope.subpage = false;
//    });
	}
});
*/
var itemTalladetail={};

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
};

var ubicacion={
	id : 1,
	cve : "A00-0000",
	zona : "A",
	fila : "01",
	espacio: "0000"
};

var tipomov = [
{id: 10, cve: 'ENTRADA DIRECTA' },
{id: 20, cve: 'ORDEN DE PRODUCCIÓN' },
{id: 110, cve: 'CANC PEDIDO' },
{id: 50, cve: 'CAMBIO UBICACION DESTINO' },
{id: -10, cve: 'CANC ENTRADA DIRECTA' }
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
	
	$scope.currentFolio='';
	$scope.currentTalla={};
	$scope.currentColor={};
	$scope.currentPrinter=printer[0];
	$scope.currentTipomov;
	
	$scope.scanInput = '';		// Every barcode scanner's reads are redirected through this
	
	$scope.lastCve='';
	$scope.lastUbicacionCve='';		// This is the Controller's Ubication Model
	$scope.lastMessage='';
	$scope.lastMessages=[];
	$scope.lastScanInput = '';	// Holds the last processed scanner read

	$scope.printLabel='';
	$scope.printLabelMessage='';

	$scope.cancelTransaction='';
	$scope.cancelTransactionMessage='';

	$scope.cantidad=0;			// This is the Controller's Ubication Model

	$scope.reprintLabel = '';  // For Isolated Label Print or Reprint

	$scope.printLabel = false;  // We need to print a barcode label after save the data?
	$scope.printLabelPerPackage = true;  // Print one label per Package
	$scope.etiquetas={paquetes: 0, unidades: 0, unidadesxpaquete: 10};
	
	// We have all the required data in our form?
	$scope.disableSaveBtn=false;


	$scope.calculateTotal = function() {
		var paquetes=0;
		var unidades=0;
		var unidadesxpaquete=$scope.etiquetas.unidadesxpaquete;
		$scope.etiquetas.paquetes=Math.floor($scope.cantidad/$scope.etiquetas.unidadesxpaquete);
		$scope.etiquetas.unidades=$scope.cantidad-($scope.etiquetas.paquetes*$scope.etiquetas.unidadesxpaquete);
		return (true);
	}
	
	// Save and push this record to the server
	$scope.save = function() {
		console.log("Envia Forma: "+$scope.item.articulo_cve+', '+$scope.item.color_cve+', '+$scope.item.talla_index);
		$scope.item.cantidad=$scope.cantidad;

		$scope.item.color_id=$scope.currentColor.id;
		$scope.item.color_cve=$scope.currentColor.cve;

		if(typeof $scope.ubicacion.id == 'undefined' || !($scope.ubicacion.id>0)) {
			axAlert('Especifica la Ubicación', 'warning', false);
			return false;
		}

		if(!($scope.currentTipomov.id!=0)) {
			axAlert('Especifica el Tipo de Movimiento', 'warning', false);
			return false;
		}

		if(typeof $scope.currentColor.id == 'undefined' || !($scope.currentColor.id!=0)) {
			axAlert('Especifica el Color', 'warning', false);
			return false;
		}

/*
		if(typeof $scope.currentTalla.index == 'undefined') {
			axAlert('Especifica la Talla', 'warning', false);
			return false;
		}
*/
		$scope.disableSaveBtn=true;
		$http.get('/Bodegas/addtransaction?'+
				'articulo_id='+$scope.item.articulo_id+
				'&color_id='+$scope.item.color_id+
				'&talla_index=0'+ //+$scope.currentTalla.index+
				'&cantidad='+$scope.cantidad+
				'&ubicacion_id='+$scope.ubicacion.id+
				'&tipoartmovbodega_id='+$scope.currentTipomov.id+
				'&folio='+$scope.currentFolio+
				'&printlabel='+($scope.printLabel?'1':'0')+
				'&printlabelperpackage='+($scope.printLabelPerPackage?'1':'0')+
				'&selectedprinter='+$scope.currentPrinter.id
		).then(function(response) {
			if(typeof response.data != 'undefined') {
				if(typeof response.data.result=='string' && response.data.result=='recibido' ) {
					axAlert(response.data.message, 'success', false);
					$scope.lastMessages.unshift(response.data._timestamp+': '+$scope.item.articulo_cve+', '+$scope.item.color_cve+', '+$scope.currentTalla.label+', '+$scope.cantidad+' pz (id: '+response.data._id+')');
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
					$scope.lastMessages.unshift(response.data.message);
				}
			}
			else {
					axAlert('Error Irrecuperable...'+response.data, 'error', false);
			}
			$scope.disableSaveBtn=false;
   		});

	};

	// Save and push this record to the server

	$scope.submit = function() {
		alert('Un submit');
	};


	$scope.getUbicacion = function() {

		console.log('Get Ubicacion: ' + $scope.ubicacion.cve);

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
				axAlert('Material Inválido', 'warning', false);
				var oldArticuloCve=$scope.item.articulo_cve;
			//	$scope.item.articulo_descrip='';
			//	$scope.item.articulo_id='';
				$scope.item=item;
				$scope.item.articulo_cve=oldArticuloCve;
			}
			else {
				$scope.item=response.data;
			}

			}
       	});
	};

	$scope.getItem = function() {
		console.log('Get Item: '+$scope.item.articulo_id);
		$http.get('/Bodegas/getitem/'+$scope.item.articulo_id+'/'+$scope.item.color_id+'/'+$scope.item.talla_index).then(function(response) {
			if(typeof response.data != 'undefined') {
				if(typeof response.data.result != 'undefined' ||
					typeof response.data.result == 'string') {
					axAlert('Error al solicitar el Material', 'warning', false);
				}
				else {
					$scope.item=response.data;
					$scope.currentColor={id: $scope.item.color_id, cve: $scope.item.color_cve};
					$scope.currentTalla={index: $scope.item.talla_index, label: $scope.item.talla_label};
				}
			}
       	});
	};

	$scope.getTransaccion = function(id) {
		if(typeof id== 'undefined') {
			id = $scope.currentFolio;
		}

		console.log('Get Transaccion: '+$scope.item.articulo_id);
		$http.get('/Bodegas/gettransaccion/'+id).then( function (response) {
			if(typeof response.data != 'undefined') {
				if(typeof response.data.result != 'undefined' ||
					typeof response.data.result == 'string') {
					axAlert('Error al solicitar la Transaccion', 'warning', false);
				}
				else {
					$scope.currentFolio=response.data.folio;
				}
			}
       	});
	};

	$scope.requestPrintLabel = function() {
		$http.get('/Bodegas/etiquetaentrada/'+$scope.printLabel).then(function(response) {
			if(typeof response.data != 'undefined') {
				$scope.printLabelMessage='Imprimió Etiqueta ' + $scope.printLabel;
				axAlert('Material '+$scope.printLabel+' impreso.', 'info', false);
				$scope.printLabel='';
			}
       	});

	}

	$scope.requestCancelTransaction = function() {
		$http.get('/Bodegas/cancel/'+$scope.cancelTransaction).then(function(response) {
			if(typeof response.data != 'undefined') {
				$scope.cancelTransactionMessage='Se CANCELO la transacción ' + $scope.cancelTransaction;
				axAlert('Transacción <strong>'+$scope.cancelTransaction+'</strong> CANCELADA.', 'success', false);
				$scope.lastMessages.unshift('Transacción <strong>'+$scope.cancelTransaction+'</strong> CANCELADA.')
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
		$scope.calculateTotal();
	}

	$scope.plusCant = function(value) {
		var oldValue=parseInt($scope.cantidad);
		$scope.cantidad=(oldValue>0?oldValue:0) + value;
		$scope.calculateTotal();
	}

	$('#ubicacioncve').bind('blur', function() {
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

			theValue=theValue.replace(/\%/g,':');
			theValue=theValue.replace('t:u','"t":"u"');
			theValue=theValue.replace('t:p','"t":"p"');
			theValue=theValue.replace('t:t','"t":"t"');
			theValue=theValue.replace('t:f','"t":"f"');
			theValue=theValue.replace('id:','"id":');
			theValue=theValue.replace('c:','"c":');
			theValue=theValue.replace('t:','"t":');
			theValue=theValue.replace('p:','"p":');

			// Extracts the Label's type
			$scope.lastScanInput=theValue;
			console.log('RAW Scan:'+theValue);
//			alert('RAW Scan:'+theValue);
			var theType=theValue.substring(5,6);

			// Trunk and Checks if the value already has json's brackets '{}'
			var theValue=theValue.substring(8);
			if(theValue.substring(0,1)!='{') theValue='{' + theValue.substring() + '}';
			var theDataObj=jsonParse(theValue);
//			alert('Scanned input to JSON'+(typeof theDataObj.id));
			console.log('Scanned input to JSON string:' + theValue + 
						' id:'+theDataObj.id);

			/* Ubicacion (t=u, id=ubicacion_id) */
			if(theType=='u') {
				$scope.ubicacion.cve=theDataObj.id;
				$scope.getUbicacion();
				
				if($('#artcve').val()!='') {
					$('#edtcantidad').focus();
				}
				else {
					$('#artcve').focus();				
				}
			}

			/* Transaccion (t=t, id=transaccion_id) */
			if(theType=='t') {
				var id=theDataObj.id;
				
				$scope.getTransaccion(id);
				
				if($('#folio').val()!='') {
					$('#edtcantidad').focus();
				}
				else {
					$('#folio').focus();				
				}
			}

			/* Folio / Referencia (t=f, id=(string)folio ) */
			if(theType=='f') {
				var id=theDataObj.id;
				$scope.currentFolio=theData.obj;
				
				if($('#folio').val()!='') {
					$('#artcve').focus();
				}
				else {
					$('#folio').focus();				
				}
			}

			/* Producto con Talla. Color y Cantidad (t=p, id=articulo_id, c=color_id, t=talla_index, p=cantidad ) */
			if(theType=='p') {
//				alert('entre a decodificar');
				$scope.lastScanInput=theValue;

				// Set the label's specified Articulo Id or Cve
				$scope.item.articulo_id=theDataObj.id;
				$scope.item.color_id=theDataObj.c;
				$scope.item.talla_index=theDataObj.t;

				// Get the Articulo data
				console.log('Label Articulo:' + theDataObj.id);
				$scope.getItem(theDataObj.id, theDataObj.c, theDataObj.t, theDataObj.p);

				// Set the label's specified Talla
				console.log('Label Talla:' + theDataObj.t);

				// Set the label's specified Color
				console.log('Label Color:' + theDataObj.c);

				// Set the label's specified Cantidad
				console.log('Label Cantidad:' + theDataObj.p);
				if(typeof theDataObj.p != 'undefined' && typeof theDataObj.p=='number' ) {
					$scope.cantidad=theDataObj.p;
				}
				else {
					$scope.cantidad=0;
				}

				// Set the focus
				if($('#ubicacioncve').val()!='') {
					$('#edtcantidad').focus();
				}
				else {
					$('#ubicacioncve').focus();				
				}
			}
			
			console.log('Processed scanner input:' + theValue);
		}

		$scope.$apply( function(){$scope.scanInput=''; } );

	});

	$scope.scanFocus = function() {
		var el=document.getElementById('scanInput').focus();
		$scope.scanInput='';
	};
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



<div id="reprintContainer" class="section-container" style="margin-top: 32px;">
	<legend><span class="text-info">Imprimir Etiqueta de Producto</span> &nbsp;&nbsp;</strong></legend>
	<div class="control-group">
 			<div class="input-append">
      		<input type="text" id="reprintlabel" name="reprintLabel" ng-model="reprintLabel" placeholder="Clave del Producto..." />
			<button type="button" class="btn btn-primary" ng-click="requestReprintLabel()">
				<i class="icon icon-print icon-white"></i> Imprimir
			</button>
    		</div>
     <span class="help-inline" ng-show="reprintLabelMessage"><strong><em class="text-warning">{{reprintLabelMessage}}</em></strong></span>
	</div>
</div>

*/

</script>
