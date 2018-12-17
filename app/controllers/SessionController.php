<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;

use App\Forms\LoginForm;


class SessionController extends Controller
{
    private $message = "";

    public function createAction()
    {
        if($this->session->has('auth'))
            $this->response->redirect('profile');

        $form = new LoginForm();
    
        // Check if the cookie has previously set
        if ($this->cookies->has('remember-username') && $this->cookies->has('remember-password')) {
            // Get the cookie's values
            $username = $this->cookies->get('remember-username')->getValue();
            $password = $this->cookies->get('remember-password')->getValue();
            
            // set value of form
            $attr = $form->get('username')->getAttributes();
            $attr['value'] = $username;
            $form->get('username')->setAttributes($attr);

            $attr = $form->get('password')->getAttributes();
            $attr['value'] = $password;
            $form->get('password')->setAttributes($attr);
        }
////////////////////////////////////////////////////////////////
        
        $this->view->message=$this->message;
        $this->view->form = $form;
    }

    public function storeAction()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $remember = $this->request->getPost('remember');

        $user = Users::findFirst("username='$username'");

        if($user)
        {
            if($this->security->checkHash($password, $user->password))
            //if($this->security->check($password, $user->password))
        	{
        		$this->session->set(
        			'auth',
        			[
                        'username' => $user->username,
                        'role' => $user->role,
                        'remember' => $remember
        			]
                );
                /////////////////////////////////////////
                if($remember=="1"){
                    $this->cookies->set(
                        'remember-username',
                        $username,
                        time() + 15 * 86400
                    );
    
                    $this->cookies->set(
                        'remember-password',
                        $password,
                        time() + 15 * 86400
                    );
                }
                
                ////////////////////////////////////////////
               
               
        		(new Response())->redirect()->send();
            }
            else{
                $this->security->hash(rand());
                $this->message = "Incorrect password";
                $this->dispatcher->forward(['action'=> 'create']);
            }
        }
        else {
            if($password==="" | $username==="")
                $this->message = "You must fill username and password to log in";
            else
                $this->message = "Incorrect username and password.";

            $this->dispatcher->forward(['action'=> 'create']);
        }
    }

    public function destroyAction()
    {
        setcookie("remember", ['username'=> "budi", 'password'=>"$password"], (86400 * 15), '/');

        // $remCookies = $this->cookies->get('remember');
        // $remCookies->delete();
         $this->session->destroy();
        //  $this->cookies->send();
     	$this->response->redirect();   
    }
}