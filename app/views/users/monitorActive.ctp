
<div class="databasemonitors index">

<div id="gridWrapper">
<?php 
echo $form->create('DatabaseMonitorActive');
?>

	<table id="datagrid" cellspacing="0" style="max-width: 90%;min-width: 600px;width: 90%;">
		<thead>
			<tr>
				<th class="databasemonitor cve">User</th>
				<th class="databasemonitor id">Attachment</th>
				<th class="databasemonitor id">State</th>
				<th class="databasemonitor ip">Client IP</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$thisID='';
		$i = 0;
		foreach ($data as $thisStat):
			$class = null;
			$thisID=trim($thisStat[0]['mon$attachment_id']);
			$class = ($i++ % 2 == 0) ?
					' class="renglon altrow"' :
					' class="renglon"';
		?>
			<tr id="<?php echo $thisID?>" <?php echo $class;?>>
				<td class="databasemonitor cve"><?php echo $thisStat[0]['mon$user']; ?></td>
				<td class="databasemonitor id"><?php echo $thisStat[0]['mon$attachment_id']; ?></td>
				<td class="databasemonitor id"><?php echo $thisStat[0]['mon$state']; ?></td>
				<td class="databasemonitor ip"><?php echo $thisStat[0]['mon$remote_address']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>

</div>
