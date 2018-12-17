<?php

use Phalcon\Flash\Direct as Flash;

use Phalcon\Events\Manager as EventsManager;
use Phalcon\Events\Event as Event;
use Phalcon\Mvc\Dispatcher\Exception as Exception;

use Phalcon\Mvc\Model\Manager as ModelsManager;

use Phalcon\Http\Response\Cookies;

$di->set(
	'voltService',
	function ($view, $di) {
	$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

	$volt->setOptions([
		"compiledPath" => APP_PATH . "/cache/",
		"compiledExtension" => ".compiled",
		"compileAlways" => true,
	]);

	return $volt;
	}
);

$di->set(
	'view',
	function () {
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir(APP_PATH . "/views");
	// echo APP_PATH."\\views";

	$view->registerEngines([
		".volt" => "voltService",
	]);

	return $view;

	}
);

$di->set(
	'db',
	function () use ($config) {
		$dbAdapter = $config->database->adapter;
		return new $dbAdapter([
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->dbname
		]);
	}
);


$di->set(
    "modelsManager",
    function() {
        return new ModelsManager();
    }
);


$di->set(
	'url',
	function () use ($config, $di) {
		$url = new \Phalcon\Mvc\Url();

		$url->setBaseUri($config->path('url.baseUrl'));

		return $url;
		
	}
);

$di->set(
	'session',
	function() {
		$session = new Phalcon\Session\Adapter\Files();

		$session->start();

		return $session;
	}
);

/**
 * Flash service with custom CSS classes
 */
$di->set('flash', function () {
    return new Flash([
		'errorf' => 'alert_danger',
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

$di->set(
	'eventManager', function() {
		$eventsManager = new EventsManager();

		$eventsManager->attach(
			"dispatch:beforeException",
			function($event, $dispatcher, $exception)
			{
				if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception){
					switch ($exception->getCode()) {
						case PhDispatcher::EXCEPTION_HANDLER_NOT_FOUND:
						case PhDispatcher::EXCEPTION_ACTION_NOT_FOUND:
						$dispatcher->forward(
							array(
								'controller' => 'error',
								'action'     => 'show404',
							)
						);
						break;
						
						default:
                        $dispatcher->forward(
							array(
								'controller' => 'error',
								'action'     => 'show500',
							)
						);
						break;
					}
					
				}
				else{
					$dispatcher->forward(
						array(
							'controller' => 'error',
							'action'     => 'show500',
						)
					);
					
				}
			}
		);

		$dispatcher = new PhDispatcher();
    	$dispatcher->setEventsManager($eventsManager);
    	return $dispatcher;
	}
);

$di->set( 
	"cookies", function () { 
	   $cookies = new Cookies();  
	   $cookies->useEncryption(false);
	   return $cookies; 
	} 
 ); 
 