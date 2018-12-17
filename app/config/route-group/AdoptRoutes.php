<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class AdoptRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'adopt',
			]);

			$this->addGet(
				'/adopt',
				[
					'action' => 'create',
				]
			);

			$this->addPost(
				'/adopt',
				[
					'action' => 'store',
				]
			);
		}
	}