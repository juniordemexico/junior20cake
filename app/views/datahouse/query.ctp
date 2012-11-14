<?php print_r($dataset);?>
<table class="datagrid">
<thead>
</thead>
<tbody>
	<?php foreach($dataset as $row):?>
	<tr>
		<?php foreach($row as $field => $value):?>
		<td><?php echo $value;?></td>
		<?php endforeach; ?>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>