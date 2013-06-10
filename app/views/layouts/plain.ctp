<!DOCTYPE html>
<html lang="en" data-ng-app="AxApp" id="top">
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
	<?php echo $this->element('includes_webui', array('request'=>$request, 'session'=>$session)); ?>

	<?php echo $scripts_for_layout; ?>

	<title><?php echo $title_for_layout; ?></title>

</head>

<body>

<div id="pageContainer" class="container ax-page-container">
	
	<section id="sectionMain">
	<div id="wrapper" class="row ng-cloak ax-page-wrapper" data-ng-controller="AxAppCtrl">
			<div class="span1"></div>
			<div id="content" class="span10 ax-page-content">

				<div id="formMessages" class="row ax-form-messages">
<?php echo $this->TBS->myflashes(); ?>
				</div> <!-- div#formMessages -->


				<div id="formContent" class="row ax-form-content" >

<?php echo $content_for_layout; ?>

				</div> <!-- div#formContent -->

				<div id="formScripts" class="row hide ax-app-script">
						
<?php echo $this->Js->writeBuffer();?>

				</div> <!-- div#formScripts -->

				<section id="sectionDebug">
<?php if(Configure::Read('debug')>0) echo $this->element('debug'); ?>
				</section> <!-- section#sectionDebug -->

			</div> <!-- div#content -->
	</div> <!-- div#wrapper  and  ngController#AxAppCtrl -->
	</section> <!-- section#sectionMain -->

	<!-- Global Page Footer -->
	<section id="sectionFooter">
	<?php echo $this->element('pagefooter');?>
	</section> <!-- section#sectionFooter -->

</div> <!-- div#pageContainer -->

</body>
</html>
