
<div class="databasemonitors index">

<div id="gridWrapper">
<?php 
echo $form->create('DatabaseMonitor');
?>

	<table  id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr id="trFilter">
				<th class="databasemonitor cve"><?php echo $form->text('mon$user', array('label' => '', 'type' => 'search', 'maxLength' => '16'));?></th>
				<th class="databasemonitor refer"><?php echo $form->text('mon$attachment_id', array('label' => '', 'type' => 'search', 'maxLength' => '8'));?></th>
				<th class="databasemonitor refer"><?php echo $form->text('mon$transaction_id', array('label' => '', 'type' => 'search', 'maxLength' => '8'));?></th>
				<th class="databasemonitor datetime"><?php echo $form->text('mon$timestamp', array('label' => '', 'type' => 'search', 'maxLength' => '16'));?></th>
				<th class="databasemonitor st"><?php echo $form->text('mon$state', array('label' => '', 'type' => 'search', 'maxLength' => '8'));?></th>
				<th class="databasemonitor ip"><?php echo $form->text('mon$remote_address', array('label' => '', 'type' => 'search', 'maxLength' => '15'));?></th>
				<th class="databasemonitor sqltext"><?php echo $form->text('mon$sql_text', array('label' => '', 'type' => 'search', 'maxLength' => '128'));?></th>
			</tr>
			<tr>
				<th class="databasemonitor cve">User</th>
				<th class="databasemonitor refer">Attach</th>
				<th class="databasemonitor refer">Transac</th>
				<th class="databasemonitor datetime">Timestamp</th>
				<th class="databasemonitor st">State</th>
				<th class="databasemonitor ip">Client IP</th>
				<th class="databasemonitor">SQL Query</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($data as $thisStat):	?>
			<tr id="<?php echo $thisStat[0]['mon$transaction_id'];?>" class="t-row">
				<td class="databasemonitor cve"><?php echo $thisStat[0]['mon$user']; ?></td>
				<td class="databasemonitor refer"><?php echo $thisStat[0]['mon$attachment_id']; ?></td>
				<td class="databasemonitor refer"><?php echo $thisStat[0]['mon$transaction_id']; ?></td>
				<td class="databasemonitor datetime"><?php echo $thisStat[0]['mon$timestamp']; ?></td>
				<td class="databasemonitor st"><?php echo $thisStat[0]['mon$state']; ?></td>
				<td class="databasemonitor ip"><?php echo $thisStat[0]['mon$remote_address']; ?></td>
				<td class="databasemonitor"><?php echo h($thisStat[0]['mon$sql_text']); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>

</div>
