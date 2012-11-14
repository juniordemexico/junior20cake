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
	Router::connect('/',
		array(
			'controller' => 'pages'
			,'action' => 'display'
			,'/index'
		)
	);

	Router::connect('/tests',
		array(
			'controller' => 'tests'
			,'action' => 'index'
		)
	);

	Router::connect('/customer',
		array(
			'controller' => 'customerportal'
			,'action' => 'index'
		)
	);


	Router::connect('/login',
		array(
			'controller' => 'users'
			,'action' => 'login'
		)
	);

	Router::connect('/logout',
		array(
			'controller' => 'users'
			,'action' => 'logout'
		)
	);


	Router::connect('/customer/facturaelectronica/*',
		array(
			'controller' => 'customerportal'
			,'action' => 'facturaelectronica'
		)
	);
