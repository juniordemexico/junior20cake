<?php
class UsersController extends MyAppController {

	public $name = 'Users';
	public $uses = array('User', 'Group');
	public $layout = 'authentication';
	
	function beforeFilter() {
// 		parent::beforeFilter();
		if (isset($this->data) && isset($this->data['User']['redirect'])) {
			$this->Auth->loginRedirect = $this->data['User']['redirect'];
		}
		else {
//			$this->_authredirect=$this->Auth->redirect();			
			$this->Auth->loginRedirect = $this->Auth->redirect();
		}
		
		$this->Auth->autoRedirect = false;
		$this->Auth->allow('login', 'logout', 'register', 'registercustomer', 'monitor');
		$this->pageTitle=$this->name;
		$this->set('request', array(
			'client_ip' => $this->RequestHandler->getClientIP(),
			'client_referer' => $this->RequestHandler->getReferer(),
			'client_accepts' => $this->RequestHandler->accepts(),
			'isSSL' => $this->RequestHandler->isSSL(),
			'isAjax' => $this->RequestHandler->isAjax(),
			'isMobile' => $this->RequestHandler->isMobile(),
			'request_method' => ($this->RequestHandler->isGet()?'GET':($this->RequestHandler->isPost()?'POST':($this->RequestHandler->isDelete()?'DELETE':($this->RequestHandler->isPut()?'PUT':'')))),
		));
	}

	function login() {
		$this->set('redirect', $this->Auth->loginRedirect);
		
		if($this->Auth->User('id')>0) {
			$this->User->read(null, $this->Auth->User('id'));
			if ($this->User->saveField('lastlogin',  date('Y-m-d H:i:s'))) {
				$this->redirect($this->Auth->redirect());
			}
			else {
				$this->Auth->loginError = "Error al Registrar la Sesion de Usuario";
				$this->Session->setFlash(__('Error al Registrar la Sesion de Usuario', true), 'auth');				
			}
		}	
	}
	
	function logout() {
		$this->Auth->logout();
	}

	
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
				$this->Session->setFlash(__('invalid_item', true));
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
		Configure::write('debug',0); 
//		if(!$this->data) $this->layout='authentication';
    	if ($this->data) {
        	if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
				$this->data['User']['usertype']='2';
				$this->data['User']['group_id']='2';
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
		Configure::write('debug',0); 
//		if(!$this->data) $this->layout='authentication';
    	if ($this->data) {
        	if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
				$this->data['User']['usertype']='2';
				$this->data['User']['group_id']='2';
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