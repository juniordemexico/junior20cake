<?php

App::import('Sanitize');

class AppController extends Controller {
	// class variables
	var $_Filter = array();

	// UI Theming properties
//	var $view = 'Theme';
//	var $theme = 'corn_flower_blue';

	// setup components
	var $components = array('RequestHandler',
//									'Acl',
							'Session',
  							'Auth',	
							'Axfile',
							'Axnotification',
							'Filter',
							'PaginationRecall',
							'Upload',
							//'Gzip',
							//			'Autocomplete',
							);

	var $helpers = array(
		'Js' => array('Jquery'),
		'Ajax',
		'Number',
		'Time',
		'Cache',
		'Html',
		'Javascript',
		'Form',
		'Session',
		'Paginator',
/*		'AssetCompress.AssetCompress',*/
		'TBS',
		'WebAlert',
/*		'Embed',*/
	/*	'CakeGrid',*/
		'Upload',
		'Youtube',
	);

	var $layout = 'plain';

	public $ok=true;
	
	// default datetime filter
	var $_Form_options_datetime = array();

	/**
	 * Before any Controller action
	 */
	
	function beforeFilter() {
		// Session and Authentication stuff.
		$this->Auth->loginAction = array('controller' => 'Users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'Desktop', 'action' => 'index');

		// Set the default page's title
		$this->pageTitle=$this->name;

		// Fill a request's data array. Mainly to pass it to models and views
		$this->set('request', array(
			'client_ip' => $this->RequestHandler->getClientIP(),
			'client_referer' => $this->RequestHandler->getReferer(),
			'client_accepts' => $this->RequestHandler->accepts(),
			'isSSL' => $this->RequestHandler->isSSL(),
			'isAjax' => $this->RequestHandler->isAjax(),
			'isMobile' => $this->RequestHandler->isMobile(),
			'request_method' => ($this->RequestHandler->isGet()?'GET':($this->RequestHandler->isPost()?'POST':($this->RequestHandler->isDelete()?'DELETE':($this->RequestHandler->isPut()?'PUT':'')))),
		));

		// Check for autocomplete parameters and sanitize them
/*
		if(stristr('autocomplete', $this->action)) {
			if( isset($this->params['url']['keyword']) ) {
				$this->params['url']['keyword'] = Sanitize::paranoid( $this->params['url']['keyword'], array('.', '_', '-', '/', ' '));
			}
			if( isset($this->params['named']['keyword']) ) {
				$this->params['named']['keyword'] = Sanitize::paranoid( $this->params['url']['keyword'], array('.', '_', '-', '/', ' '));
			}
			if( isset($this->data['keyword']) ) {
				$this->data['keyword'] = Sanitize::paranoid( $this->data['keyword'], array('.', '_', '-', '/', ' '));				
			}
		}
*/
	}

/*
	function beforeFilter() {
		// for index actions
		if($this->action == 'index') {
			// setup filter component
			$this->_Filter = $this->Filter->process($this);
			$url = $this->sFilter->url;
			if(empty($url)) {
				$url = '/';
			}
			$this->set('filter_options',array('url'=>array($url)));
			// setup default datetime filter option
			$this->_Form_options_datetime = array('type'=>'date','dateFormat'=>'DMY','empty'=>'-','minYear'=>date("Y")-2,'maxYear'=>date("Y"));
			// reset filters
			if(isset($this->data['reset']) || isset($this->data['cancel'])) {
				$this->redirect(array('action'=>'index'));
			}
		}
	}
*/
	/**
	 * Builds up a selected datetime for the form helper
	 * @param string $fieldname
	 * @return null|string
	 */
	function process_datetime($fieldname) {
		$selected = null;
		if(isset($this->params['named'][$fieldname])) {
			$exploded = explode('-',$this->params['named'][$fieldname]);
			if(!empty($exploded)) {
				$selected = '';
				foreach($exploded as $k=>$e) {
					if(empty($e)) {
						$selected .= (($k==0) ? '0000' : '00');
					} else {
						$selected .= $e;
					}
					if($k!=2) {$selected.='-';}
				}
			}
		}
	return $selected;
	}


	public function autocomplete($keyword='', $type=0) {
 		Configure::write ( 'debug', 0 );
  		$this->layout = 'json';
		$this->autoRender=false;
		$options=$this->_autocompleteParseOptions($keyword, $type);
	}
	
	function _autocompleteParseOptions($keyword='', $type=0) {

		$keyword=trim($keyword);

		// If keyword comes into a 'named' parameter, take it first.
		if(empty($keyword)) {
			if(isset($this->params['named']['keyword']) &&
				!empty($this->params['named']['keyword'])) {
				$keyword=trim($this->params['named']['keyword']);
			}
			// If keyword comes into a 'url' parameter (ie, in the GET's querystring), take it second.
			elseif(isset($this->params['url']['keyword']) &&
				!empty($this->params['url']['keyword'])) {
				$keyword=trim($this->params['url']['keyword']);			
			}
			else {
				return false; // The client didn't send any search term
			}
		}
		
		// Sanitize and truncate the Keyword in order to search
		$keyword=strtoupper(substr($keyword,0,32));
		if(empty($keyword)) {
			return false;
		}

		// Validate and Format the search keyword
		
		// Tipo de Articulo (0:producto, 1:material, 2:servicio, 3:varios, 4:activo)
		if(isset($this->params['named']['tipo'])) {
			$type=$this->params['named']['tipo'];
		}
		elseif(isset($this->params['url']['tipo'])) {
			$type=$this->params['url']['tipo'];
		}
		else {
			$type=0;
		}

		return array('keyword'=>$keyword, 'type'=>$type);		
	}

	/**
	 * Redirects to given $url, after turning off $this->autoRender.
	 * Script execution is halted after the redirect.
	 *
	 * @param mixed $url A string or array-based URL pointing to another location within the app,
	 *     or an absolute URL
	 * @param integer $status Optional HTTP status code (eg: 404)
	 * @param boolean $exit If true, exit() will be called after the redirect
	 * @return mixed void if $exit = false. Terminates script if $exit = true
	 * @access public
	 * @link http://book.cakephp.org/view/982/redirect
	 */

	public function redirect($url, $status = null, $exit = true) {
			$this->autoRender = false;

			if (is_array($status)) {
				extract($status, EXTR_OVERWRITE);
			}
	

			if ($url !== null) {
//				$this->header('Location: ' . Router::url($url, true));
				e(	'<script language="javascript">'.
					"window.location.href='".Router::url($url, true)."';".
					'</script>');
				exit;
			}

			$response = $this->Component->beforeRedirect($this, $url, $status, $exit);

			if ($response === false) {
				return;
			}
			if (is_array($response)) {
				foreach ($response as $resp) {
					if (is_array($resp) && isset($resp['url'])) {
						extract($resp, EXTR_OVERWRITE);
					} elseif ($resp !== null) {
						$url = $resp;
					}
				}
			}

			if (function_exists('session_write_close')) {
				session_write_close();
			}

			if (!empty($status)) {
				$codes = $this->httpCodes();

				if (is_string($status)) {
					$codes = array_flip($codes);
				}

				if (isset($codes[$status])) {
					$code = $msg = $codes[$status];
					if (is_numeric($status)) {
						$code = $status;
					}
					if (is_string($status)) {
						$msg = $status;
					}
					$status = "HTTP/1.1 {$code} {$msg}";

				} else {
					$status = null;
				}
				$this->header($status);
			}

			if ($url !== null) {
				$this->header('Location: ' . Router::url($url, true));
			}

			if (!empty($status) && ($status >= 300 && $status < 400)) {
				$this->header($status);
			}

			e(	'<script language="javascript">'.
				"window.location.href='".Router::url($url, true)."';".
				'</script>');

			if ($exit) {
				$this->_stop();
			}
		}


}
// Internet - Public Base Class Categories 

// Controller class for Public - World-wide open content
class MyPublicAppController extends AppController {
	var $layout = 'public';

}


// Intranet Base Class Categories 

// Controller class for Authenticated Users content
class MyAppController extends AppController {
	var $layout = 'plain';

}

// Controller class for List, Data Browsing, etc
class ListAppController extends AppController {
	var $layout = 'plain';

}

// Controller class for Master Catalogs (products, customers, providers... catalogs)
class MasterDetailAppController extends AppController {
	var $layout = 'default';

}

// Controller class for Transactions (inventory i/o, orders, invoices ...) 
class TransactionAppController extends AppController {
	var $layout = 'default';

}

// Controller class used for reporting and exporting
class ReportAppController extends AppController {
	var $layout = 'report';

	var $components = array('RequestHandler',
							'Session',
							'Auth',
//							'Gzip',
							'Filter',
							'PaginationRecall',
							'Gmail',
							'ImageTool',
							'Axfile',
							'Axreport',
							);

	var $helpers = array(
		'Js' => array('Jquery'),
		'Ajax',
		'Number',
		'Time',
		'Cache',
		'Session',
		'Html',
		'Javascript',
		'Form',
/*		'Embed',*/
	/*	'CakeGrid',*/
		'TBS',
	);

}
