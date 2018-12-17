<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class EditcatRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'editcat',
			]);

			$this->addGet(
				'/editcat',
				[
					'action' => 'show',
				]
			);

			$this->addPost(
				'/editcat',
				[
					'action' => 'delete',
				]
			);

			$this->addGet(
				'/edit',
				[
					'action' => 'edit',
				]
			);

			$this->addPost(
				'/edit',
				[
					'action' => 'update',
				]
			);
		}
	}