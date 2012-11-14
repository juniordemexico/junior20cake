<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<?php

echo
	$this->Html->script(array(
		// Javascript frameworks, libraries and utilities
		'load-image.min',

		'jquery/jquery.min',
		'jquery/jquery-ui.min',

		'jquery/grid.locale-es',
		'jquery/jquery.jqGrid.min',
		'jquery/jquery.maskedinput-1.3.min',
		'jquery/jquery.fileuploader',

		'bootstrap/bootstrap.min',
		'bootstrap/bootbox.min.js',
		'bootstrap/bootstrap-typeahead.js',
		'bootstrap/bootstrap-timepicker',
		'bootstrap/bootstrap-image-gallery.min',
		// Application's libraries and utilities
		'axcore'
		)).CR.
	CR;
