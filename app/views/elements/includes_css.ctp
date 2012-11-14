<?php

echo 
	$this->Html->css(array(
	
	// jQuery and Twitter's Bootstrap styles and themes 
	'jquery-ui/ui.jqgrid',
	'jquery-ui/custom-theme/jquery-ui-1.8.16.custom',
	'jquery-ui/ui.daterangepicker',
	'jquery-ui/ui.fileuploader',
	'bootstrap/bootstrap.min',
	'bootstrap/bootstrap-responsive.min',
	'bootstrap/bootstrap-image-gallery.min',
	'bootstrap/timepicker',
	// Application Main Styles 
	'ax.generic'
	)).CR.
	
	// MS Internet Explorer Fixes 
	'
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.8.16.ie.css"/>
	<![endif]-->'.CR.
	CR
	;
