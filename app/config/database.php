<?php

 /**
 * This is core configuration file.
 * Use it to configure core behaviour of Cake.
 * PHP versions 4 and 5
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice. 
 */
 /**
 * Database configuration class.
  * You can specify multiple configurations for production, development and testing.
  *
  * driver => The name of a supported driver; valid options are as follows:
  *		mysql 		- MySQL 4 & 5,
  *		mysqli 		- MySQL 4 & 5 Improved Interface (PHP5 only),
  *		sqlite		- SQLite (PHP5 only),
  *		postgres	- PostgreSQL 7 and higher,
  *		mssql		- Microsoft SQL Server 2000 and higher,
  *		db2			- IBM DB2, Cloudscape, and Apache Derby (http://php.net/ibm-db2)
  *		oracle		- Oracle 8 and higher
  *		firebird	- Firebird/Interbase
  *		sybase		- Sybase ASE
  *		adodb-[drivername]	- ADOdb interface wrapper (see below),
  *		pear-[drivername]	- PEAR::DB wrapper
  *
  * You can add custom database drivers (or override existing drivers) by adding the
  * appropriate file to app/models/datasources/dbo.  Drivers should be named 'dbo_x.php',
  * where 'x' is the name of the database.
  *
  * persistent => true / false
  * Determines whether or not the database should use a persistent connection
  *
  * connect =>
  * ADOdb set the connect to one of these
  *	(http://phplens.com/adodb/supported.databases.html) and
  *	append it '|p' for persistent connection. (mssql|p for example, or just mssql for not persistent)
  * For all other databases, this setting is deprecated.
  *
  * host =>
  * the host you connect to the database.  To add a socket or port number, use 'port' => #
  *
  * prefix =>
  * Uses the given prefix for all the tables in this database.  This setting can be overridden
  * on a per-table basis with the Model::$tablePrefix property.
  *
  * schema =>
  * For Postgres and DB2, specifies which schema you would like to use the tables in. Postgres defaults to
  * 'public', DB2 defaults to empty.
  *
  * encoding =>
  * For MySQL, MySQLi, Postgres and DB2, specifies the character encoding to use when connecting to the
  * database.  Defaults to 'UTF-8' for DB2.  Uses database default for all others.
  *
  */

class DATABASE_CONFIG {

	var $default = array(
		'driver' => 'firebird',
		'persistent' => true,
		'host' => '127.0.0.1',
		'port' => 3050,
		'login' => 'SYSDBA',
		'password' => 'larrykey',
		'database' => '/home/db/JUNIOR.FDB',
		'schema' => '',
		'prefix' => '',
		'encoding' => 'utf8'
	);

	public $default = array(
		'driver' => 'mongodb.mongodbSource',
		'database' => 'driver(DATABASE_NAME)',
		'host' => '127.0.0.1',
		'port' => 27017,
		/* optional auth fields
		'login' => 'mongo',	
		'password' => 'awesomeness',
		'replicaset' => array('host' => 'mongodb://hoge:hogehoge@localhost:27021,localhost:27022/blog', 
		                      'options' => array('replicaSet' => 'myRepl')
				     ),
		*/
	);  

/*
	var $default = array(
		'driver' => 'firebird',
		'persistent' => true,
		'host' => '201.122.130.220',
		'port' => '3050',
		'login' => 'SYSDBA',
		'password' => 'larrykey',
		'database' => '/home/db/JUNIOR.FDB',
		'schema' => '',
		'prefix' => '',
		'encoding' => 'utf8'
	);
*/
	var $test = array(
		'driver' => '',
		'persistent' => false,
		'host' => '',
		'port' => '',
		'login' => '',
		'password' => '',
		'database' => '',
		'schema' => '',
		'prefix' => '',
		'encoding' => ''
	);

    var $twitter = array( 
        'datasource' => 'twitter', 
        'username' => 'iddmex', 
        'password' => 'v3rnat0ma', 
		'consumer_key' => '2BWQxKBUlntTpxgjXhyQ',
		'consumer_secret' => 'a9LkBLFEbtCTDSWUiVboILbft5oxmE207dXPo6adetM'
    );  
/*
  var $json = array('datasource' => 'key_value',
                    'driver' => 'json_file',
                    'root' => TMP);

  var $memcache = array('datasource' => 'key_value',
                        'driver' => 'memcache',
                        'host' => 'localhost',
                        'port' => 11211);


	var $cakeftp = array(
		'datasource' => 'Ftp.FtpSource',
		'host' => 'example.com',
		'username' => 'testuser',
		'password' => '1234',
		'type' => 'ftp',
		'port' => 21,
	);


*/
}

