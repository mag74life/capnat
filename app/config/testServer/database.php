<?php

// Configuration overrides for testing environment
// http://laravel.com/docs/configuration#environment-configuration

return array(

	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'capnat',
			'username'  => 'root',
			'password'  => $_ENV['DB_PASS'],
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

	),

);