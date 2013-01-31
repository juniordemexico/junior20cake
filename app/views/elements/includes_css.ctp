<?php
/*
echo $this->AssetCompress->css('core.css');
echo $this->AssetCompress->css('ui.css');
*/

echo 
	$this->Html->css(array(
	'/css_files/core.css',
	'/css_files/ui.css',
	'/css/angular-ui.min.css',	
	'/css_files/ui-responsive.css',
	// jQuery's styles and themes 
//	'jquery-ui/custom-theme/jquery-ui-1.8.16.custom',
/*
	'jquery-ui/jquery.gritter',
	'jquery-ui/select2',
	'jquery-ui/fancybox.css',
	'jquery-ui/datepicker.css',
	'jquery-ui/timepicker.css',
	// Twitters Bootstrap's styles and themes 
	'ax.generic',
	'bootstrap/bootstrap-responsive.min',
*/
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