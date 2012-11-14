<div class="vendedors view">

<dl>
	<dt class="altrow"><?php __("pais_papais"); ?></dt>
	<dd class="altrow"><?php echo $vendedor['Pais']['papais']; ?>&nbsp;</dd>
	<dt><?php __("divisa_dicve"); ?></dt>
	<dd><?php echo $vendedor['Divisa']['dicve']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("vecveven"); ?></dt>
	<dd class="altrow"><?php echo $vendedor['Vendedor']['vecveven']; ?>&nbsp;</dd>
	<dt><?php __("estado_esedo"); ?></dt>
	<dd><?php echo $vendedor['Estado']['esedo']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("divisa_dinom"); ?></dt>
	<dd class="altrow"><?php echo $vendedor['Divisa']['dinom']; ?>&nbsp;</dd>
	<dt><?php __("divisa_ditcambio"); ?></dt>
	<dd><?php echo $vendedor['Divisa']['ditcambio']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("id"); ?></dt>
	<dd class="altrow"><?php echo $vendedor['Vendedor']['id']; ?>&nbsp;</dd>
	<dt><?php __("venom"); ?></dt>
	<dd><?php echo $vendedor['Vendedor']['venom']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("created"); ?></dt>
	<dd class="altrow"><?php echo $vendedor['Vendedor']['created']; ?>&nbsp;</dd>
	<dt><?php __("vt"); ?></dt>
	<dd><?php echo $vendedor['Vendedor']['vt']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("vest"); ?></dt>
	<dd class="altrow"><?php echo $vendedor['Vendedor']['vest']; ?>&nbsp;</dd>
	<dt><?php __("modified"); ?></dt>
	<dd><?php echo $vendedor['Vendedor']['modified']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("vecomis"); ?></dt>
	<dd class="altrow"><?php echo $vendedor['Vendedor']['vecomis']; ?>&nbsp;</dd>


</dl>
</div>
<?php /*
<div class="related">
	<h3><?php __("related_clientes"); ?></h3>
	<?php if (!empty($vendedor['Cliente'])):?>
	<div id="gridWrapper">
		<table id="datagrid">
			<thead>
				<tr>
					<th class="cliente clcvecli"><?php __("clcvecli"); ?></th>
					<th class="cliente cltda"><?php __("cltda"); ?></th>
					<th class="cliente clnom"><?php __("clnom"); ?></th>
					<th class="cliente clsuc"><?php __("clsuc"); ?></th>
					<th class="cliente cllocfor"><?php __("cllocfor"); ?></th>
					<th class="cliente clst"><?php __("clst"); ?></th>
					<th class="cliente clt"><?php __("clt"); ?></th>
					<th class="cliente id"><?php __("id"); ?></th>
					<th class="actions"><?php __("actions"); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($vendedor['Cliente'] as $cliente):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
				<tr<?php echo $class;?>>
					<td class="cliente clcvecli"><?php echo $cliente['clcvecli']; ?></td>
					<td class="cliente cltda"><?php echo $cliente['cltda']; ?></td>
					<td class="cliente clnom"><?php echo $cliente['clnom']; ?></td>
					<td class="cliente clsuc"><?php echo $cliente['clsuc']; ?></td>
					<td class="cliente cllocfor"><?php echo $cliente['cllocfor']; ?></td>
					<td class="cliente clst"><?php echo $cliente['clst']; ?></td>
					<td class="cliente clt"><?php echo $cliente['clt']; ?></td>
					<td class="cliente id"><?php echo $cliente['id']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('view', true), array('controller' => 'clientes', 'action' => 'view', $cliente['id'])); ?>

						<?php echo $this->Html->link(__('edit', true), array('controller' => 'clientes', 'action' => 'edit', $cliente['id'])); ?>

						<?php echo $this->Html->link(__('delete', true), array('controller' => 'clientes', 'action' => 'delete', $cliente['id']), null, sprintf(__('Are you sure you want to delete # %%s ?', true), $cliente['id'])); ?>

					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
	</div>
</div>
*/ ?>
