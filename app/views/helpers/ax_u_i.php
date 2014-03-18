<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

//App::uses('Helper', 'View');
//App::uses('AppHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AxUIHelper extends Helper {
//	public $uses=array('View/Helper');

	public $helpers = array('Html', 'Js', 'Time', 'Number', 'Cache', 'Session');
	
	private $_View;
	
	public function __construct( $settings=array() ) {
		$this->_View=ClassRegistry::getObject('view');
		parent::__construct( $settings );
	}
	
	/* Method getModelsAsJsObjects() returns a (string) containing the variables/models
	*  defined by the controller->set() method. And passed to the view's as plain JS variables
	*/
	public function getModelsAsJsObjects($options=null) {
		$view 		= $this->_View;

		$out='';
		// Check if encapsulateObject is set as True or String. 
		// In order to encapsulate all View's variables into just one object called _data by default
		if ($options && isset($options['encapsulateAsObject']) ) {
			$encapsulateObject=(is_string($options['encapsulateObject']) &&
								strlen($options['encapsulateObject'])>1) ?
								$options['encapsulateObject'] :
								'_data';
			$out.="var {$encapsulateObject}={}";
		}
		else {
			$encapsulateObject=false;
		}

		// Set Some Global Objects
		$out.='var appCache = window.applicationCache;'."\n\r";
		$out.="\n\r";

		// Iterate thru all View's variables (these variables are defined by the controller->set() method)
		foreach($view->getVars() as $thisVar) {
			$out.=$encapsulateObject ? "var {$encapsulateObject}.{$thisVar} = " : "var {$thisVar} = ";
			$out.=json_encode($view->getVar($thisVar)).';'."\n\r";
		}
		$out.="\n\r";
		return $out;
	}

	/* Method getModelsFromJsObjects() returns a (string)
	*  Takes every plain JS variable defined by the getModelsAsJsObjects() method,
	*  to create and initialize the WebUI framework's internal models (by value, not by reference).
	*/

	public function getModelsFromJsObjects($options=null) {
		$view 		= $this->_View;
		$out='';

		// Set Global Objects into the $scope
		$out.='$scope.appCache=appCache;'."\n\r";

		// Set Data Objects into the $scope
		foreach($view->getVars() as $oneModel) {
			$out.= '    $scope.'.$oneModel.' = angular.copy('.$oneModel.');'."\n\r"; 
		}
		$out.="\n\r";
		return $out;
	}

	/*
	*  Configure, initialize, instantiate and bootstrap the WebUI framework.
	*  Defining some global scope models containing internal App states, objects and methods
	*/
	public function initAppController($options=null) {
		$view 		= $this->_View;
		$session 	= $view->Session;
		$baseurl 	= $options && isset($options['baseurl']) ? 
					$options['baseurl'] :
					'/'.ucfirst($view->name);

		$localCachePrefix=$session->read('Auth.User.id').'.'.ucfirst($view->name).'.';
		$localCacheAppPrefix=$session->read('Auth.User.id').'.';

		$page=array(
			'url'			=> 'http://thehost:theport/Controller/action/params?query=string',
			'protocol'		=> 'http',
			'host'			=> '127.0.0.1',
			'port'			=> 80,
			'controller'	=> ucfirst($view->name),
			'action'		=> $view->action,
			'querystring'	=> null,
			'referer'		=> null,
			'back_to'		=> null,
			'forward_to'	=> null,
			'timestamp'		=> date('Y-m-d H:i:S'),
			'today'			=> date('Y-m-d'),
			'time'			=> date('H:i:S'),
			'valid'			=> date('Y-m-d H:i:S'),
			'allow'			=> date('Y-m-d H:i:S'),
			'clientIP'		=> '192.168.n.n',
			'stats'			=> array(	'requested'		=> date('Y-m-d H:i:s'),
										'responded'		=> date('Y-m-d H:i:s'),
										'elapsed'		=> '1.7456',
										'data_time'		=> '1.0050'
								),
			);

		$user=array(
				'id'			=> $session->read('Auth.User.id'),
				'username' 		=> $session->read('Auth.User.username'),
				'group_id'		=> $session->read('Auth.User.group_id'),
				'email'			=> $session->read('Auth.User.email'),
				'active'		=> $session->read('Auth.User.active'),
				'st'			=> $session->read('Auth.User.st'),
				'remoteaccess'	=> $session->read('Auth.User.remoteaccess'),
				'lastAccess'	=> $session->read('Auth.User.last_access'),
				'lastRequest'	=> $session->read('Auth.User.last_action'),
				'lastIP'		=> '127.7.7.7', //$session->read('Auth.User.last_ip'),
			);

		$actions=array(
			'index'				=> $baseurl.'/index',
			'add'				=> $baseurl.'/add.json',
			'save'				=> $baseurl.'/save.json',
			'edit'				=> $baseurl.'/edit',
			'view'				=> $baseurl.'/view',
			'preview'			=> $baseurl.'/preview',
			'cancel'			=> $baseurl.'/cancel/%s.json',
			'delete' 			=> $baseurl.'/delete.json',
			'authorize' 		=> $baseurl.'/authorize.json',
			'print'				=> $baseurl.'/print.json',
			'getItem'			=> $baseurl.'/getItem.json',
			'getItemByCve'		=> $baseurl.'/getItemByCve.json',
			'getRelated'		=> $baseurl.'/getRelated.json',
			'getAllAboutItem'	=> $baseurl.'/getAllAboutItem.json',
			'itemFullSearch'	=> $baseurl.'/itemFullSearch.json',
		);

		$state=array(
			'userInputBlocked'		=> false,
			'requestActive'			=> false,
			'spinShow'				=> false,
			'lastEvent'				=> null,
			'selectedItems'			=> array(),
			'lastAction'			=> null,
			'isDebugCollapsed'		=> false,
		);

		$onlineStatus=array('online'=>false, 'lastPageReload'=>null);
		
		$lastRequest=array(
			'url'		=> null,
			'action'	=> null,
			'timestamp' => null,
			'result'    => null,
			'message'   => array(),
			'do' 		=> array()
		);
		
		$estatus=array(
		"Activo"=> "A",
		"Baja"=> "B",
		"Cancelado"=> "C",
		"Suspendido"=> "S"
		);

		if($options) {
			if(isset($options['page']) && is_array($options['page'])) {
				$app=$options['page'];
			}

			if(isset($options['user']) && is_array($options['user'])) {
				$user=$options['user'];
			}

			if(isset($options['actions']) && is_array($options['actions'])) {
				$actions=$options['actions'];
			}

			if(isset($options['state']) && is_array($options['state'])) {
				$state=$options['state'];
			}

			if(isset($options['lastRequest']) && is_array($options['lastRequest'])) {
				$lastRequest=$options['lastRequest'];
			}

			if(isset($options['estatus']) && is_array($options['estatus'])) {
				$lastRequest=$options['estatus'];
			}

			if(isset($options['localCachePrefix']) && is_string($options['localCachePrefix'])) {
				$localCachePrefix=$options['localCachePrefix'];
			}

			if(isset($options['localCacheAppPrefix']) && is_string($options['localCacheAppPrefix'])) {
				$localCachePrefix=$options['localCacheAppPrefix'];
			}

		}
		
		return ( "\n\r".
"
var axApp=angular.module('AxApp', ['ui','ui.bootstrap','ngGrid','LocalStorageModule']).

controller('AxAppCtrl', 
['\$scope', '\$rootScope', '\$http', '\$window', '\$location', '\$dialog', '\$timeout', 'localStorageService', 'onlineStatus',
function(\$scope, \$rootScope, \$http, \$window, \$location, \$dialog, \$timeout, localStorageService, onlineStatus) {
".
"\n\r".
'/* Begins WebUI\'s global states and data ************************/'.
"
	\$scope.app=\n\r".
		json_encode(array(
			'name'					=> 'AxBOS::OGGI',
			'business_name'			=> 'Junior de México',
			'localCacheAppPrefix'	=> $localCacheAppPrefix,
			'localCachePrefix'		=> $localCachePrefix,
			'page'					=> $page,
			'user'					=> $user,
			'actions'				=> $actions,
			'state'					=> $state,
			'lastRequest'			=> $lastRequest,
			'estatus'				=> $estatus,
			'onlineStatus'			=> array(),
			'appCache'				=> array(),
			'allowEdit'				=> true,
			'allowEditFull'			=> true
		)).";".
"\n\r".
"
//	saveLocalGlobalCollection('APP', angular.toJson($scope.app));
//	saveLocalGlobalCollection('USER', angular.toJson($scope.app));

	\$http.defaults.headers.post[\"Content-Type\"] = 'application/x-www-form-urlencoded';
	\$scope.\$window=\$window;
	\$scope.app.onlineStatus=onlineStatus;
	\$scope.app.appCache=appCache;

/*
	\$window.addEventListener('selectedItems', function () {
		alert('cambio selected items' + \$scope.selectedItems.length-1);
		\$scope.currentItem=\$scope.selectedItems[\$scope.selectedItems.length-1];
		\$rootScope.\$digest();
	}, true);
*/


	// Internet/network connection status

/*
	if (typeof \$scope.items != 'undefined' && typeof \$scope.items[0].id != 'undefined') {
		\$scope.page.state.selectedItems=new Array(\$scope.items.length+1);
	}
*/
".
"\n\r"
	);
	}

	public function closeAppController($options=null) {
		return "\n\r"."}]);"."\n\r";
	}

	public function getAppGlobalMethods($options=null) {
		return "\n\r".
"
	\$scope.isDefined=function(item) {
		return angular.isDefined(item);
	};
	
	\$scope.serializeToServer = function ( data, masterModel, detailsModel ) {
		
		// Serialize Master
		var serializedData='_method=PUT&';
		angular.forEach(data.Master, function(value, key) {
			if( angular.isString(value) || angular.isNumber(value) ) {
				serializedData=serializedData.concat(encodeURIComponent('data[' + masterModel + ']' + '[' + key + ']') + '=' + encodeURIComponent(value) + '&');
			}
		} );

		// Serialize Details
		var serializedDetailData='';
		var i=0;
		angular.forEach(data.Details, function(value, key) {
			angular.forEach(value.Detail, function(value, key) {
				if( angular.isString(value) || angular.isNumber(value) ) {
					serializedDetailData=serializedDetailData.concat(encodeURIComponent('data[' + detailsModel + ']' +'[' + i + ']' + '[' + key + ']') + '=' + encodeURIComponent(value) + '&');
				}
			});
			i=i+1;			
		});
		return (serializedData+serializedDetailData);
	}

	\$scope.loadRelatedModels = function() {
		// Load page's related models from local cache or doing an http request
		var theRelated=false;
		
		if (typeof related != 'undefined') {
			\$scope.related=angular.copy(related);
			localStorageService.add(\$scope.app.localCachePrefix+'related', angular.toJson(related));
			\$scope.log('RELATED comes as plain JS!');
			return true;
		}
		else {
			if(	theRelated=localStorageService.get(\$scope.app.localCachePrefix+'related') &&
		 		theRelated!=null) {
				\$scope.related=angular.fromJson(localStorageService.get(\$scope.app.localCachePrefix+'related'));
				\$scope.log('RELATED not embeded. But found in localStorage!');
				return true;
			} 
			else {
				if ( \$scope.app.onlineStatus.isOnline() ) {
					\$scope.log('RELATED not found in plain JS or localStorage. I will request it to '+\$scope.app.actions.getRelated+' .');
					\$http.get(\$scope.app.actions.getRelated
					).then(function(response) {
					if(typeof response.data != 'undefined' && 
						typeof response.data.result != 'undefined' && response.data.result=='ok') {
						\$scope.related=angular.copy(response.data.related);
						localStorageService.add(\$scope.app.localCachePrefix+'related', angular.toJson(\$scope.related));
						\$scope.log('RELATED received and saved in localStorage');
						return true;
					}
					else {
						if(typeof response.data.result != 'undefined' && typeof response.data.message != 'undefined') {
							axAlert(response.data.message, 'error', false);
						}
						else {
							axAlert('Error Desconocido', 'error', false);
						}
					}
       				});
				}
				else {
					\$scope.log('RELATED no se encuentra incluido en la respuesta, ni en el cache y la Aplicación esta FUERA DE LINEA.');
				}
			}
		}
		\$scope.related={};
		return false;
	}

	\$scope.saveDetailsToCache = function() {
		localStorageService.add(\$scope.app.localCachePrefix+'detailsClipboard', angular.toJson(\$scope.data.Details));
			axAlert('Detalle guardado en cache local', 'warning', false);
	}

	\$scope.loadDetailsFromCache = function() {
		var details=false;
		if( details=localStorageService.get(\$scope.app.localCachePrefix+'detailsClipboard') ) {
			
			if( details != 'undefined' && angular.isString(details) ) {
				\$scope.data.Details=angular.fromJson(details);
				axAlert(\$scope.data.Details.length+' Items de Detalle cargados del cache', 'warning', false);
			}
			else {
				axAlert('El Detalle en el cache local esta vacio');				
			}
		}
		else {
			if(typeof \$scope.data.Details == 'undefined' || !\$scope.data.Details ) {
				\$scope.data.Details=[];
			}
			axAlert('El cache local no contiene Detalle');
		}
	}

/*
	\$scope.saveLocalGlobalCollection = function (collection, value) {
		localStorageService.add(collection, value);
		\$scope.log('Local Global Collection (ADDED: ' + collection);
		return true;
	}

	\$scope.loadLocalGlobalCollection = function (collection) {
		localStorageService.get(collection);
		if( !container ) {
			container={};
			container[collection]=[];
		}
		\$scope.log('Local Global Collection (LOADED: '+ container[collection].length +'): ' + collection);
		return true;
	}
*/

	\$scope.initLocalCollection = function (collection) {
		localStorageService.add(\$scope.app.localCachePrefix+collection, '[]');
		\$scope.log('Local Collection (INIT: ' + collection);
		return true;
	}

	\$scope.addItemToLocalCollection = function (collection, item) {
		var container=angular.fromJson(localStorageService.get(\$scope.app.localCachePrefix+collection));
		if( !container ) {
			container={};
			container[collection]=[];
		}
		container[collection].push( item );
		localStorageService.add(\$scope.app.localCachePrefix+collection, angular.toJson(container));
		if (collection!='LOG') {
			\$scope.log('Local Collection (ADDED: '+ container[collection].length +'): ' + angular.toJson(item));
		}
		return container[collection].length;
	}

	\$scope.loadLocalCollection = function (collection) {
		var container=angular.fromJson(localStorageService.get(\$scope.app.localCachePrefix+collection));
		if( !container ) {
			container={};
			container[collection]=[];
		}
		if (collection!='LOG') {
			\$scope.log('Local Collection (LOADED: '+ container[collection].length +'): ' + collection);
		}
		return angular.copy(container[collection]);
	}

	\$scope.addAndLoadToLocalCollection = function (collection, item) {
		\$scope.addItemToLocalCollection(collection, item);
		return \$scope.loadLocalCollection(collection);
	}

	\$scope.log = function(text) {
		var actualDateTime=new Date();
		console.log('AX: ('+actualDateTime.toISOString()+') ' + text);
		\$scope.addItemToLocalCollection('LOG', text);
	}
	
".
"\n\r";
	}

	public function getAppDefaults($options=null) {
		$out="
		
axApp.factory('onlineStatus', ['\$window', '\$rootScope', '\$dialog', function (\$window, \$rootScope, \$dialog) {

	// Initialize the main factory's object 'onlineStatus'
	var onlineStatus = {};

	onlineStatus.onLine = \$window.navigator.onLine;
	onlineStatus.lastPageLoad = new Date();
	onlineStatus.appCacheStatusText='';
	

	// Getter and Setter Methods
	onlineStatus.isOnline = function() {
		return onlineStatus.onLine;
	}

	onlineStatus.getClass = function() {
		return onlineStatus.onLine?'badge-warning' : '';
	}

	onlineStatus.asString = function() {
		return onlineStatus.onLine?'EN LINEA' : 'SIN CONEXIÓN';
	}

	onlineStatus.getAppCacheClass = function() {
		switch (appCache.status) {
			case appCache.UNCACHED:								// UNCACHED == 0
				return ''; break;
			case appCache.IDLE: 								// IDLE == 1
				return 'badge-info'; break;
			case appCache.CHECKING: 							// CHECKING == 2
				return 'badge-warning'; break;
			case appCache.DOWNLOADING:							// DOWNLOADING == 3
				return 'badge-warning'; break;
			case appCache.UPDATEREADY:							// UPDATEREADY == 4
				return 'badge-success'; break;
			case appCache.OBSOLETE:								// OBSOLETE == 5
				return 'badge-important'; break;
			default:
				return ''; break;
		}
		return onlineStatus.onLine?'badge-warning' : '';
	}

	onlineStatus.getAppCacheStatusText = function() {
		switch (appCache.status) {
			case appCache.UNCACHED:								// UNCACHED == 0
				return 'SIN CACHE'; break;
			case appCache.IDLE: 								// IDLE == 1
				return 'LISTO'; break;
			case appCache.CHECKING: 							// CHECKING == 2
				return 'REVISANDO'; break;
			case appCache.DOWNLOADING:							// DOWNLOADING == 3
				return 'DESCARGANDO'; break;
			case appCache.UPDATEREADY:							// UPDATEREADY == 4
				return 'HAY ACTUALIZACIÓN'; break;
			case appCache.OBSOLETE:								// OBSOLETE == 5
				return 'OBSOLETO'; break;
			default:
				return 'DESCONOCIDO'; break;
		}
	}


	// Event listeners for Users-Agent's Online Status Events
	
	\$window.addEventListener('online', function () {
		onlineStatus.onLine = true;
		onlineStatus.lastOnline = new Date();
		\$rootScope.\$digest();
	}, true);

	\$window.addEventListener('offline', function () {
		onlineStatus.onLine = false;
		onlineStatus.lastOffline = new Date();
		\$rootScope.\$digest();
	}, true);



	// Event listeners for Users-Agent's Application Cache Events
/*
	\$window.applicationCache.addEventListener('status', function (e) {
//		onlineStatus.appCacheStatusText=statusText();
		console.log('AX: detecte un cambio en el applicationCache (appCache)' + onlineStatus.getAppCacheStatusText() );
		\$rootScope.\$digest();
	}, true);
*/


	\$window.applicationCache.addEventListener('checking', function(e) {
		if (\$window.applicationCache.status == \$window.applicationCache.CHECKING) {
			console.log('AX: Revisando si hay Actualizaciones en el servidor (applicationCache.CHECKING)...');					
		}
	}, false);

	\$window.applicationCache.addEventListener('downloading', function(e) {
		if (\$window.applicationCache.status == \$window.applicationCache.DOWNLOADING) {
			console.log('AX: Descargando Actualización desde el servidor (applicationCache.DOWNLOADING)...');					
		}
	}, false);

	\$window.applicationCache.addEventListener('obsolete', function(e) {
		if (\$window.applicationCache.status == \$window.applicationCache.OBSOLETE) {
			console.log('AX: El Caché de la Aplicación es Obsoleto (applicationCache.OBSOLETE)...');					
		}
	}, false);

	\$window.applicationCache.addEventListener('noupdate', function(e) {
			console.log('AX:El Caché de la Aplicación esta Sincronizado (NOUPDATE)...');					
	}, false);

	\$window.applicationCache.addEventListener('updateready', function(e) {
	if (\$window.applicationCache.status == \$window.applicationCache.UPDATEREADY) {
		// Browser downloaded a new app cache.
		console.log('AX: Se encontró una nueva Actualización (applicationCache.UPDATEREADY). Notificando al usuario...');					
		if (confirm('Hay una nueva Actualización en el Servidor. ¿ Deseas SINCRONIZAR ahora ?')) {
			\$window.location.reload();
		}  

		} else {
			console.log('AX: Se buscarón nuevas actualizaciones en el servidor y no se encontró ninguna.');					
		}
	}, false);

	return onlineStatus;
}]);

axApp.value('ui.config', {
	jq: {
		datepicker: {
			dateFormat: 'yyyy-mm-dd',
			changeYear: true,
			changeMonth: true,
			yearRange: '-10:+2'
		},
	tooltip: {
		placement: 'top'
		}
	}
});

axApp.value('ui.config', {
	date: {
		dateFormat: 'yy-mm-dd',
		changeYear: true,
		changeMonth: true,
		yearRange: '-10:+2'
	}
});

";	
		return $out;
	}

	public function initAndCloseAppControllerLegacy( $options=null ) {
		return (
			$this->getModelsAsJsObjects().LF.CR.
			$this->initAppController().LF.CR.
			$this->getModelsFromJsObjects().LF.CR.
			$this->getAppGlobalMethods().LF.CR.
			$this->closeAppController().LF.CR.
			$this->getAppDefaults().LF.CR
		);
	}

	public function cleanSpecialChars($data) {
		$data = preg_replace('/[^a-zA-Z0-9_\ \'\[\]\(\)&-]/s', ' ', $data);
		$data = str_replace('&', '&amp;', $data);
		return $data;
	}

	public function replaceSpecialChars($data) {
		$data = str_replace('&', '&amp;', $data);
		return $data;
	}

/*
	public function cleanSpecialChars($data) {
		$data = preg_replace('/[^a-zA-Z0-9_\ \[\]\(\)&-]/s', ' ', $data);
		return $data;
	}
*/

}
