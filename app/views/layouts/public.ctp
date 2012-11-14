<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php echo 	$html->charset().CR.
				$html->meta('icon').CR.
				$html->meta(array('name'=>'description', 'content' => $title_for_layout)).CR.
				$html->meta(array('name'=>'keywords', 'content' => 'junior juniordemexico oggi jeans oggijeans axbos idd erp crm intranet '.$this->name)).CR.
				$html->meta(array('name'=>'viewport', 'content '=> 'width=device-width, initial-scale=1.0'));
	?>

	<!-- Request, User and Session Data -->
	<?php echo $this->element('public/requestdata', array('request'=>$request, 'session'=>$session)); ?>

	<title><?php echo $title_for_layout; ?></title>

	<?php
		/* jQuery themes and styles */
		echo $html->css(array(
							'jquery-ui/ui.jqgrid',
							'jquery-ui/custom-theme/jquery-ui-1.8.16.custom',
							'jquery-ui/ui.daterangepicker',
							'bootstrap/bootstrap',
							'bootstrap/bootstrap-responsive',
							)
						);

		/* AxBOS main generic styles */
		echo $html->css('ax.generic');

		/* AxBOS Public Site Styles */
		echo $html->css('ax.public');

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
							'jquery/jquery-ui/third-party/jQuery-UI-Date-Range-Picker/js/date',							
							'jquery/jquery-ui/third-party/jQuery-UI-Date-Range-Picker/js/daterangepicker.jQuery.compressed',							
							)
						);
						
		echo $html->script(array(
							'jquery/bootstrap/bootstrap.min',
							)
						);

		echo $html->script('axcore.public');
		
		echo $scripts_for_layout;

	?>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.8.16.ie.css"/>
<![endif]-->

</head>

<body>

<div class="container-fluid">	
	<div class="row-fluid">
		<div class="span12">

			<section id="MainSection">
			<div class="row-fluid" id="wrapper">
			<div class="span12" id="content">

				<div class="row-fluid" id="formMessagesContainer">
				<div class="span12" id="formMessages">

<?php echo $this->TBS->myflashes(); ?>

				</div> <!-- span formMessages -->
				</div> <!-- row formMessagesContainer -->

				<div class="row-fluid" id="formContent">

<?php echo $content_for_layout; ?>

				</div> <!-- formContent row -->

				<div class="row-fluid" id="formScriptsContainer">
				<div class="span12" id="formScripts">
						
<?php echo $this->Js->writeBuffer();?>

				</div> <!-- formScripts -->
				</div> <!-- formScriptsContainer -->

<?php if(Configure::Read('debug')>0) echo $this->element('debug'); ?>

			</div> <!-- content -->
			</div> <!-- wrapper -->
			</section> <!-- MainSection -->

<!-- Global Page Footer -->
<?php echo $this->element('public/pagefooter');?>

		</div> <!-- Span12-->
	</div> <!-- Row-Fluid-->
</div> <!-- Container-->

</body>
</html>
