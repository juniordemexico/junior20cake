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
	define('ICON_ACCOUNT', 'Account.png');
	define('ICON_INFO', 'Info.png');
	define('ICON_SUCCESS', 'Fevorite.png');
	define('ICON_ALERT', 'Info 2.png');
	define('ICON_WARNING', 'Info 2.png');
	define('ICON_ERROR', 'Winamp.png');
	define('ICON_CLOUD', 'Cloud.png');
	define('ICON_CHAT', 'Conversion Massanger.png');
	define('ICON_TASK', 'Task.png');
	define('ICON_MAIL', 'Mail.png');
	define('ICON_HELP', 'Help.png');
	define('ICON_CLOCK', 'Clock.png');
	define('ICON_CALENDAR', 'Calender.png');
	define('ICON_AWARD', 'Award.png');
	define('ICON_STICKY', 'Clip.png');
	define('ICON_BARCODE', 'Barcode.png');
	define('ICON_FILEUPLOAD', 'Upload.png');
	define('ICON_FILEDOWNLOAD', 'Download.png');
	//define('ICON_FOLDER', 'Folder.png');
	define('ICON_DOCUMENT', 'Document.png');
	define('ICON_DOCUMENTFILL', 'Document 2.png');
	define('ICON_FILE', 'Document-File.png');
	define('ICON_FILEFILL', 'Document-File 2.png');
	define('ICON_CONTACT', 'Contacts 2.png');
	define('ICON_CONTACTFILL', 'Contacts.png');
	define('ICON_MONEY', 'Currency- Dollar.png');
	define('ICON_FOLDER', 'Folder.png');
	//define('ICON_BROADCAST', 'Feed.png');
	define('ICON_DOWNLOAD', 'Download.png');
	define('ICON_BROADCAST', 'Feed.png');
	define('ICON_GEAR', 'Control Panel.png');
	define('ICON_GOOGLE', 'Google.png');
	define('ICON_SYNC', 'Sync.png');

	define('AX_TALLAS_MAX', 10);
	define('AX_AUTOCOMLPETE_ITEMS_LIMIT',16);

	// Load jQuery's AjaxMultiUpload plugin's bootstrap file
	require APP . 'config' . DS . 'ajaxmultiupload.bootstrap.php';

