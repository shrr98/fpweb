<?php

use Phalcon\Config;

return new Config([

	'database' => [
	'adapter' => 'Phalcon\Db\Adapter\Pdo\Mysql',
	'host' => '127.0.0.1',
	'username' => 'root',
	'password' => '',
	'dbname' => 'its_catty_peri_1'
	],
	'url' => [
	'baseUrl' => 'http://localhost/fpweb2/'
	]
]);