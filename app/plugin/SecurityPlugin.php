<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

class SecurityPlugin extends Plugin{
    public function getAcl()
	{
		if (!isset($this->persistent->acl)) {
            // Create the ACL
            $acl = new AclList();

            // The default action is DENY access
            $acl->setDefaultAction(
                Acl::DENY
            );

            // Register two roles, Users is registered users
            // and guests are users without a defined identity
            $roles = [
                'admin' => new Role('Admin'),
                'users'  => new Role('Users'),
                'guests' => new Role('Guests'),
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }


            ////////// URUNG DIEDIT //////////

            // Admin only area resources
            $adminResources = [
                'editcat'       => ['show', 'delete'],
                'findcat'       => ['edit', 'update'],
            ];

            foreach ($adminResources as $resourceName => $actions) {
                $acl->addResource(
                    new Resource($resourceName),
                    $actions
                );
            }

            // Private area resources (backend)
            $privateResources = [
                'profile'       => ['show', 'save_name', 'save_account', 'save_password', 'save_photo'],
                'care'          => ['create', 'store'],
            ];

            foreach ($privateResources as $resourceName => $actions) {
                $acl->addResource(
                    new Resource($resourceName),
                    $actions
                );
            }

            // Public area resources (frontend)
            $publicResources = [
                'home'      => ['index'],
                // 'care'      => ['create', 'store'],
                // 'findcat'   => ['create', 'store'],
                // 'index'     => ['show404'],
                // 'profile'   => ['show', 'edit'],
                // 'session'   => ['create', 'store'],
                // 'user'      => ['create', 'store'],
                // 'donate'       => ['create', 'store'],
            ];

            foreach ($publicResources as $resourceName => $actions) {
                $acl->addResource(
                    new Resource($resourceName),
                    $actions
                );
            }

            // Grant access to public areas to both users and guests
            foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}

            // Grant access to private area only to role Users
            //Grant access to private area to role Users
			foreach ($privateResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Users', $resource, $action);
				}
			}

            // Grant access to ADMIN area only to role Users
            //Grant access to private area to role Users
			foreach ($adminResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Admin', $resource, $action);
				}
			}

        //The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}
		return $this->persistent->acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the 'auth' variable exists in session to define the active role
        $auth = $this->session->get('auth');

        if (!$auth) {
            $role = 'Guests';
        } 
        else if ($auth['role'] === 0) {
            $role = 'Users';
        }
        else $role='Admin';

        $controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
        $acl = $this->getAcl();
        var_dump($acl); return; return;
		if (!$acl->isResource($controller)) {
			$dispatcher->forward([
				'controller' => 'home',
				'action'     => 'index'
			]);
			return false;
		}
		$allowed = $acl->isAllowed($role, $controller, $action);
		if (!$allowed) {
			$dispatcher->forward([
				'controller' => 'home',
				'action'     => 'index'
			]);
                        $this->session->destroy();
			return false;
		}
    }
}