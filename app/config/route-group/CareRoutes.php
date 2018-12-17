<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class CareRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'care',
			]);

			$this->addGet(
				'/care',
				[
					'action' => 'create',
				]
			);

			$this->addPost(
				'/care',
				[
					'action' => 'store',
				]
			);
		}
	}