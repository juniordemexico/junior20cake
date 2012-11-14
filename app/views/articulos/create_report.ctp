<?php

if(!empty($report_form)) {	
	//Build Form
	echo $this->element('report_form',$report_form);
}
else {	
	//Build Form
	echo $this->element('report_display', array("report_data" => $report_data, "report_fields" => $report_fields, "report_name" => $report_name));
}

?>

