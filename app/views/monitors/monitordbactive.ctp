
<div class="databasemonitors index">

<div id="gridWrapper">
<?php 
echo $form->create('DatabaseMonitor');
?>

	<table  id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr id="trFilter">
				<th class="databasemonitor"><?php echo $form->text('mon$user', array('label' => '', 'type' => 'search', 'maxLength' => '16'));?></th>
				<th class="databasemonitor cve"><?php echo $form->text('mon$attachment_id', array('label' => '', 'type' => 'search', 'maxLength' => '8'));?></th>
				<th class="databasemonitor id"><?php echo $form->text('mon$state', array('label' => '', 'type' => 'search', 'maxLength' => '8'));?></th>
				<th class="databasemonitor ip"><?php echo $form->text('mon$remote_address', array('label' => '', 'type' => 'search', 'maxLength' => '15'));?></th>
			</tr>
			<tr>
				<th class="databasemonitor">User</th>
				<th class="databasemonitor cve">Attachment</th>
				<th class="databasemonitor id">State</th>
				<th class="databasemonitor ip">Client IP</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($data as $thisStat):	?>
			<tr id="<?php echo $thisStat[0]['mon$attachment_id'];?>" class="t-row">
				<td class="databasemonitor"><?php echo $thisStat[0]['mon$user']; ?></td>
				<td class="databasemonitor cve"><?php echo $thisStat[0]['mon$attachment_id']; ?></td>
				<td class="databasemonitor id"><?php echo $thisStat[0]['mon$state']; ?></td>
				<td class="databasemonitor ip"><?php echo $thisStat[0]['mon$remote_address']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>

</div>
