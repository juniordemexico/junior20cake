<!-- Request Data -->
<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

				<div id="formMessages" class="row ax-form-messages">

<?php echo $this->TBS->myflashes(); ?>

				</div> <!-- div#formMessages -->


				<div id="formContent" class="row ax-form-content" >

<?php echo $content_for_layout; ?>

				</div> <!-- div#formContent -->

				<section id="sectionWebAppCode">
				<div id="formScripts" class="row hide ax-app-script">
						
<?php echo $this->Js->writeBuffer();?>

				</div> <!-- div#formScripts -->
				</section> <!-- section#sectionWebAppCode -->

				<section id="sectionDebug">
<?php if(Configure::Read('debug')>0) echo $this->element('debug'); ?>
				</section> <!-- section#sectionDebug -->
