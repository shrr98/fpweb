<?php

$loader = new \Phalcon\Loader();

$loader->registerDirs(
	[
		APP_PATH . '/controllers/',
		APP_PATH . '/models/',
		APP_PATH . '/config/route-group/',
		APP_PATH . '/plugin/',

	]
);

$loader->registerNamespaces(
	[
		'App\Forms' => APP_PATH ."/form/"
	]
	);
$loader->register();