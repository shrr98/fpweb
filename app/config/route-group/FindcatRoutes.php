<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class FindcatRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'findcat',
			]);

			$this->addGet(
				'/report',
				[
					'action' => 'create',
				]
			);

			$this->addPost(
				'/report',
				[
					'action' => 'store',
				]
			);
		}
	}