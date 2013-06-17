<?php echo $this->Html->css('chat'); 		echo $html->script('jquery/chat.js');
?>
<?php echo $ajaxChat->generate('chat'); ?>

<script><?php echo $this->AxUI->initAndCloseAppControllerLegacy(); ?></script>
