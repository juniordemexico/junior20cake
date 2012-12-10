<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml" manifest="/cache.manifest">
<head>

	<title><?php echo $title_for_layout; ?></title>

	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php echo $this->element('includes_meta', array('request'=>$request, 'session'=>$session, 'title_for_layout'=>$title_for_layout, 'metatags'=>array() )); ?>

	<!-- Request, User and Session Data -->
	<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

	<!-- CSS Style Includes -->
	<!-- CSS Style Includes -->
	<?php  echo $this->AssetCompress->css('core.css'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>
	<?php  echo $this->AssetCompress->css('ui.css'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>

	<link rel="stylesheet" type="text/css" href="js/mocha/themes/charcoal/css/Content.css" />
	<link rel="stylesheet" type="text/css" href="js/mocha/themes/charcoal/css/Core.css" />
	<link rel="stylesheet" type="text/css" href="js/mocha/themes/charcoal/css/Layout.css" />
	<link rel="stylesheet" type="text/css" href="js/mocha/themes/charcoal/css/Dock.css" />
	<link rel="stylesheet" type="text/css" href="js/mocha/themes/charcoal/css/Tabs.css" />
	<link rel="stylesheet" type="text/css" href="js/mocha/themes/charcoal/css/Window.css" />

	<?php
		/* AxBOS main generic styles */
		echo $html->script(array('mocha/scripts/mootools-1.2.4-core-yc',
							'mocha/scripts/mootools-1.2.4-more-yc',
							'mocha/scripts/mocha'
						)); 


		echo $html->script('mocha/scripts/ax-desktop');
	?>
	<!--[if IE]>
		<script type="text/javascript" src="/js/mocha/scripts/excanvas_r43.js"></script>
	<![endif]-->

	<style>	
	/* This CSS should be placed in a style sheet. It is only here in order to not conflict with the other demos. */

	#pageWrapper {
		background: #777;
	}

	.desktopIcon {
		margin: 15px 0 0 15px;
		cursor: pointer;	
	}	

	.dividerhead {
		color: #000000;
		background-color: #7089F0;
		font-style: italic;
		font-weight: bold;
		font-size: 110%;
	}

	.dividerhead a {
		color: #000000;
		background-color: #7089F0;
		font-style: italic;
		font-weight: bold;
		font-size: 110%;
	}

.dockText {
	color: #F0F0F0;
} 

.dockText .selected {
	color: yellow;
} 

	</style>


</head>
<body>

<div id="desktop">
	<div id="DivDesktopData" style="display: none; width: 0px; height: 0px;">
		<fieldset id="DesktopData">
			<input type="hidden" id="MonitorLeft" value="<?php echo $monitors['left'];?>" />
			<input type="hidden" id="MonitorCenter" value="<?php echo $monitors['center'];?>" />
			<input type="hidden" id="MonitorRight" value="<?php echo $monitors['right'];?>" />
		</fieldset>
	</div>
	<?php echo $content_for_layout; ?>

	<div id="pageWrapper">
		<div id="page" style="display: none;">
<?php	//		<img class="desktopIcon" src="images/icons/48x48/globe.png" alt="Art" width="48" height="48" onload="fixPNG(this)" /><br /> ?>
		</div>
	</div>


</div><!-- desktop end -->

<section id="sectionWebAppCode" class="hidden script">
<?php echo $this->Js->writeBuffer();?>
</section>

</body>
</html>
