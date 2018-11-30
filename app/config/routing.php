<?php

$di->set(
	'router',
	function(){
		$router = new \Phalcon\Mvc\Router(false);
		$router->mount(
			new UserRoutes()
		);
		
		$router->mount(
			new SessionRoutes()
		);

		$router->addGet(
			'/',
			[
				'controller' => 'todo',
				'action' => 'index'
			]
		);

		$router->notFound([
			'controller' => 'index',
			'action' => 'show404',
			'params' => "Maaf, URL tidak ada"
		]);
		return $router;
	}
);