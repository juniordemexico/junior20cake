<?php

/**
 * CakePHP Debug Level:
 *
 * Production Mode:
 * 	0: No error messages, errors, or warnings shown. Flash messages redirect.
 *
 * Development Mode:
 * 	1: Errors and warnings shown, model caches refreshed, flash messages halted.
 * 	2: As in 1, but also with full debug messages and SQL output.
 *
 * In production mode, flash messages redirect after a time interval.
 * In development mode, you need to click the flash message to continue.
 */

	Configure::write('debug', 2);

/**
 * CakePHP Log Level:
 *
 * In case of Production Mode CakePHP gives you the possibility to continue logging errors.
 *
 * The following parameters can be used:
 *  Boolean: Set true/false to activate/deactivate logging
 *    Configure::write('log', true);
 *
 *  Integer: Use built-in PHP constants to set the error level (see error_reporting)
 *    Configure::write('log', E_ERROR | E_WARNING);
 *    Configure::write('log', E_ALL ^ E_NOTICE);
 */

	// Logging settings
	Configure::write('log', true);
	define('LOG_ERROR', 2);


	// Language, Locale and Encodings
	Configure::write('App.encoding', 'UTF-8');

	Configure::write('Config.language','es-mx'); // set the current language
	$monthNames = __c('mon',LC_TIME,true); // returns an array with the month names in French
	$dateFormat = __c('d_fmt',LC_TIME,true); // return the preferred dates format for France


	// Session settings
	Configure::write('Session.save', 'php');
	Configure::write('Session.cookie', 'AXBOS_PROD');
	Configure::write('Session.timeout', '180');
	Configure::write('Session.start', true);
	Configure::write('Session.checkAgent', true);


	// Security settings	
	Configure::write('Security.level', 'Medium');
	Configure::write('Security.salt', 'YhG93b3qyJfIxsf2guVoUubWwivnR2G0FgaC9mi');
	Configure::write('Security.cipherSeed', '6859309652353543996776683645');

	Configure::write('Acl.classname', 'DbAcl');
	Configure::write('Acl.database', 'default');

	Configure::write('requestStartTime', microtime(true));

	// Cache's configuration
	Configure::write('Cache.check', false);

	Cache::config('default', array(
									'engine' => 'apc',
									'duration'=> 3600, 		// 60 minutes
								));

	Cache::config('_cake_core_', array(
									'engine' => 'apc',
									'duration'=> 43200, 	// 12 hours
    							));

	Cache::config('tiny', array(
									'engine' => 'apc',
									'duration'=> 120,		// 2 minutes  (autocomplete, pagination, dependencies)
    							));

	Cache::config('short', array(
									'engine' => 'apc',
									'duration'=> 300,		// 5 minutes  (shell, batch, and big transactions)
    							));

	Cache::config('hourly', array(
									'engine' => 'apc',
									'duration'=> 3600,		// 60 minutes (transactions, monitors, mail, messaggin)
    							));

	Cache::config('daily', array(
									'engine' => 'apc',
									'duration'=> 86400,		// 1 day  (stadistics, master catalogs)
    							));

	Cache::config('forever', array(
									'engine' => 'apc',
									'duration'=> 2592000, 	// 30 days (global parameters, user parameters, views, site design elements, company own data )
    							));

	Cache::config('queries', array(
									'engine' => 'apc',
									'duration'=> 3600,		// 60 minutes
    							));

	Cache::config('publicfiles', array(
									'engine' => 'apc',
									'duration'=> 86400,		// 24 hours
    							));

	// Media Plugin Settings
//	require APP . 'plugins/media/config/core.php';
