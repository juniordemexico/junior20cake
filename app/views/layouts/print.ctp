<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Meta Tags, Charsets, Display/Device settings -->
	<?php echo $this->element('includes_meta', array('request'=>$request, 'session'=>$session, 'title_for_layout'=>$title_for_layout, 'metatags'=>array() )); ?>

	<!-- Request, User and Session Data -->
	<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

	<!-- CSS Style Includes -->
	<?php echo $html->css('ax.print', 'stylesheet', array('media'=>'all', 'inline'=>true));?>

	<!-- Action's Specific Scripts -->

	<?php echo $scripts_for_layout; ?>

	<title>IMPRESION::<?php echo $title_for_layout; ?></title>

</head>

<body onload="<?php if($printdialog) echo "window.print();"; ?>">

<?php echo $this->TBS->myflashes(); ?>

<div id="content">
<?php echo $content_for_layout; ?>
</div>						


<section id="sectionWebAppCode" class="hidden script">
<?php echo $this->Js->writeBuffer();?>
</section>

<?php if(Configure::Read('debug')>0) echo $this->element('debug'); ?>

</body>
</html>
