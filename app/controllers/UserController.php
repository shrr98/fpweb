<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

use App\Forms\SignupForm;


class UserController extends Controller
{
    private $message;

    public function initialize(){
      $this->message = [
          'username' => '',
          'email' => '',
          'password' => '',
          'confirmp' => '',
          'phone' => ''
    ];
    }

    public function createAction()
    {
        $this->view->form = new SignupForm();
        $this->view->message = $this->message;
    }

    public function storeAction()
    {   
        if(!$this->request->isPost()){
            $this->response->redirect();
        }
        $form = new SignupForm();
        
        if(!$form->isValid($this->request->getPost())){
            foreach($form->getMessages() as $msg)
                $this->message[$msg->getField()] = $msg;
                return $this->dispatcher->forward([
                    "action" => "create"
                ]);
        }
        else{
            $user = new Users();

            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = md5($this->request->getPost('password'));

            $user->username = $username;
            $user->email = $email;
            $user->password = $password;

            if($user->save() === false)
            {
                foreach ($user->getMessages() as $message) {
                    echo $message, "\n";
                }
            }
            else{
                $this->response->redirect();   
            }
        }
    }
}