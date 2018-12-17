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
        $this->view->message=$this->message;
        $user_rem = null;
        $remCookies = $this->cookies->get('remember');
        $remCookies = $remCookies->getValue();
// var_dump($_COOKIE); die();
        // if($remCookies){
        //     $user_rem = [
        //         'username' => $remCookies['username'],
        //         'password' => $remCookies['password']
        //     ];
        // }
        if(isset($_COOKIE['remember'])){
            $user_rem = [
                'username' => $_COOKIE['remember']['username'],
                'password' => $_COOKIE['remember']['password']
            ];
        }

        // var_dump($user_rem); die();
        $this->view->form = new LoginForm($user_rem);
        
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
                
                if($remember==1){
                    $this->cookies->set(
                        "remember",
                        [
                            'username' => $username,
                            'role' => $user->role,
                            'password' => $password,
                        ],
                        time() + 15 * 86400
                    );
                    $this->cookies->send();
                    setcookie("remember", ['username'=> $username, 'password'=>$password], (86400 * 15), '/');
                    
                    
                }
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