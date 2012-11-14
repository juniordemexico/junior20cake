<div id="report_display" class="report_display">

<div class="report_name"><?php echo $report_name ?></div>
<div class="report_date_stamp">Generado: <?php echo date('m/d/Y H:i:s'); ?></div>
<div style="height: 25px;"></div>

<table class="report">
<tr class="header">
<?php foreach ($report_fields as $field): ?>

<td><?php echo ($field['display_name']=='' ? $field['field_name'] : $field['display_name']); ?></td>

<?php endforeach; ?>

</tr>


<?php for($i=0; $i<count($report_data); $i++) { ?>

<tr class="body">

<?php foreach ($report_fields as $field): ?>

<td>
<?php
	//Check to see if associated table is being used
	if(!empty($report_data[$i][$field['associated_table']][$field['model']][$field['field_name']])) {
		echo $report_data[$i][$field['associated_table']][$field['model']][$field['field_name']]; 
	}
	else if(!empty($report_data[$i][$field['model']][$field['field_name']])) {
		echo $report_data[$i][$field['model']][$field['field_name']]; 
	}
?>
	
</td>

<?php endforeach; ?>

</tr>

<?php } ?>
</table>

</div>







