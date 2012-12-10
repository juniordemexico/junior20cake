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
	<?php  echo $this->AssetCompress->css('core.css'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>
	<?php  echo $this->AssetCompress->css('ui.css'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>

	<!-- JS Code and Data -->
	<?php  echo $this->AssetCompress->script('core.js'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>
	<?php  echo $this->AssetCompress->script('ui.js'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>
	<?php  echo $this->AssetCompress->script('ui-util.js'); //echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>

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
