<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $uses = array('User');
	var $layout = 'authentication';
	
	function beforeFilter() {
		$this->Auth->autoRedirect = false;
//		parent::beforeFilter();
//		$this->Auth->loginRedirect = array('controller' => 'Desktop', 'action' => 'index');
		$this->pageTitle=$this->name;
		if (strtolower($this->action)<>'index') {
			$this->pageTitle.='::'.ucfirst(strtolower($this->action));
			$this->set( 'title_for_layout', $this->pageTitle);
		}

/*
		echo "<!--";
		echo "redir::".$this->Auth->redirect();
		echo "User::".$this->Auth->User('id');
		echo "-->";
*/
		$this->set('request', array(
			'client_ip' => $this->RequestHandler->getClientIP(),
			'client_referer' => $this->RequestHandler->getReferer(),
			'client_accepts' => $this->RequestHandler->accepts(),
			'isSSL' => $this->RequestHandler->isSSL(),
			'isAjax' => $this->RequestHandler->isAjax(),
			'isMobile' => $this->RequestHandler->isMobile(),
			'request_method' => ($this->RequestHandler->isGet()?'GET':($this->RequestHandler->isPost()?'POST':($this->RequestHandler->isDelete()?'DELETE':($this->RequestHandler->isPut()?'PUT':'')))),
			'user'=>array(
							'id' => $this->Auth->User('id'),
							'username' => $this->Auth->User('username'),
							'group_id' => $this->Auth->User('group_id'),
				)
			));
//		$this->Auth->loginRedirect='/Desktop';
/*
		if(isset($this->data) && isset($this->data['User']['username'])) {
			$this->data['User']['username']=strtoupper($this->data['User']['username']);
		}
*/
/*		
		$this->Auth->fields = array('username' => 'username',
									'password' => 'password'
									);
*/
		$this->Auth->allow('register','registercustomer');

	}

	function login() {
		if($this->Auth->User('id')>0) {
	//		$this->redirect('/Articulos');
		}
//		if (!$this->data) $this->layout='authentication'; /* First Request of the Login Form */
//		$this->Auth->loginError = "La confirmacion del password no coincide";
//			$this->redirect('/Desktop');

//		if($this->Auth->User('id')) {
//		}
	}
/*
	function login() {
//		Configure::write('debug',2); 
//		if($this->Auth->User('id')>0 ) {
//			$this->redirect('/Desktop');
//		}
		if($this->Auth->User()) {
//			die("AKA".$this->Auth->User('id'));
			if (isset($this->data['username'])) $this->Auth->login($this->data);
			$this->redirect('/Desktop');			
		}
		if (isset($this->data['username']) && !$this->Auth->User()) {
//			print_r($this->data);
//			die('nooo');
//			$this->redirect('/login');	
//			return;
		}
//		die('limpio');
	//	$this->redirect('/login');	
	}
*/
	function logout() {
		$this->Auth->logout();
		echo "usr::".$this->Auth->User('id');
	//	$this->redirect($this->Auth->logout());
		//$this->redirect('/users/login');
	}

/*	
	function logout() {
		$this->Auth->logout();
	}
*/
	
	function register() {
    	if ($this->data) {
        	if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
				// Set user's Group id: (executives:10) (employee:20) (seller:30) (customers:40) (providers:50)
            	$this->User->create();
            	if ($this->User->save($this->data)) {
					$this->Auth->login($this->data);
					$this->redirect('/Desktop');
				}
			}
			else {
				$this->Auth->loginError = "La confirmacion del password no coincide";
				$this->Session->setFlash(__('password_confirmation_error', true), 'auth');
			}
		}

		$groups = $this->User->Group->find('list', array('fields' => array('Group.id', 'Group.nom')));
		$this->set(compact('groups'));

	}

	function edit($id=null) {
			$this->layout='default';
			if (!$id && empty($this->data)) {
//				$this->Session->setFlash(__('invalid_item', true));
				$this->redirect(array('action' => 'register'));
			}

			/* Get the DataSource in order to start a Transaction */
	   		$dataSource = $this->User->getDataSource();
			$dataSource->begin($this->User);

			if (!empty($this->data)) {
	        	if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
	            	$this->User->create();
	            	if ($this->User->save($this->data)) {
						$dataSource->commit($this->User);
						$this->Auth->login($this->data);
						$this->redirect('/Desktop');
					}
				}
				else {
					$dataSource->rollback($this->User);
					$this->Auth->loginError = "La confirmacion del password no coincide";
					$this->data['User']['password']='';
					$this->data['User']['password_confirm']='';					
				}
			}

			if (empty($this->data)) {
				$this->data = $this->User->read(null, $id);
			}

			$groups = $this->User->Group->find('list', array('fields' => array('Group.id', 'Group.nom')));
			$this->set(compact('groups'));

	}

	function registeradmin() {
    	if ($this->data) {
        	if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
            	$this->User->create();
            	if ($this->User->save($this->data)) {
					$this->Auth->login($this->data);
					$this->redirect('/Desktop');
				}
			}
			else {
				$this->Auth->loginError = "La confirmacion del password no coincide";
			}
		}
	}

	function registercustomer() {
    	if ($this->data) {
        	if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
            	$this->User->create();
            	if ($this->User->save($this->data)) {
					$this->Auth->login($this->data);
					$this->redirect('/Desktop');
				}
			}
			else {
				$this->Auth->loginError = "La confirmacion del password no coincide";
			}
		}
	}


}
?>