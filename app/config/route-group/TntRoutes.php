<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class TntRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'tnt',
			]);

			$this->addGet(
				'/tipsntrick',
				[
					'action' => 'create',
				]
			);

			$this->addPost(
				'/tipsntrick',
				[
					'action' => 'store',
				]
			);
		}
	}