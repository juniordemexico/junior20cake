<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php echo 	$html->charset().CR.
				$html->meta('icon').CR.
				$html->meta(array('name'=>'description', 'content' => $title_for_layout)).CR.
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
							'bootstrap/bootstrap.min',
							'bootstrap/bootstrap-responsive.min',
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
							'bootstrap/bootstrap.min',
							)
						);

		echo $html->script('axcore');
		
/*
		$this->html->scriptBlock("$('.log').ajaxStart(function() {
  $(this).text('Triggered ajaxStart handler.');
});",array('inline'=>false));
*/
		echo $scripts_for_layout;

	?>

	<script>
		$(document).ready( function(){
		if($('#busy-indicator')) {
			$('#busy-indicator').ajaxStart( function() {
				$(this).fadeIn(250);
			});
			$('#busy-indicator').ajaxStop( function() {
				$(this).fadeOut(500);
			});
		}
	});
	</script>
  <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.8.16.ie.css"/>
  <![endif]-->

</head>

<body>

<div class="container-fluid">	
	<div class="row-fluid">
		<div class="span12">

			<section id="mainSection">
				
			<div class="row-fluid" id="wrapper">

			<section id="DynamicContentSection">
				
			<div class="span12" id="content">

				<div class="row-fluid" id="formMessages">

<?php echo $this->TBS->flashes(); ?>

				</div> <!-- div formMessages -->

				<div class="row-fluid" id="formContent">

<?php echo $content_for_layout; ?>

				</div> <!-- formContent row -->

				<div class="row-fluid" id="formScripts">
						
<?php echo $this->Js->writeBuffer();?>

				</div> <!-- formScripts -->

<?php if(Configure::Read('debug')>0) echo $this->element('debug'); ?>
				
			</div> <!-- content -->
			</div> <!-- wrapper -->
			</section> <!-- MainSection -->

<!-- Global Page Footer -->
<?php echo $this->element('pagefooter');?>

		</div> <!-- Span12-->
	</div> <!-- Row-Fluid-->
</div> <!-- Container-->

</body>
</html>
