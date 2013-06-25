<?php

App::import('Sanitize');

class AppController extends Controller {
	// class variables
	public $_Filter = array();

	// UI Theming properties
//	public $view = 'Theme';
//	public $theme = 'corn_flower_blue';

	// setup components
	public $components = array('RequestHandler',
//									'Acl',
							'Session',
  							'Auth',	
							'Axfile',
							'Axnotification',
		/*					'AxApiResponse',*/
							'Filter',
							'PaginationRecall',
							'Webservice.Webservice',
							'Gmail',
							'Upload',
							//'Gzip',
							//			'Autocomplete',
							);

	public $helpers = array(
/*		'AssetCompress.AssetCompress',*/
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
		'AxUI',
		'WebAlert',
		'TBS',
/*		'Embed',*/
/*		'CakeGrid.Grid',*/
		'Upload',
		'Youtube',

	);

	public $layout = 'plain';

	public $ok=true;
	
	public $apiResponse=array();
	
	// default datetime filter
	public $_Form_options_datetime = array();

	/**
	 * Before any Controller action
	 */
	
	function beforeFilter() {
		// Session and Authentication stuff.
		$this->Auth->loginAction = array('controller' => 'Users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'Desktop', 'action' => 'index');

		// Prepare the content for JSON requests
   		$this->RequestHandler->setContent('json', 'text/x-json');

		// Create a static User model accesible from everywhere
		App::import('Model', 'User');
		User::store($this->Auth->user());

		$querystring=''; 
		foreach($this->params['url'] as $key=>$value) {
			$querystring.='::'.$key.'='.$value;
		};
		
		// Fill a request's data array. Mainly to pass it to çs and views
		$this->set('request', array(
			'querystring' => $querystring,
			'client_ip' => $this->RequestHandler->getClientIP(),
			'client_referer' => $this->RequestHandler->getReferer(),
			'client_accepts' => $this->RequestHandler->accepts(),
			'isSSL' => $this->RequestHandler->isSSL(),
			'isAjax' => $this->RequestHandler->isAjax(),
			'isMobile' => $this->RequestHandler->isMobile(),
			'request_method' => ($this->RequestHandler->isGet()?'GET':($this->RequestHandler->isPost()?'POST':($this->RequestHandler->isDelete()?'DELETE':($this->RequestHandler->isPut()?'PUT':'')))),
			'_timestamp_request'=>date('Y-m-d H:i:s'),
			'_timestamp'=>date('Y-m-d H:i:s'),
		));

		// Initialize the apiResponse structure
		$this->apiResponse=array(
			'_id'=>99999,
			'_parentid'=>88888,
			'_timestamp_request'=>date('Y-m-d H:i:s'),
			'_timestamp'=>date('Y-m-d H:i:s'),
			'result'=>'ok',
			'messages'=>array(),
			'data'=>array(),
			);
		

		// Set the default page's title
		$this->pageTitle=$this->name;
/*
		if(isset($this->data[$this->Models[0]]['cve']) ) 
			$this->pageTitle=$this->name.'::'.$this->data[$this->Models[0]]['cve'];
		if(isset($this->data[$this->Models[0]]['arcveart']) ) 
			$this->pageTitle=$this->name.'::'.$this->data[$this->Models[0]]['arcveart'];
		if(isset($this->data[$this->Models[0]]['clcvecli']) ) 
			$this->pageTitle=$this->name.'::'.$this->data[$this->Models[0]]['clcvecli'];
		if(isset($this->data[$this->Models[0]]['prcvepro']) ) 
			$this->pageTitle=$this->name.'::'.$this->data[$this->Models[0]]['prcvepro'];
		if(isset($this->data[$this->Models[0]]['vecveven']) ) 
			$this->pageTitle=$this->name.'::'.$this->data[$this->Models[0]]['vecveven'];
*/
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
	
	function _autocompleteParseOptions($keyword='', $type=null) {

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
	public $layout = 'public';

}


// Intranet Base Class Categories 

// Controller class for Authenticated Users content
class MyAppController extends AppController {
	public $layout = 'plain';

}

// Controller class for List, Data Browsing, etc
class ListAppController extends AppController {
	public $layout = 'plain';

}

// Controller class for Master Catalogs (products, customers, providers... catalogs)
class MasterDetailAppController extends AppController {
	public $layout = 'default';
	public $paginate = array(	'update' => '#content',
								'evalScripts' => true,
								'limit' => PAGINATE_ROWS,
							);

	public function index() {
		// Get controller's main model's metadata
		$modelName=$this->uses[0];
		$model=$this->$modelName;
		$primaryKey=$model->primaryKey;
		$stField=$model->stField;
		$titleField=$model->title;

		$filter = $this->Filter->process($this);
		$this->set('items', $this->paginate($modelName, $filter));
	}

	public function cancel( $id=null ) {
		// Checking if this controller has a defined main model
		if (!isset($this->uses) || !is_array($this->uses) || !isset($this->uses[0])) {
			$this->set('result', 'error');
			$this->set('message', 'Configuración del controlador incorrecta');
			return;
		}

		// Validate the received item ID
		if (!$id || !$id>0) {
			$this->set('result', 'error');
			$this->set('message', __('invalid_item', true));
			return;
		}

		// Get controller's main model's metadata
		$modelName=$this->uses[0];
		$model=$this->$modelName;
		$primaryKey=$model->primaryKey;
		$stField=$model->stField;
		$titleField=$model->title;

		// Execute Model Operations
		$data=$model->findById($id, array($primaryKey, $stField, $titleField, 'created', 'modified'));
		if( $data && $data[$modelName][$primaryKey]>0 && $data[$modelName][$stField]=='A' ) {
			$title=$data[$modelName][$titleField];
			// Execute the cancelation
			if( $model->cancel($id) ) {
				$this->set('result', 'ok');
				$this->set('message', "Transacción Cancelada {$title}. (id: {$id})");
				$this->set('setFields', array( $stField => 'C' ) );
			}
			else {
				$this->set('result', 'error');
				$this->set('message', "Error al cancelar la transacción {$title}. (id: {$id})");
			}
		}
		else {
			$this->set('result', 'error');
			$this->set('message', "No se encontró el item o ya esta cancelado (id: {$id})");
		}
	}

	public function getRelated($id=null) {
		// Get controller's main model's metadata
		$modelName=$this->uses[0];
		$model=$this->$modelName;
		$primaryKey=$model->primaryKey;
		$stField=$model->stField;
		$titleField=$model->title;

		$this->set('result', 'ok');
		$this->set('currentCacheVersion', 1);		
		$this->set('related', $model->loadDependencies());
	}

}

// Controller class for Transactions (inventory i/o, orders, invoices ...) 
class TransactionAppController extends AppController {
	public $layout = 'default';

}

// Controller class used for reporting and exporting
class ReportAppController extends AppController {
	public $layout = 'report';

	public $components = array('RequestHandler',
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

	public $helpers = array(
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


/**
 * Convenience AppController that allows a controller to
 * automatically serve up a JSON version of the response
 * when it is requested via an Ajax call, such as in jQuery's
 * jQuery.ajax() method
 *
 * @package default
 */
abstract class AjaxController extends MasterDetailAppController {

/**
 * Override for the current HTTP-Status code
 *
 * For use when Controller::redirect() is not called and
 * the status code is the result of some request error
 *
 * @var string
 * @access protected
 */
	protected $_status = null;

/**
 * Special JSON-response short-circuit variable
 *
 * @var string
 * @access protected
 */
	protected $_disableAjax = false;

/**
 * Object constructor - Adds the RequestHandler and Session
 * components if necessary
 *
 * @return void
 */
	public function __construct() {
		if (!in_array('RequestHandler', $this->components)) {
			$this->components[] = 'RequestHandler';
		}

		if (!in_array('Session', $this->components)) {
			$this->components[] = 'Session';
		}

		parent::__construct();
	}

/**
 * Convenience method to short-circuit Ajax access to methods
 * and force a regular response from the controller
 *
 * @return void
 */
	protected function _disableAjax() {
		$args = func_get_args();
		if (is_array($args[0])) {
			$args = $args[0];
		}

		foreach ($args as $arg) {
			if ($arg == $this->action) {
				$this->_disableAjax = true;
				break;
			}
		}
	}

/**
 * Override the redirect method to call $this->_respond() in case
 * the response should be json
 *
 * Will terminate if the response should be json
 *
 * @param mixed $url A string or array-based URL pointing to another location within the app,
 *     or an absolute URL
 * @param integer $status Optional HTTP status code (eg: 404)
 * @param boolean $exit If true, exit() will be called after the redirect
 * @return mixed void if $exit = false. Terminates script if $exit = true
 * @access public
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->_respond(array(
			'redirect' => $url,
			'status' => $status,
		));

		parent::redirect($url, $status, $exit);
	}

/**
 * Called after the controller action is run to set the response to
 * json if necessary
 *
 * @access public
 * @link http://book.cakephp.org/view/984/Callbacks
 */
/*
	public function beforeRender() {
//		$this->_respond();
		return parent::beforeRender();
	}
*/
/**
 * Turns the current controller setup into a JSON response for use
 * in Ajax requests. If the current request should not be responded to
 * in JSON, then this short-circuits itself. Otherwise, it returns the
 * JSON response and stops processing
 *
 * @param mixed $options Override array for options
 * @return mixed false if not Ajax/JSON request, stops processing otherwise
 * @access protected
 */
	protected function _respond($options = array()) {
		$isAjax = !$this->_disableAjax
		          && $this->RequestHandler->isAjax()
		          && $this->RequestHandler->accepts('json');
		if (!$isAjax) {
			return false;
		}

		$message = $this->Session->read('Message.flash');
		if ($message) {
			$this->Session->delete('Message.flash');
		}

		$this->RequestHandler->respondAs('json');
		$this->RequestHandler->renderAs($this, 'json');
		$this->set($options);

		$options = array_merge(array(
			'referer'  => $this->referer(),
			'status'   => empty($this->_status)          ? 200 : $this->_status,
			'redirect' => null,
			'message'  => ($message)                     ? $message  : null,
			'content'  => null,
			'data'     => empty($this->data)             ? null      : $this->data,
			'errors'   => empty($this->validationErrors) ? null      : $this->validationErrors,
			'variables'=> empty($this->viewVars)         ? null      : $this->viewVars,
		), $options);

		if (is_array($options['redirect'])) {
			$options['redirect'] = Router::url($options['redirect'], true);
		}

		Configure::write('debug', 0);
		header('Content-type: application/json');
		echo json_encode($options);
		$this->_stop();
	}

}

/*

JSON RESPONSES FOR PAGINATION

public $paginate = array(
    'limit' => 25,
    'order' => array(
        'User.name' => 'asc'
    )
);

public function index() {
	$users = $this->paginate('User');
	if ($this->request->is('ajax')) return new CakeResponse(array('body' => json_encode($this->paginate())));
	$this->set('users', $users);
}

*/
