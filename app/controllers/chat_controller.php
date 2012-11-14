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

class ChatController extends AppController {
	var $name = 'Chat';
	var $uses=array('Chat');
	var $layout='ajax';

	function beforeFilter() {
		$this->Auth->allow('index','post','update');    
	}

	function update($key) {
		$this->helpers[] = 'ajaxChat';
		$this->set('messages', $this->Chat->find('latest', $key));
	}

	function post() {
		$this->helpers[] = 'ajaxChat';
		App::import('Sanitize');
		$this->data = Sanitize::clean($this->data);
		$this->data['Chat']['name'] = $this->Auth->User('username');
		$this->data['Chat']['ip_address'] = $_SERVER['REMOTE_ADDR'];
		$this->data['Chat']['user_id'] = $this->Auth->User('id');
		$this->Chat->save($this->data);
		die;
	}

	function index() {
		$this->helpers[] = 'ajaxChat';
		$this->layout = 'plain';
	}


	/*
	function update($key) {
		$this->set('messages', $this->Chat->find('latest', $key));
	}

	function post() {
		App::import('Sanitize');
		$this->data = Sanitize::clean($this->data);
		$this->data['Chat']['ip_address'] = $_SERVER['REMOTE_ADDR'];
		$this->data['Chat']['user_id'] = 1; // $this->Session(User.id);
		$this->Chat->save($this->data);
		die;
	}
	*/
}

?>