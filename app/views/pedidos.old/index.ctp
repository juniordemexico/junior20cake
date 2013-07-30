<div class="span12 index-form">
<?php
$this->Paginator->options(array('update' => '#content',
								'evalScripts' => true,
								));
?>

<div class="gridWrapper">
<?php 
echo $form->create('Pedido',array('inputDefaults' => array(
															'label' => false,
															'div'   => false
															))
															);
?>
	<table id="datagrid" class="table table-bordered table-striped table-condensed table-hover">
		<thead>
			<tr class="row-filter">
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
			<tr class="row-labels">
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
		<?php foreach ($items as $item): ?>
			<tr id="<?php echo $item['Pedido']['id'];?>" class="t-row">
				<td class="refer"><?php echo $item['Pedido']['perefer']; ?></td>
				<td class="date"><?php echo substr($item['Pedido']['pefecha'],0,10); ?></td>
				<td class="date"><?php echo substr($item['Pedido']['pefvence'],0,10); ?></td>
				<td class="date"><?php echo substr($item['Pedido']['pefauto'],0,10); ?></td>
				<td class="cvecli"><?php echo $item['Cliente']['clcvecli']; ?></td>
				<td class="tda" title="<?php echo trim($item['Cliente']['clsuc']); ?>"><?php echo $item['Cliente']['cltda']; ?></td>
				<td class=""><?php echo $item['Cliente']['clnom']; ?></td>
				<td class="cveven" title="<?php echo $item['Vendedor']['venom']; ?>"><?php echo $item['Vendedor']['vecveven']; ?></td>
				<td class="total"><?php echo $this->Number->currency($item['Pedido']['pedido__petotal']); ?></td>
				<td class="st"><?php echo $item['Pedido']['pest']; ?></td>
				<td class="id" title="<?php echo 'Creado: '.$item['Pedido']['crefec'].'. Modificado: '.$item['Pedido']['modfec'].'. VentaexpoID: '.$item['Pedido']['ventaexpo_id'].'.'; ?>"><?php echo $item['Pedido']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div> <!-- gridWrapper -->

<?php echo $this->Element('MasterDetailIndexPaging',array('MyController'=>$this->name, 'MyModel'=>'Pedido', 'MyRowClickAction' => 'edit')); ?>

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

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
