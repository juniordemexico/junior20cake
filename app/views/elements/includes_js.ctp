<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<?php 
/* 
// Compile and minify all the js files, grouped by layers (ie: jquery, twitter bootstrap, ui mvc, axbos)
// To generate production's compiled files, from the Cake's Shell: 
// cake asset_compress.asset_compress build_ini 
// cake asset_compress.asset_compress build
 
  echo $this->AssetCompress->script('core.js'); 
  echo $this->AssetCompress->script('ui.js');
  echo $this->AssetCompress->script('ui-util.js');
*/

echo
	$this->Html->script(array(
		// Javascript frameworks, libraries and utilities

		'/js_files/core.js',
		'/js_files/ui.js',
		'/js_files/ui-util.js'
//		'load-image.min',

//		'jquery/jquery.min',
//		'jquery/jquery-ui.min',

/*
		'jquery/ensure.min',
		'jquery/jquery.transform.min',
//		'jquery/jquery.tools.min',

		'jquery/jquery.pulse.min',
		'jquery/jquery.pop',
		'jquery/jquery.maskedinput.min',
		'jquery/jquery.event.drag.min',
		'jquery/jquery.mousewheel.pack',
		'jquery/wz_jsgraphics',

		'jquery/jquery.gritter.min',
		'jquery/jquery.tipsy',
		'jquery/jquery.fancygestures',
		'jquery/jquery.fancybox.pack',

		'jquery/grid.locale-es',
		'jquery/jquery.jqGrid.min',
		'jquery/jquery.fileuploader',

		'bootstrap/bootstrap.min',
		'bootstrap/bootbox.min',
		'bootstrap/bootstrap-typeahead',
		'bootstrap/bootstrap-timepicker',
		'bootstrap/bootstrap-image-gallery.min',

		'webui/handlebars',
		'webui/ember',

		// AxBOS Bootstrap JS script
		'ax.bootstrap',
		
		// AxBOS Core Application's Functions, Classes, Helpers, Simbols
		'ax.core'
*/				
		)).CR.
	CR;
