<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;

use App\Forms\LoginForm;

class SessionController extends Controller
{
    public function createAction()
    {
        $this->view->form = new LoginForm();
    }

    public function storeAction()
    {
        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));

        $user = User::findFirst("username='$username'");

        if($user)
        {
        	if($password === $user->password)
        	{
        		$this->session->set(
        			'auth',
        			[
        				'id' => $user->id,
        				'username' => $user->username,
        			]
        		);

        		(new Response())->redirect()->send();
        	}
        }
    }

    public function destroyAction()
    {
     	$this->session->destroy();
     	$this->response->redirect();   
    }
}