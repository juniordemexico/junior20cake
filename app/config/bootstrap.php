<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
//require_once('controllers/master_detail_app_controller.php');
//	App::import('MasterDetailAppController');
	define('ARC_SEP','|');
	define('LF',"\n");
	define('CR',"\r");
	define('CRLF',"\r\n");
	define('WCR',"<br/>");
	define('SP', chr(32));
	define('ESC',chr(27));
	define('WSP',"&nbsp;");
	define('PAGINATE_ROWS', 15);
	define('PAGE_ROWS', 15);
	define('PAGE_LARGE_ROWS', 50);
	define('AUTOCOMPLETE_MAX_ROWS', 64);
	define('ICON_OK', '<i class="icon icon-ok"></i>');
	define('ICON_ADD', '<i class="icon icon-plus-sign"></i>');
	define('ICON_MINUS', '<i class="icon icon-minus-sign"></i>');
	define('ICON_REFRESH', '<i class="icon icon-refresh"></i>');
	define('ICON_LIST', '<i class="icon icon-list"></i>');
	define('ICON_TRASH', '<i class="icon icon-trash"></i>');
	define('ICON_FLAG', '<i class="icon icon-flag"></i>');
	define('ICON_SEARCH', '<i class="icon icon-search"></i>');

	define('AX_TALLAS_MAX', 10);
	define('AX_AUTOCOMLPETE_ITEMS_LIMIT',16);

//	require APP . 'plugins' . DS . 'ajax_multi_upload' . DS . 'config' . DS . 'bootstrap.php';
	require APP . 'config' . DS . 'ajaxmultiupload.bootstrap.php';

//CakePlugin::load('AjaxMultiUpload', array('bootstrap' => true, 'routes' => true));

/* Media Plugin */
/*
require APP . 'plugins' . DS . 'media' . DS . 'config' . DS . 'core.php';
//images sizes
$small = array('fitCrop' => array(320, 240));
$medium = array('fitCrop' => array(1280, 768));
$large = array('fitCrop' => array(1440, 1080));
 
Configure::write('Media.filter', array(
	'audio' =>  array(),
	'document' =>  array(),
	'generic' => array(),
	'image' => compact('small', 'medium', 'large'),
	'video' => compact('small', 'medium')
));
*/