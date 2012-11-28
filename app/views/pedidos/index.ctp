<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div id="gridWrapper">
<?php 
echo $form->create('Pedido',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr id="trFilter">
				<th class="refer"><?php echo $form->text('perefer', array('label' => '', 'type' => 'search', 'placeholder' => 'Folio', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('pefecha',array('label' => '', 'type' => 'search', 'placeholder' => 'Fecha', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('pefvence',array('label' => '', 'type' => 'search', 'placeholder' => 'Entrega', 'class' => 'search-query'));?></th>
				<th class="date"><?php echo $form->text('pefauto',array('label' => '', 'type' => 'search', 'placeholder' => 'F Autoriza', 'class' => 'search-query'));?></th>
				<th class="cvecli"><?php echo $form->text('Cliente.clcvecli',array('label' => '', 'type' => 'search', 'placeholder' => 'Cliente', 'class' => 'search-query'));?></th>
				<th class="tda"><?php echo $form->text('Cliente.cltda',array('label' => '', 'type' => 'search', 'placeholder' => 'Tda', 'class' => 'search-query'));?></th>
				<th class=""><?php echo $form->text('Cliente.clnom',array('label' => '', 'type' => 'search', 'placeholder' => 'Nombre o Razón Social', 'class' => 'search-query'));?></th>
				<th class="cveven"><?php echo $form->text('Vendedor.vecveven', array('label' => '', 'type' => 'search', 'placeholder' => 'Vendedor', 'class' => 'search-query'));?></th>
				<th class="total"><?php echo $form->text('petotal',array('label' => '', 'type' => 'search', 'placeholder' => 'Total', 'class' => 'search-query'));?></th>
				<th class="st"><?php echo $form->text('pest',array('label' => '', 'type' => 'search', 'placeholder' => 'ST', 'class' => 'search-query'));?></th>
				<th class="id">
				<?php
				echo $this->Js->submit('Filtrar', array('update' => '#content'));
				?>
				</th>	
			</tr>
			<tr>
				<th class="refer"><?php echo $this->Paginator->sort('Folio','perefer'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Fecha','pefecha'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('Vence','pefvence'); ?></th>
				<th class="date"><?php echo $this->Paginator->sort('F Autoriza','pefauto'); ?></th>
				<th class="cvecli"><?php echo $this->Paginator->sort('Cte','Cliente.clcvecli'); ?></th>
				<th class="tda"><?php echo $this->Paginator->sort('Tda','Cliente.cltda'); ?></th>
				<th class=""><?php echo $this->Paginator->sort('Razon Social','Cliente.clnom'); ?></th>
				<th class="cveven"><?php echo $this->Paginator->sort('Vend','Vendedor.vecveven'); ?></th>
				<th class="total"><?php echo $this->Paginator->sort('Total','petotal'); ?></th>
				<th class="st"><?php echo $this->Paginator->sort('ST','pest'); ?></th>
				<th class="id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($pedidos as $pedido):
			$class = null;
			$thisID=trim($pedido['Pedido']['id']);
		?>
			<tr id="<?php echo $thisID?>" class="t-row">
				<td class="refer"><?php echo $pedido['Pedido']['perefer']; ?></td>
				<td class="date"><?php echo substr($pedido['Pedido']['pefecha'],0,10); ?></td>
				<td class="date"><?php echo substr($pedido['Pedido']['pefvence'],0,10); ?></td>
				<td class="date"><?php echo substr($pedido['Pedido']['pefauto'],0,10); ?></td>
				<td class="cvecli"><?php echo $pedido['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($pedido['Cliente']['clsuc']); ?>"><?php echo $pedido['Cliente']['cltda']; ?></td>
				<td class=""><?php echo $pedido['Cliente']['clnom']; ?></td>
				<td class="cveven" title="<?php echo $pedido['Vendedor']['venom']; ?>"><?php echo $pedido['Vendedor']['vecveven']; ?></td>
				<td class="total"><?php echo $this->Number->currency($pedido['Pedido']['pedido__petotal']); ?></td>
				<td class="st"><?php echo $pedido['Pedido']['pest']; ?></td>
				<td class="id" title="<?php echo 'Creado: '.$pedido['Pedido']['crefec'].'. Modificado: '.$pedido['Pedido']['modfec'].'.'; ?>"><?php echo $pedido['Pedido']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
</div>

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name,'MyModel'=>'Cliente','MyRowClickAction' => 'edit')); ?>

</div> <!-- index-form -->

<?php echo 
$this->Js->get('.t-row')->event(
'click',
"location.replace('".$this->Html->url(array('action'=>'edit'))."/'+this.id);"
, array('stop' => true));
?>