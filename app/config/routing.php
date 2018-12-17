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

		$router->mount(
			new FindcatRoutes()
		);

		$router->mount(
			new DonateRoutes()
		);

		$router->mount(
			new CareRoutes()
		);

		$router->mount(
			new AdoptRoutes()
		);

		$router->mount(
			new ProfileRoutes()
		);

		$router->mount(
			new TntRoutes()
		);

		$router->mount(
			new EditcatRoutes()
		);

		$router->addGet(
			'/',
			[
				'controller' => 'home',
				'action' => 'index'
			]
		);

		$router->addGet(
			'/about',
			[
				'controller' => 'about',
				'action' => 'index'
			]
		);

		$router->notFound([
			'controller' => 'error',
			'action' => 'show404',
		]);
		return $router;
	}
);