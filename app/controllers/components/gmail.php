<?php

App::import('Component', 'Email');

class GmailComponent extends EmailComponent	{
	
	function send() {	
		$this->smtpOptions = array(
			'port'=>'465', 
			'timeout'=>'30',
			'host' => 'ssl://smtp.gmail.com',
			'username'=>$this->from['email'],
			'password'=>$this->from['password']
		);
		
		$this->delivery = 'smtp';
		
		$this->to = $this->to['name'] . ' <' . $this->to['email'] . '>';
		$this->from = $this->from['name'] . ' <' . $this->from['email'] . '>';
		
		if(parent::send()) {
			return true;
		}
		
		$this->log($this->to);
		$this->log($this->from);
		$this->log($this->smtpError);
		$this->log($this->smtpOptions);
		
		return false;
	}

}
