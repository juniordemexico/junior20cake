<div class="span12 index-form">
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
				<th class="cve"><?php echo $form->text('Tipoartmovbodega.cve',array('label' => false, 'type' => 'search', 'maxLength' => '4', 'placeholder'=>'T Mov...', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Entsal.esconcep',array('label' => false, 'type' => 'search', 'maxLength' => '32', 'placeholder'=>'Concepto...', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('Entsal.esst',array('label' => false, 'type' => 'search', 'maxLength' => '1', 'placeholder'=>'ST...', 'class' => 'search-query'));?></th>
				<th class="datetime"><?php echo $form->text('Entsal.created',array('label' => false, 'type' => 'search', 'placeholder'=>'Creado', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr class="row-labels">
				<th class="refer"><?php echo $this->Paginator->sort('Folio','Entsal.esrefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','Entsal.esfecha'); ?></th>
				<th class="cve"><?php echo $this->Paginator->sort('T Mov','Tipoartmovbodega.cve'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Concepto','Entsal.esconcep'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','Entsal.esst'); ?></th>
				<th class="datetime"><?php echo $this->Paginator->sort('Creado','Entsal.created'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Entsal']['id'];?>" class="t-row">
				<td class="refer"><?php echo $item['Entsal']['esrefer']; ?></td>
				<td class="date"><?php echo substr($item['Entsal']['esfecha'],0,10);?></td>
				<td class="cve"><?php echo $item['Tipoartmovbodega']['cve']; ?></td>
				<td class=""><?php echo $item['Entsal']['esconcep']; ?></td>
				<td class="st"><?php echo $item['Entsal']['esst']; ?></td>
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

<script>

myAxApp.value('ui.config', { jq: { tooltip: { placement: 'left' } } });

myAxApp.controller('AxAppCtrl', function( $scope, $element, $http, $dialog, localStorageService ) {

	/* Main View Configuration, Routes and other symbols */
	$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
	$scope.base={
				timestamp: '<?php date('Y-m-d H:i:s')?>',
				url: '/<?php e($this->name)?>',
				controller: '<?php e($this->name)?>',
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

	$scope.actions={	setItem: $scope.base.url+'/'+$scope.base.controller+'/'+'addTela',
						changeItem: $scope.base.url+'/'+$scope.base.controller+'/'+'changeitem'
					};

	$scope.date=new Date();

	/* Sets the data object/array generated by the CakePHP's controller  */
	// ------------Begin Controller's Data----------------------------------------
	$scope._data=<?php e(json_encode($this->data));?>;
	// ------------End Controller's Data------------------------------------------


	/* Begins the angular controller's code specific to this View */

//	$scope.master=$scope._data.master;
});


</script>
