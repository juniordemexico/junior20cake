<?php
/*
	echo $html->script('jujquery-1.6.2.min', false);
	echo $html->script('jquery-ui-1.8.14.custom.min', false);
	echo $html->script('jquery/jquery.fileUploader', false);
	echo $html->css('ui-lightness/jquery-ui-1.8.14.custom', null, array(), false);
	echo $html->css('fileUploader', null, array(), false);
*/

echo $html->css('jquery-ui/custom-theme/jquery-ui-1.8.16.custom', null, array(), false);
echo $html->css('jquery-ui/fileUploader', null, array(), false);

echo $html->script(array(
					'jquery/jquery.min',
					'jquery/jquery-ui.min',
					'jquery/jquery.fileUploader',
					)
				);
echo $html->script('jquery/bootstrap/bootstrap.min');


?>
 
<div class="galleries form">
	<h2>< ?php __('jQuery Fileuploder Plugin');?></h2>
	< ?php
		echo $this->Form->create('Gallery', array('type' => 'file'));
		echo $this->Form->input('file', array(
			'type' => 'file', 
			'label' => false, 'div' => false,
			'class' => 'fileUpload', 
			'multiple' => 'multiple'
			
		));		
		echo $this->Form->button('Upload', array('type' => 'submit', 'id' => 'px-submit'));
		echo $this->Form->button('Clear', array('type' => 'reset', 'id' => 'px-clear'));
		echo $form->end();
	?>
</div>
 
< script type="text/javascript">
	$(function(){
		$('.fileUpload').fileUploader();
	});
< /script>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
