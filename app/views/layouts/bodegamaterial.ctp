<!DOCTYPE html>
<html lang="en" ng-app>
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

	<style>	
	/* This CSS should be placed in a style sheet. It is only here in order to not conflict with the other demos. */
	.table-bodega {
		background: url('/img/wallpaper/warehouse_tarima_blue_trans.png') no-repeat;		
	}
	</style>
	
	<?php echo $scripts_for_layout; ?>

	<title><?php echo $title_for_layout; ?></title>

</head>

<body>

<div class="container">	
	<div class="row">
		<div class="span12">

			<?php echo $this->element('ToolBarBodegaMaterial', array('MyController'=>$this->name, 'listAction'=>(isset($listAction)?$listAction:'index'), 'MyModel'=>'Color'));?>

			<section id="MainSection">
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
<?php echo $this->element('pagefooter');?>

		</div> <!-- Span12-->
	</div> <!-- Row-Fluid-->
</div> <!-- Container-->

</body>
</html>
