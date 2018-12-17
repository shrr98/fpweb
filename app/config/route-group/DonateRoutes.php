<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class DonateRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'donate',
			]);

			$this->addGet(
				'/donate',
				[
					'action' => 'create',
				]
			);

			$this->addPost(
				'/donate',
				[
					'action' => 'store',
				]
			);
		}
	}