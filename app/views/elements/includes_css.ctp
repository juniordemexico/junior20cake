<?php

echo 
	$this->Html->css(array(
	
	// jQuery's styles and themes 
	'jquery-ui/ui.jqgrid',
//	'jquery-ui/custom-theme/jquery-ui-1.8.16.custom',
	'jquery-ui/jquery.gritter',
	'jquery-ui/ui.daterangepicker',
	'jquery-ui/select2',
	'jquery-ui/fancybox.css',
	'jquery-ui/datepicker.css',
	'jquery-ui/timepicker.css',
	'jquery-ui/ui.fileuploader',
	'jquery-ui/fullcalendar',

	// Twitters Bootstrap's styles and themes 
	'bootstrap/bootstrap.min',
	'bootstrap/bootstrap-image-gallery.min',
	'ax.generic',
	'bootstrap/bootstrap-responsive.min',
	// Application Main Styles 
	)).CR;
	
	// MS Internet Explorer Fixes 
/*
	'
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.8.16.ie.css"/>
	<![endif]-->'.CR.
	CR
	;
*/