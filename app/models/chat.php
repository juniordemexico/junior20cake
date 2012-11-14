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
 
class Chat extends AppModel {
	var $name = 'Chat';
	var $table = 'Chats';
	var $alias = 'Chat';
	
  var $validate = array(
                 );

  function find($type, $options = array()) {
    switch ($type) {
      case "latest":
        $options = array('conditions' => array('key' => $options),
                         'order' => array('Chat.created' => 'desc'),
                         'limit' => 10);
        return parent::find('all', $options);
      default:
        return parent::find($type, $options);
    }
  }
}
?>