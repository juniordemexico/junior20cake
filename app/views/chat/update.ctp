<ul class="chat-feed unstyled">
<?php
/*
 * CakePHP Ajax Chat Plugin (using jQuery);
 * Copyright (c) 2008 Matt Curry
 * www.PseudoCoder.com
 * http://github.com/mcurry/cakephp/tree/master/plugins/chat
 * http://sandbox2.pseudocoder.com/demo/chat
 *
 * @author      Matt Curry <matt@pseudocoder.com>
 * @license     MIT
 *
 */

	//flip the order
	if (isset($messages) && !empty($messages)) {
		foreach($messages as $i => $message) {
			$class = ($i % 2 == 0) ? 'odd':'even';
			printf('<li class="chat %s"><label class="label"><i class="icon icon-comment"></i>&nbsp;&nbsp;<strong>%s:</strong></label><p class="chat">%s</p><h6>%s</h6></li>',
             $class,
             $message['Chat']['name'],
             $message['Chat']['message'],
			 $time->timeAgoInWords($message['Chat']['created'])
		);
		}
	} else {
		echo '<li><label class="label">' . __('No Hay Mensajes', true) . '</label></li>';
	}
?>
<ul>
