<?php

// Configuration overrides for local environment
// http://laravel.com/docs/configuration#environment-configuration

return array(

	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'eagard.us.to',
			'database'  => 'capnat',
			'username'  => 'root',
			'password'  => $_ENV['DB_PASS'],
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

	),

);