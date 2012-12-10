<!DOCTYPE html>

<html lang="en" manifest="/cache.manifest">
<head>
	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php echo 	$html->charset().CR.
				$html->meta('icon').CR.
				$html->meta(array('name'=>'description', 'content' => $title_for_layout)).CR
				$html->meta(array('name'=>'keywords', 'content' => 'axbos idd erp intranet junior oggi '.$this->name)).CR.
				$html->meta(array('name'=>'viewport', 'content '=> 'width=device-width, initial-scale=1.0'));
	?>

	<!-- Request, User and Session Data -->
	<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

	<title><?php echo $title_for_layout; ?></title>

	<?php
		/* jQuery themes and styles */
		echo $html->css(array(
							'jquery-ui/ui.jqgrid',
							'jquery-ui/custom-theme/jquery-ui-1.8.16.custom',
							'jquery-ui/jQuery-UI-FileInput/enhaced',
							'jquery-ui/ui.daterangepicker',
							'bootstrap/bootstrap',
							'bootstrap/bootstrap-responsive',
							)
						);

		/* AxBOS main generic styles */
		echo $html->css('ax.generic');

		/* (idd) Javascript and Ajax Libraries and Frameworks */
		echo $html->script(array(
							'jquery/jquery.min',
							'jquery/jquery-ui.min',
							)
						);  // Serve jQuery from this Google url--> https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js


		echo $html->script(array(
							'jquery/grid.locale-es',
							'jquery/jquery.jqGrid.min',
							'jquery/jquery.maskedinput-1.3.min.js',
							)
						);
						
		echo $html->script(array(
							'jquery/jquery-ui/third-party/jQuery-UI-FileInput/js/enhance.min',
							'jquery/jquery-ui/third-party/jQuery-UI-FileInput/js/fileinput.jquery',
							'jquery/jquery-ui/third-party/jQuery-UI-Date-Range-Picker/js/date',							
							'jquery/jquery-ui/third-party/jQuery-UI-Date-Range-Picker/js/daterangepicker.jQuery.compressed',							
							)
						);

		echo $html->script(array(
							'jquery/bootstrap/bootstrap.min',
							'jquery/bootstrap/bootstrap-popover',
							'jquery/bootstrap/bootstrap-alert',
							'jquery/bootstrap/bootstrap-button',
							'jquery/bootstrap/bootstrap-modal',
							'jquery/bootstrap/bootstrap-collapse',
							'jquery/bootstrap/bootstrap-dropdown',
							'jquery/bootstrap/bootstrap-carousel',
							'jquery/bootstrap/bootstrap-typeahead'
							)
						);

		echo $html->script('axcore');
		
		/* Output the javascripts intentded to be executed at document load */
		echo $scripts_for_layout;
	?>
  <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.8.16.ie.css"/>
  <![endif]-->

</head>

<body>

<section id="sectionHeaders">
<div id="header">
</div>
<div id="headerfill">
</div>
<br/>
<br/>
<br/>
</section>

<section id="sectionContent">
<div id="wrapper">
<!---------- CONTENT: BEGINS THE DYNAMIC FORM'S CONTENT -------------------------------- -->
		<div id="content">
			<?php echo $content_for_layout; ?>
		</div>
<!---------- CONTENT: END THE DYNAMIC FORM'S CONTENT ----------------------------------- -->
</div>
</section>

<section id="sectionScripts">
<?php echo $this->Js->writeBuffer();?>
</section>

<section id="sectionFooters">
<footer>
<div id="footer">
	<li><?php echo $html->link(__('ax_company_common_name').' :: AxBOS :: '.__('ax_app_version'),'/'); ?></li>
</div>
</footer>

<footer>
<!--------- IDD: DEBUG INFORMATION ------------------------------ -->
<?php if(Configure:: Read('Debug')>0): ?>
<div id="iddDebug">
	<?php echo $this->element('sql_dump'); ?>
</div>
<?php endif;?>
</footer>

</section>

</body>
</html>
