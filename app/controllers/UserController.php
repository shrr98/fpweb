<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

use App\Forms\SignupForm;


class UserController extends Controller
{

    public function initialize(){
      $this->message = [
          'error' => '',
          'success' => '',
          'username' => '',
          'name' => '',
          'gender' => '',
          'email' => '',
          'password' => '',
          'confirmp' => '',
          'phone' => ''
    ];
    }

    private function preparePhoto(){
        $imageLoc = APP_PATH . '\\img\\default_profile.png';
        $image = file_get_contents($imageLoc);
        $image = base64_encode($image);
        return $image;
    }

    public function createAction()
    {
        if($this->session->has('auth'))
        $this->response->redirect('profile');
        
        
        $this->view->form = new SignupForm();
        $this->view->message = $this->message;
    }

    public function storeAction()
    {   
        $flag=0;;
        if(!$this->request->isPost()){
            $this->response->redirect();
        }
        $form = new SignupForm();
        if($this->request->getPost('gender')==""){
            $this->message['gender'] = "You must fill this field";
            $flag = 1;
        }
        $username = $this->request->getPost('username');
        if(Users::findfirst("username='$username'")){
                $this->message['username'] = "Username already exists";
                $flag = 1;
        }
        if(!$form->isValid($this->request->getPost()))
        {
            foreach($form->getMessages() as $msg)
                $this->message[$msg->getField()] = $msg;
        }
        else if(!$flag) {
            $user = new Users();

            $name = $this->request->getPost('name');
            if($name=='')
                $name = 'Anonymous';
            
            $username = $this->request->getPost('username');
            
            $email = $this->request->getPost('email');
            $password = $this->security->hash($this->request->getPost('password'));
            $phone = $this->request->getPost('phone');
            $gender = $this->request->getPost('gender');

            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->name = $name;
            $user->phone = $phone;
            $user->gender = $gender;
            $user->role = 0;

            $user->photo = $this->preparePhoto();


            if($user->save() === false)
            {
                foreach ($user->getMessages() as $message) {
                    $this->message['error'] = 'An error occured. Please try again later.';
                }
            }

            else{
                $this->message['success'] = 'Sign up success.';
                $this->view->form = new SignupForm();
            }

        }
        return $this->dispatcher->forward(['action' => 'create']);
    }
}