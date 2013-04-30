
<div class="databasemonitors index">

<div id="gridWrapper">
<?php 
echo $form->create('DatabaseMonitor');
?>

	<table  id="datagrid" class="table table-bordered table-striped table-condensed">
		<thead>
			<tr id="trFilter">
				<th class="databasemonitor"><?php echo $form->text('mon$user', array('label' => '', 'type' => 'search', 'maxLength' => '16', 'class'=>'ax-fld-2'));?></th>
				<th class="databasemonitor cve"><?php echo $form->text('mon$attachment_id', array('label' => '', 'type' => 'search', 'maxLength' => '8'));?></th>
				<th class="databasemonitor id"><?php echo $form->text('mon$server_pid', array('label' => '', 'type' => 'search', 'maxLength' => '16'));?></th>
				<th class="databasemonitor ip"><?php echo $form->text('mon$remote_address', array('label' => '', 'type' => 'search', 'maxLength' => '15'));?></th>
				<th class="databasemonitor datetime"><?php echo $form->text('mon$timestamp', array('label' => '', 'type' => 'search', 'maxLength' => '16'));?></th>
				<th class="databasemonitor id">
					<?php echo $this->Js->submit('Filtrar', array('update' => '#content', 'class'=>'btn btn-mini', 'escape'=>false)); ?>
				</th>
			</tr>
			<tr>
				<th class="databasemonitor">User</th>
				<th class="databasemonitor cve">Attachment</th>
				<th class="databasemonitor id">Server PID</th>
				<th class="databasemonitor ip">Client IP</th>
				<th class="databasemonitor datetime">Timestamp</th>
				<th class="databasemonitor id">State</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($data as $thisStat):	?>
			<tr id="<?php echo $thisStat[0]['mon$attachment_id'];?>" class="t-row">
				<td class="databasemonitor"><?php echo $thisStat[0]['mon$user']; ?></td>
				<td class="databasemonitor cve"><?php echo $thisStat[0]['mon$attachment_id']; ?></td>
				<td class="databasemonitor id"><?php echo $thisStat[0]['mon$server_pid']; ?></td>
				<td class="databasemonitor ip"><?php echo $thisStat[0]['mon$remote_address']; ?></td>
				<td class="databasemonitor datetime"><?php echo $thisStat[0]['mon$timestamp']; ?></td>
				<td class="databasemonitor id"><?php echo $thisStat[0]['mon$state']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>

</div>
