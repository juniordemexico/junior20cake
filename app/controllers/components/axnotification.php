<?php

class AxnotificationComponent extends Component
{


	function startup( &$controller ) {
		$this->controller =& $controller;
	}


	function sendNotification($options=array(), $content='') {
//    	$user = $this->User->find(array('User.id' => $user_id), array('User.id','User.email', 'User.username'), null, false);
//		if ($user === false) {
//			debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
//			return false;
//		}

		// Set data for the "view" of the Email
		if(!isset($options['from']) || empty($options['from'])) {
			$options['from']='idd.mex@gmail.com';
		}
		if(!isset($options['transaction_timestamp']) || empty($options['transaction_timestamp'])) {
			$options['transaction_timestamp']=date('Y-m-d H:i:s');
		}
		if(!isset($options['related_url'])) {
			$options['related_url']=date('Y-m-d H:i:s');
		}
		if(!isset($options['subject']) || empty($options['subject'])) {
			$options['subject']='Controlador: '.$this->name.' Accion:'.$this->action.' Id:'.(isset($options['id'])?$options['id']:'');
		}
		if(!isset($options['to']) || empty($options['to'])) {
			$options['to']='neurobits@gmail.com';
		}


		$this->set('username', $this->Auth->User('username'));
		$this->set('content', $content);
		$this->set('options', $options);

		$this->Email->to = $options['to']; //$user['User']['email'];
		$this->Email->subject = env('SERVER_NAME') . $options['subject'];
		$this->Email->from = $options['from'];
		$this->Email->template = 'notification';
        $this->Email->delivery = 'smtp';
		$this->Email->smtpOptions = array(
				'port'=>'465',
				'timeout'=>'30',
				'host' => 'ssl://smtp.gmail.com',
				'username'=>'idd.mex@gmail.com',
            	'password'=>'v3rnat0ma',
              );
		$this->Email->sendAs = 'text';   // you probably want to use both :)
		return $this->Email->send();
   }


	function __sendActivationEmail($user_id, $options) {
    	$user = $this->User->find(array('User.id' => $user_id), array('User.id','User.email', 'User.username'), null, false);
		if (!$user) {
			debug(__METHOD__." failed to retrieve User data for user.id: {$user_id}");
			return false;
		}

		// Set data for the "view" of the Email

		$this->set('related_url', isset($options['url'])?$options['url']:'');
		$this->set('username', $this->controller->Auth->User('username'));

		$this->Email->to = 'neurobits@gmail.com'; //$user['User']['email'];
		$this->Email->subject = env('SERVER_NAME') . 'AxBOS::Notificacion:: '.$options['subject'];
		$this->Email->from = 'idd.mex@gmail.com';
		$this->Email->template = 'notification';
        $this->Email->delivery = 'smtp';
		$this->Email->smtpOptions = array(
				'port'=>'465',
				'timeout'=>'30',
				'host' => 'ssl://smtp.gmail.com',
				'username'=>'idd.mex@gmail.com',
            	'password'=>'v3rnat0ma',
              );
		$this->Email->sendAs = 'text';   // you probably want to use both :)
		return $this->Email->send();
   }

}
