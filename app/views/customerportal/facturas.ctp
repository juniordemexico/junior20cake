<ul>
<li>
<?php echo $this->Html->link('Descarga B0016027','/customer/facturaelectronica/B0016027');?>
</li>
<li>
<?php echo $this->Html->link('Descarga B0016028','/customer/facturaelectronica/B0016028');?>
</li>
<li>
<?php echo $this->Html->link('Descarga B0016030','/customer/facturaelectronica/B0016030');?>
</li>
</ul>

<?php
$this->Paginator->options(array('update' => '#customercontent',
								'evalScripts' => true));
?>
<div class="facturas index">

<div id="myWrapper">
<?php 
echo $form->create('Factura');
?>

	<table id="datagrid" cellspacing="0">
		<thead>
			<tr>
				<th class="factura refer"><?php echo $this->Paginator->sort('Factura','farefer'); ?></th>
				<th class="factura fecha"><?php echo $this->Paginator->sort('Fecha','fafecha'); ?></th>
				<th class="factura nom"><?php echo $this->Paginator->sort('Cte','clcvecli'); ?></th>
				<th class="factura nom"><?php echo $this->Paginator->sort('Tda','cltda'); ?></th>
				<th class="factura cveven"><?php echo $this->Paginator->sort('Vend','vecveven'); ?></th>
				<th class="factura total"><?php echo $this->Paginator->sort('Total','fatotal'); ?></th>
				<th class="factura st"><?php echo $this->Paginator->sort('ST','fast'); ?></th>
				<th class="factura id"><?php echo $this->Paginator->sort('ID','id'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($facturas as $factura):
			$class = null;
			$thisID=trim($factura['Factura']['id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="factura refer"><?php echo $factura['Factura']['farefer']; ?></td>
				<td class="factura fecha"><?php echo $factura['Factura']['fafecha']; ?></td>
				<td class="factura cvecli"><?php echo $factura['Cliente']['clcvecli']; ?></td>
				<td class="factura tda"><?php echo $factura['Cliente']['cltda']; ?></td>
				<td class="factura cveven"><?php echo $factura['Vendedor']['vecveven']; ?></td>
				<td class="factura total"><?php echo $this->Number->currency($factura['Factura']['fatotal']); ?></td>
				<td class="factura st"><?php echo $factura['Factura']['fast']; ?></td>
				<td class="factura id"><?php echo $factura['Factura']['id']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
<p class="counter">
<?php
	echo $paginator->counter(array(
		'format' => __('Página %page% de %pages% (%count% Registros)', true)
	));
?></p>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous',true),array(),null,array('class'=>'disabled'));?>
	&nbsp;|&nbsp;<?php echo $paginator->numbers(); ?>&nbsp;|&nbsp;
	<?php echo $paginator->next(__('next',true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

</div>
