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
						
<section id="sectionWebAppCode" class="hidden script">
<?php echo $this->Js->writeBuffer();?>
</section>

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
