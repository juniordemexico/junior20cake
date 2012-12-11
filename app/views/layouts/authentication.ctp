<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php echo $this->element('includes_meta', array('request'=>$request, 'session'=>$session, 'title_for_layout'=>$title_for_layout, 'metatags'=>array() )); ?>

	<!-- Request, User and Session Data -->
	<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

	<!-- CSS Style Includes -->
	<?php echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>

	<!-- JS Code and Data -->
	<?php echo $this->element('includes_js', array('request'=>$request, 'session'=>$session)); ?>

	<!-- Page's UI especific MVC code -->
	<?php  //echo $this->AssetCompress->script('webapp.js'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>

	<?php echo $scripts_for_layout; ?>


	<title><?php echo $title_for_layout; ?></title>

  <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.8.16.ie.css"/>
  <![endif]-->

</head>

<body>

<div class="container">	
	<div class="row">
		<div class="span12">

			<section id="mainSection">
				
			<div class="row" id="wrapper">

			<section id="DynamicContentSection">
				
			<div class="span12" id="content">

				<div class="row" id="formMessages">

<?php echo $this->TBS->flashes(); ?>

				</div> <!-- div formMessages -->

				<div class="row" id="formContent">

<?php echo $content_for_layout; ?>

				</div> <!-- formContent row -->

				<div class="row" id="formScripts">
						
<section id="sectionWebAppCode" class="hidden script">
<?php echo $this->Js->writeBuffer();?>
</section>

				</div> <!-- formScripts -->

<?php //if(Configure::Read('debug')>0) echo $this->element('debug'); ?>
				
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
