
<script>

// http://plnkr.co/edit/vU2y87


angular.element(window).bind('keydown', function(e) {
  if (e.keyCode === 32) {
  el=document.getElementById('scanIn');
	el.focus();
/*
    $scope.$apply(function() {
      $scope.subpage = false;
    });
*/
  }
});


var item={
  user_id : 'guest',
  articulo_id : '111',
  articulo_cve : 'POWE',
  color_id : '222',
  color_cve : 'BLACK',
  descrip : 'Pantalon',
  talla_id : '1',
  talla_cve : 'CABALLEROS',
  cantidad: {
    t0 : '28',
    t1 : '29',
    t2 : '30',
    t3 : '31',
    t4 : '32',
    t5 : '34',
    t6 : '36',
    t7 : '38',
    t8 : '40',
    t9 : '42'
  }
};

function AxAppController( $scope ) {
  $scope.item = item;
  $scope.printLabel = false;  
  $scope.isKit = false;  
  $scope.save = function($scope) {
    console.log(this.item);
    alert(this.item.articulo_cve+' :: '+this.printLabel+' :: '+this.isKit+' :: '+this.item.cantidad.t0);
  };
}

</script>




<html ng-app>
  <head>
  <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet"></link>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="http://localhost/angularjs/angular.min.js"></script>
    <script src="script.js"></script>

  </head>
  <body>

<div id="content" class="row" ng-controller="AxAppController">
<div ng-form id="theForm" name="itemForm" class="form span5">
 
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
    <input type="text" id="cantt0" name="cantidadT0" ng-model="item.cantidad.t0" placeholder="28" class="span1"/>
    <input type="text" id="cantt1" name="cantidadT1" ng-model="item.cantidad.t1" placeholder="29" class="span1"/>
    <input type="text" id="cantt2" name="cantidadT2" ng-model="item.cantidad.t2" placeholder="30" class="span1"/>
    <input type="text" id="cantt3" name="cantidadT3" ng-model="item.cantidad.t3" placeholder="31" class="span1"/>
  </div>
  </div>
 
  <div class="control-group">
    <label class="checkbox" for="printLbl">Imprimir etiquetas
    <input type="checkbox" id="printLbl" name="printLabel" ng-model="printLabel" class="checkbox"/>
  </label>

  <div class="form-actions">
    <button ng:click="save()" ng:disabled="{{isSaveDisabled()}}" type="button" class="btn btn-primary btn-block">Guardar</button>
  </div>

  <div class="control-group well">
    <label class="control-label label" for="colcve">Scanner </label>
    <div class="controls">
      <input type="text" id="scanIn" name="scanInput" ng-model="scan_input" class="span4"/>
    </div>
    <span class="help-inline"><em class="text-info">{{scan_input}}</em></span>
  </div>

</div> <!-- div itemForm -->

<div id="divDebug" class="tiny span5">

<pre>

<ul>
  <li>Item: <small class="text-info">{{item}}</small></li>
  <li>Clave: {{item.articulo_cve}}</li>
  <li>Color: {{item.color_cve}}</li>
  <li>Paquete: {{isKit}}</li>
  <li>Etiqueta: {{printLabel}}</li>
  <li><em>Cantidades:</em>
    <ul class="inline">
    <li>{{item.cantidad.t0}}</li>
    <li>{{item.cantidad.t1}}</li>
    <li>{{item.cantidad.t2}}</li>
    <li class="">{{item.cantidad.t3}}</li>
    </ul>
  </li>
</ul>

  
</pre>

</div> <!-- divDebug -->

  </body>
</html>
