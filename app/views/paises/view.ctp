<div class="paiss view">

<dl>
	<dt class="altrow"><?php __("cve"); ?></dt>
	<dd class="altrow"><?php echo $pais['Pais']['cve']; ?>&nbsp;</dd>
	<dt><?php __("nom"); ?></dt>
	<dd><?php echo $pais['Pais']['nom']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("divisa_cve"); ?></dt>
	<dd class="altrow"><?php echo $pais['Divisa']['cve']; ?>&nbsp;</dd>
	<dt><?php __("id"); ?></dt>
	<dd><?php echo $pais['Pais']['id']; ?>&nbsp;</dd>
	<dt class="altrow"><?php __("created"); ?></dt>
	<dd class="altrow"><?php echo $pais['Pais']['created']; ?>&nbsp;</dd>
	<dt><?php __("modified"); ?></dt>
	<dd><?php echo $pais['Pais']['modified']; ?>&nbsp;</dd>


</dl>
</div>

<div class="related">
	<h3><?php __("related_estados"); ?></h3>
	<?php if (!empty($pais['Estado'])):?>
	<div id="gridWrapper">
		<table id="datagrid">
			<thead>
				<tr>
					<th class="estado cve"><?php __("cve"); ?></th>
					<th class="estado nom"><?php __("nom"); ?></th>
					<th class="estado id"><?php __("id"); ?></th>
					<th class="actions"><?php __("actions"); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($pais['Estado'] as $estado):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
				<tr<?php echo $class;?>>
					<td class="estado cve"><?php echo $estado['cve']; ?></td>
					<td class="estado nom"><?php echo $estado['nom']; ?></td>
					<td class="estado id"><?php echo $estado['id']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('view', true), array('controller' => 'estados', 'action' => 'view', $estado['id'])); ?>

						<?php echo $this->Html->link(__('edit', true), array('controller' => 'estados', 'action' => 'edit', $estado['id'])); ?>

						<?php echo $this->Html->link(__('delete', true), array('controller' => 'estados', 'action' => 'delete', $estado['id']), null, sprintf(__('Are you sure you want to delete # %%s ?', true), $estado['id'])); ?>

					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
	</div>
</div>
