<?php

	use Phalcon\Mvc\Router\Group as RouterGroup;

	class ProfileRoutes extends RouterGroup
	{
		public function initialize()
		{
			$this->setPaths([
				'controller' => 'profile',
			]);

			$this->addGet(
				'/profile',
				[
					'action' => 'show',
				]
			);

			$this->addPost(
				'/profile',
				[
					'action' => 'show',
				]
			);

			$this->addGet(
				'/save_name',
				[
					'action' => 'save_name',
				]
			);

			$this->addGet(
				'/save_account',
				[
					'action' => 'save_account',
				]
			);

			$this->addGet(
				'/save_password',
				[
					'action' => 'save_password',
				]
			);

			$this->addGet(
				'/save_photo',
				[
					'action' => 'save_photo',
				]
			);

			$this->addPost(
				'/save_name',
				[
					'action' => 'save_name',
				]
			);

			$this->addPost(
				'/save_account',
				[
					'action' => 'save_account',
				]
			);

			$this->addPost(
				'/save_password',
				[
					'action' => 'save_password',
				]
			);

			$this->addPost(
				'/save_photo',
				[
					'action' => 'save_photo',
				]
			);

			$this->addGet(
				'/see',
				[
					'action' => 'see',
				]
			);
		}
	}