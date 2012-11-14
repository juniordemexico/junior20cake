<!-- Request Data -->
<?php echo $this->element('requestdata', array('request'=>$request, 'session'=>$session)); ?>

<!-- Start Response Data -->
<?php echo $this->TBS->myflashes(); ?>

<?php echo $content_for_layout; ?>
						
<?php echo $this->Js->writeBuffer();?>
<!-- End Response Data -->

<!-- Debug Data Data -->
<?php if(Configure::Read('debug')>0) echo $this->element('debug'); ?>
