<div class="index">

<div id="monitorWrapper">
	<table id="monitorgrid" cellspacing="0">
		<thead>
			<tr>
				<th class="pedido refer"><?php echo $this->Paginator->sort('Pedido','perefer'); ?></th>
				<th class="pedido fecha"><?php echo $this->Paginator->sort('Fecha','pefecha'); ?></th>
				<th class="pedido cve"><?php echo $this->Paginator->sort('Cliente','clcvecli'); ?></th>
				<th class="pedido cve"><?php echo $this->Paginator->sort('Nombre','clnom'); ?></th>
				<th class="pedido total"><?php echo $this->Paginator->sort('Total','petotal'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($pedidos as $pedido):
			$thisID=trim($pedido['Pedido']['id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="pedido refer"><?php echo $pedido['Pedido']['perefer']; ?></td>
				<td class="pedido fecha"><?php echo substr($pedido['Pedido']['pefecha'],0,10); ?></td>
				<td class="pedido cve"><?php echo $pedido['Cliente']['clcvecli']; ?></td>
				<td class="pedido nom"><?php echo $pedido['Cliente']['clnom']; ?></td>
				<td class="pedido total"><?php echo round($pedido['Pedido']['petotal'],2); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
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
