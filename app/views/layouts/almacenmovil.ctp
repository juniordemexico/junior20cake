<!DOCTYPE html>
<html lang="en" ng-app>
<head>

	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php //echo $this->element('includes_meta', array('request'=>$request, 'session'=>$session, 'title_for_layout'=>$title_for_layout, 'metatags'=>array() )); ?>
	<?php
echo CR.
'<meta charset="utf-8">'.CR.
//	$this->Html->charset().CR.
	$this->Html->meta(array('name'=>'viewport', 'content '=> 'width=600, initial-scale=1.5')).CR.
'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,webkit=1,safari=1">'.CR.
	$this->Html->meta(array('name'=>'description', 'content' => $title_for_layout)).CR.
	$this->Html->meta(array('name'=>'keywords', 'content' => 'axbos idd erp intranet junior oggi bodega inventario '.$this->name)).CR.
	$this->Html->meta('icon').CR.
	CR;
?>
	<!-- Request, User and Session Data -->
	<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

	<!-- CSS Style Includes -->
	<?php echo $this->element('includes_css', array('request'=>$request, 'session'=>$session)); ?>

	<!-- JS Code and Data -->
	<?php echo $this->element('includes_js', array('request'=>$request, 'session'=>$session)); ?>

	<?php echo $scripts_for_layout; ?>


	<title><?php echo $title_for_layout; ?></title>
</head>

<body>

<div class="container tablet7">	
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
						
<section id="sectionWebAppCode" class="hide script">
	<?php echo $this->Js->writeBuffer();?>
</section>

				</div> <!-- formScripts -->
				</div> <!-- formScriptsContainer -->

<?php if(Configure::Read('debug')>0) echo $this->element('debug'); ?>

			</div> <!-- content -->
			</div> <!-- wrapper -->
			</section> <!-- MainSection -->

<!-- Global Page Footer -->

<section id="sectionFooters">
	<div id="footer" class="row centered">
		<div id="footer1" class="centered">
			<h6><?php echo __('ax_company_common_name').$html->link(' :: AxBOS :: '.__('ax_app_version'),'/'); ?></h6>
		</div>
	</div>
</section> <!-- sectionFooters -->

		</div> <!-- Span12-->
	</div> <!-- Row-Fluid-->
</div> <!-- Container-->

</body>
</html>
