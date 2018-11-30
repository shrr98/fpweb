<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class SessionRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'session',
			]);

			$this->addGet(
				'/login',
				[
					'action' => 'create',
				]
			);

			$this->addPost(
				'/login',
				[
					'action' => 'store',
				]
			);

			$this->addGet(
				'/logout',
				[
					'action' => 'destroy',
				]
			);
		}
	}