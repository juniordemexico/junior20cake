<div class="index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Entsal',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
				<th class="refer"><?php echo $form->text('Entsal.esrefer', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'Folio...', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('Entsal.esfecha',array('label' => false, 'type' => 'search', 'maxLength' => '16', 'placeholder'=>'Fecha...', 'class' => 'search-query'));?></th>
				<th class="col4"><?php echo $form->text('Tipoartmovbodega.cve',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'Tipo de Mov...', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Entsal.esconcep',array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Concepto...', 'class' => 'search-query'));?></th>
				<th class="refer"><?php echo $form->text('Entsal.ocompra_refer', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'O Compra...', 'class' => 'search-query'));?></th>
				<th class="refer"><?php echo $form->text('Entsal.oproduce_refer', array( 'label' => false, 'type' => 'search', 'maxLength' => '8', 'placeholder'=>'O Produccion...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Entsal.st',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('Entsal.created',array('label' => false, 'type' => 'search', 'placeholder'=>'Creado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="refer"><?php echo $this->Paginator->sort('Folio','Entsal.esrefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','Entsal.esfecha'); ?></th>
				<th class="col4"><?php echo $this->Paginator->sort('Tipo','Tipoartmovbodega.cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Concepto','Entsal.esconcep'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Orden Compra','Entsal.ocompra_refer'); ?></th>
				<th class="refer"><?php echo $this->Paginator->sort('Orden Prod','Entsal.oproduce_refer'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Entsal.st'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Creado','Entsal.created'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Entsal']['id'];?>" class="t-row">
				<td class="refer"><?php echo $item['Entsal']['esrefer']; ?></td>
				<td class="date"><?php echo substr($item['Entsal']['esfecha'],0,10);?></td>
				<td class="col4"><?php echo $item['Tipoartmovbodega']['cve']; ?></td>
				<td class=""><?php echo $item['Entsal']['esconcep']; ?></td>
				<td class="refer"><?php echo $item['Entsal']['ocompra_refer']; ?></td>
				<td class="refer"><?php echo $item['Entsal']['oproduce_refer']; ?></td>
				<td class="st"><?php echo $item['Entsal']['st']; ?></td>
				<td class="datetime"><?php echo $item['Entsal']['created']; ?></td>
				<td class="id">
					<span title="Creado: <?php echo $item['Entsal']['created']; ?>  Modificado: <?php echo $item['Entsal']['modified']; ?>  T:<?php echo $item['Entsal']['est']; ?> Artmovbodega_id: <?php echo $item['Entsal']['tipoartmovbodega_id'];?>"
					data-ui-jq="tooltip" data-ui-jq-options="{placement:'left'}">
					<?php echo $item['Entsal']['id']; ?>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name, 'MyModel'=>'Entsal', 'MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php
echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".
$this->Html->url(array('action'=>(isset($clickAction)?$clickAction:'edit'))).
"/'+this.id);"
, array('stop' => true));
?>

<script language="javascript">

/* Begins Plain JS models/variables initialization ******************/
<?php echo $this->AxUI->getModelsAsJsObjects(); ?>

/* Begins Web UI controller's initialization ************************/
<?php echo $this->AxUI->initAppController(); ?>

/* Begins Web UI model's initialization *****************************/
<?php echo $this->AxUI->getModelsFromJsObjects(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->getAppGlobalMethods(); ?>

/* Begins Web UI Global Methods *****************************/
<?php echo $this->AxUI->closeAppController(); ?>

/* Begins Web UI App's default settings *****************************/
<?php echo $this->AxUI->getAppDefaults();?>

</script>

<?php
/*
myAxApp.value('ui.config', { jq: { tooltip: { placement: 'left' } } });

myAxApp.controller('AxAppCtrl', function( $scope, $element, $http, $dialog, localStorageService ) {

	// Main View Configuration, Routes and other symbols
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

*	$scope.date=new Date();

	// Sets the data object/array generated by the CakePHP's controller 
	// ------------Begin Controller's Data----------------------------------------
	$scope._data=<?php e(json_encode($this->data));?>;
	// ------------End Controller's Data------------------------------------------


	// Begins the angular controller's code specific to this View 

//	$scope.master=$scope._data.master;

});
*/
?>

<?php
//myAxApp.controller('AxAppCtrl', function( $scope, $element, $http, $dialog, localStorageService ) {

	/* Main View Configuration, Routes and other symbols */
//	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
//	$http.defaults.transformRequest
/*	
	$scope.app.base={
				"url": '/<?php e($this->name)?>',
				"controller": '<?php e(ucfirst($this->name))?>',
				"action": '<?php echo $this->action?>',
				"querystring": '<?php e('')?>',
				"timestamp": '<?php date('Y-m-d H:i:s')?>',
				"date": '<?php echo date('Y-m-d')?>',
				"localCachePrefix": "<?php e(strtolower($this->name).'_'.$this->action.'_'.$session->read('Auth.User.id').'.');?>"
				};

	$scope.user={
				"id": <?php e($session->read('Auth.User.id'));?>,
				"username": "<?php e($session->read('Auth.User.username'))?>",
				"group_id": <?php e($session->read('Auth.User.group_id'))?>
				};

	$scope.app.actions={	"cancel": $scope.app.base.url+'/'+'cancel.json',
						"delete": $scope.app.base.url+'/'+'delete.json',
						"print": $scope.app.base.url+'/'+'print.json',
						"add": $scope.app.base.url+'/'+'add.json',
						"getItemByCve": $scope.app.base.url+'/'+'getItemByCve.json'
					};

	$scope.estatus={
		"Activo": "A",
		"Baja": "B",
		"Cancelado": "C",
		"Suspendido": "S"
	};
*/

	// Main page's model's initialization
/*
	$scope.master={};
	$scope.details=[];
	$scope.related={};
*/
	/* Begins the angular controller's code specific to this View */
/*
	if ($scope._data != null && $scope._data.master != null) $scope.master=$scope._data.master; else $scope.master={};
	if ($scope._data != null && $scope._data.details != null) $scope.details=$scope._data.details; else $scope.details=[];
	
	if ($scope._data != null && $scope._data.related != null) $scope.related=$scope._data.related; else $scope.related={};
*/
	// Setup and initialization of the App user data's Local Storage
//	localStorageService.clearAll();
	
/*
	$scope.$watch($scope.app.localCachePrefix+'details', function(value) {
		localStorageService.add($scope.app.localCachePrefix+'details', angular.toJson(value));
		$scope.details = angular.fromJson(value); //angular.fromJson(localStorageService.get($scope.app.base.controller+$scope.app.base.action+'_details'));
	});
*/
//	$scope.formData={};

	/* Sets the data object/array generated by the CakePHP's controller  */
/*
	// ------------Begin Controller's Data----------------------------------------
//	$scope._data=<?php e(json_encode($this->data))?>;
	// ------------End Controller's Data------------------------------------------
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

?>
