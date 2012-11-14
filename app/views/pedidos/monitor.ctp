<?php echo $session->flash();?>
<div class="index">

<div id="monitorWrapper">
	<table id="monitorgrid" cellspacing="0">
		<thead>
			<tr>
				<th class="pedido refer">Pedido</th>
				<th class="pedido date">Fecha</th>
				<th class="pedido cve">Cliente</th>
				<th class="pedido cve">Vend</th>
				<th class="pedido total">Total</th>
				<th class="pedido st">Auto</th>
				<th class="pedido st">ST</th>
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
				<td class="pedido date" title="Registrado: <?php echo $pedido['Pedido']['crefec'].'. Modificado: '.$pedido['Pedido']['modfec'].'.'; ?>"><?php echo substr($pedido['Pedido']['pefecha'],2,8); ?></td>
				<td class="pedido cve" title="<?php echo $pedido['Cliente']['clnom']; ?>"><?php echo $pedido['Cliente']['clcvecli'].' '.$pedido['Cliente']['cltda']; ?></td>
				<td class="pedido cve" title="<?php echo $pedido['Vendedor']['venom']; ?>"><?php echo $pedido['Vendedor']['vecveven']?></td>
				<td class="pedido total"><?php echo $this->Number->currency($pedido['Pedido']['pedido__petotal']); ?></td>
				<td class="pedido st" title="<?php echo 'Fecha de Autorizacion:'. $pedido['Pedido']['pefauto']; ?>"><?php echo ($pedido['Pedido']['peauto']==1?'&nbsp;S':'');?></td>
				<td class="pedido st"><?php echo $pedido['Pedido']['pest']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="paging">
</div>

</div>
