<!DOCTYPE html>
<!--[if IE 8]><html class="lt-ie10 ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="lt-ie10 ie9" lang="en"><![endif]-->
<!--[if gt IE 9]><!--><html lang="en"><!--<![endif]-->

<head>

	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php echo $this->element('includes_meta', array('request'=>$request, 'session'=>$session, 'title_for_layout'=>$title_for_layout, 'metatags'=>array() )); ?>

	<!-- Request, User and Session Data -->
	<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

	<!-- CSS Style Includes -->
	<?php echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>

	<!-- Javascript Includes -->
	<?php echo $this->element('includes_js', array('request'=>$request, 'session'=>$session)); ?>

	<!-- Action's Specific Scripts -->

	<?php echo $scripts_for_layout; ?>


	<title><?php echo $title_for_layout; ?></title>
</head>

<body>

<div class="container-fluid">	
	<div class="row">
		<div class="span12">

			<div class="row" id="wrapper">
			<div class="span12" id="content">

				<div class="row" id="formMessagesContainer">
				<div class="span12" id="formMessages">

<?php echo $this->TBS->myflashes(); ?>

				</div> <!-- span formMessages -->
				</div> <!-- row formMessagesContainer -->

				<div class="row" id="formContent">

<?php echo $content_for_layout; ?>

				</div> <!-- formContent row -->

				<div class="row" id="formScriptsContainer">
				<div class="span12" id="formScripts">
						
<?php echo $this->Js->writeBuffer();?>

				</div> <!-- formScripts -->
				</div> <!-- formScriptsContainer -->

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
