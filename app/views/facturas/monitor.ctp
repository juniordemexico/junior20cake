<?php echo $session->flash();?>

<div class="index">

<div id="monitorWrapper">
	<table id="monitorgrid" cellspacing="0">
		<thead>
			<tr>
				<th class="factura refer">Factura</th>
				<th class="factura date">Fecha</th>
				<th class="factura cve">Cliente</th>
				<th class="factura total">Total</th>
				<th class="factura st">ST</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($facturas as $factura):
			$thisID=trim($factura['Factura']['id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="factura refer" title="<?php echo 'Pedido: '.$factura['Factura']['fapedido']; ?>"><?php echo $factura['Factura']['farefer']; ?></td>
				<td class="factura date" title="Registrado: <?php echo $factura['Factura']['crefec'] . '. Modificado: ' . $factura['Factura']['modfec'] . '.'; ?>">
					<?php echo substr($factura['Factura']['fafecha'],2,8); ?>
				</td>
				<td class="factura cve" title="<?php echo $factura['Cliente']['clnom']; ?>">
					<?php echo $factura['Cliente']['clcvecli'].' '.$factura['Cliente']['cltda']; ?>
				</td>
				<td class="factura total"><?php echo $this->Number->currency( $factura['Factura']['factura__fatotal'] );?>
				</td>
				<td class="factura st"><?php echo $factura['Factura']['fast'];?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="paging">
</div>

</div>
