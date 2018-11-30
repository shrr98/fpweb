<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class UserRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'user',
			]);

			$this->addGet(
				'/register',
				[
					'action' => 'create',
				]
			);

			$this->addPost(
				'/register',
				[
					'action' => 'store',
				]
			);
		}
	}