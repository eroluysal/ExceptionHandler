<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Default Authentication Driver
	|--------------------------------------------------------------------------
	|
	| This option controls the authentication driver that will be utilized.
	| This driver manages the retrieval and authentication of the users
	| attempting to get access to protected areas of your application.
	|
	| Supported: "log", "bugsnag", "sentry"
	|
	*/

	'driver' => 'log',

	/*
	|--------------------------------------------------------------------------
	| Exception Connections
	|--------------------------------------------------------------------------
	|
	| Here you may configure the connection information for each server that
	| is used by your application. A default configuration has been added
	| for each back-end shipped with Laravel. You are free to add more.
	|
	*/

	'connections' => [

		'bugsnag' => [
			'key' => ''
		],

		'sentry' => [
			'project' => '',
			'public'  => '',
			'secret'  => '',
		]

	]

];
