<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Proveedor', array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr id="trFilter">
				<th class="cvepro"><?php echo $form->text('prcvepro', array('label' => '', 'type' => 'search', 'maxLength' => '16', 'placeholder' => 'Clave', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('prnom',array('label' => '', 'type' => 'search', 'maxLength' => '64', 'placeholder' => 'Nombre o Razón Social', 'class' => 'search-query'));?></th>
				<th class="atn"><?php echo $form->text('pratn',array('label' => '', 'type' => 'search', 'maxLength' => '32', 'placeholder' => 'At\'n', 'class' => 'search-query'));?></th>
				<th class="esedo"><?php echo $form->text('Estado.esedo',array('label' => '', 'type' => 'search', 'maxLength' => '32', 'placeholder' => 'Estado', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('prst',array('label' => '', 'type' => 'search', 'maxLength' => '1', 'placeholder' => 'ST', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>	
			</tr>
			<tr>
				<th class="cvepro"><?php echo $this->Paginator->sort('Clave','prcvepro'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razon Social','prnom'); ?></th>
				<th class="atn"><?php echo $this->Paginator->sort('At\'n','pratn'); ?></th>
				<th class="esedo"><?php echo $this->Paginator->sort('Estado','Estado.esedo'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','prst'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($proveedores as $proveedor):
			$class = null;
			$thisID=trim($proveedor['Proveedor']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="cvepro"><?php echo $proveedor['Proveedor']['prcvepro']; ?></td>
				<td class=""><?php echo $proveedor['Proveedor']['prnom']; ?></td>
				<td class="atn"><?php echo $proveedor['Proveedor']['pratn']; ?></td>
				<td class="esedo"><?php echo $proveedor['Estado']['esedo']; ?></td>
				<td class="st"><?php echo $proveedor['Proveedor']['prst']; ?></td>
				<td class="id"><?php echo $proveedor['Proveedor']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Proveedor','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
