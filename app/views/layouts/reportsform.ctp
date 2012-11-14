<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php echo $html->charset(); ?>

	<title><?php echo $title_for_layout; ?></title>
	<!-- Requested: <?php echo date('Y/m/d H:i:s');?> -->
	<!-- Generated: <?php echo date('Y/m/d H:i:s');?> -->
	<!-- User: <?php echo $session->read('Auth.User.username');?> -->
	<!-- ClientIP: <?php //echo $client_ip; ?> -->
	<!-- ReReferer: <?php //echo $client_referer; ?> -->
	<!-- Method: <?php //echo $client_requesttype; ?> -->
	<!-- Method: <?php //echo $client_requesttype; ?> -->
	<!-- Request: <?php echo $this->params['url']; ?> -->

	<?php

		echo $html->meta('icon');
		echo $html->meta(array('name'=>'description', 'content'=>'Listado y Forma de Captura para el Módulo de '.$this->name));
		echo $html->meta(array('name'=>'keywords', 'content'=>'adminix axbos ax bos ax-bos lev neurobits idd ingenieriadedatos junior oggi erp crm admin admon intranet '.$this->name.'administrativa administracion juniordemexico oggi'));

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
/*							'jquery/jquery-ui/third-party/jQuery-UI-Date-Range-Picker/js/date',							
							'jquery/jquery-ui/third-party/jQuery-UI-Date-Range-Picker/js/daterangepicker.jQuery.compressed',							
*/
							)
						);
						
		echo $html->script('jquery/axbootstrap');

		echo $html->script(array(
							'jquery/bootstrap/bootstrap.min',
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
		if ($('#busy-indicator')) {
			$('#busy-indicator').ajaxStart( function() {
				$(this).show();
			});
			$('#busy-indicator').ajaxStop( function() {
				$(this).fadeOut(500);
			});
		}
		if ($('.dropdown-toggle')) {
			$('.dropdown-toggle').dropdown();
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

			<section id="MainSection">
			<?php echo $this->element('ToolBarReportsForm', array('MyController'=>$this->name));?>
			<div id="headerSpacer" class="row-fluid" style="height: 0px; margin: 32px 0px 32px 0px; padding: 0px;">
			</div> <!-- headerSpacer -->
				
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

				
			</div> <!-- content -->
			</div> <!-- wrapper -->
			</section> <!-- MainSection -->


			<section id="sectionFooters">
			<div id="footer" class="row-fluid">
				<div id="footer1" class="span6">
					<h6><?php echo $html->link(__('ax_company_common_name').' :: AxBOS :: '.__('ax_app_version'),'/'); ?></h6>
				</div>
				<div id="footer2" class="span6">
					<h6><?php echo "Ingenieria de Datos ©2012" ?></h6>
				</div>
			</div>
			</section> <!-- sectionFooters -->

<!-- ********** IDD: DEBUG INFORMATION ****************************** -->
<?php if(Configure::Read('debug')>0): ?>
			<div id="debug" class="row-fluid centered">
				<div id="debugsql" class="span12">
					<?php echo $this->element('sql_dump'); ?>
				</div>
			</div>
<?php endif;?>


		</div> <!-- Span12-->
	</div> <!-- Row-Fluid-->
</div> <!-- Container-->

</body>
</html>
