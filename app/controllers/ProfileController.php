<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

use App\Forms\SignupForm;
use App\Forms\UploadForm;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Submit;

use Phalcon\Validation;
use Phalcon\Validation\Validator\File as FileValidator;

class ProfileController extends Controller
{
    private $messages;

    public function initialize(){
        $this->messages = [
            'error'     => '',
            'warning'   => '',
            'success'   => '',
            'photo'     => '',
            'name'      => '',
            'username'  => '',
            'email'     => '',
            'phone'     => '',
            'password'  => '',
            'confirmp'  => ''
        ];
    }


    
    private function createProfile($us){
        // authorization
        if( !$this->session->has('auth'))
        $this->dispatcher->forward(['controller'=>'home', 'action' => 'forbidden']);


        $user = $us;
        $user->password='';
        $form = new SignupForm($user);
        
        $form->add(
            new Submit(
                'Save',
                [
                    'class' => 'btn btn-info',
                    'type' => 'button'
                ]
            )
        );

        return $form;
    }

  

    public function showAction()
    {
        $username = $this->session->get('auth')['username'];
        $user = Users::findFirst("username='$username'");
        $this->view->user = $user;
        $this->view->profile = $this->createProfile($user);
        $this->view->upload  = new UploadForm();
        $this->view->messages = $this->messages;

        // notification
        $query = $this->modelsManager->createQuery('SELECT * FROM Notification  WHERE user = :username: and isread=0 order by id_notif desc');
        $user_notif  = $query->execute(
            [
                'username' => $user->username,
            ]
        );

        $this->view->user_notif = $user_notif;
        
    }

    public function save_nameAction(){
        if(!$this->request->isPost())
        {
            return $this->response->redirect('profile');
        }

        if($this->request->getPost('name')==''){
            $this->messages['warning'] = 'No changes was made.';
           return $this->dispatcher->forward(['action'=>'show']);
        }

        else{
            $username = $this->session->get('auth')['username'];
            $user = Users::findFirst("username='$username'");
        
            $user->name = $this->request->getPost('name');
            if($user->update()){
                $this->messages['success'] = 'Changes has been saved';
            }
            else{
                $this->messages['error'] = 'An error occurs. Please try again.';
            }           
            return $this->dispatcher->forward(['action'=>'show']);

        }
    }

    
    public function save_accountAction(){
        if(!$this->request->isPost())
        {
            return $this->response->redirect('profile');  
        }
        $username = $this->session->get('auth')['username'];
        $user = Users::findFirst("username='$username'");
        $form = new SignupForm($user);
        
        if(!$form->isValid($this->request->getPost())){
            //print_r ($form);
            foreach($form->getMessages() as $msg){
                if(in_array ($msg->getField(), ['username', 'email', 'phone']))
                    $this->messages[$msg->getField()] = $msg;
            }
        }
        
        if($this->messages['username']=='' & $this->messages['email']=='' & $this->messages['phone']==''){
           
            $tobeUsername = $this->request->getPost('username');
            
            if($tobeUsername!=$username & Users::findFirst("username='$tobeUsername'")!=null){
                $this->messages['error'] = 'Could not save changes'; 
            }
            else{
                $user->username = $tobeUsername;
                $user->email    = $this->request->getPost('email');
                $user->phone    = $this->request->getPost('phone');
                
                if($user->update()){
                    $this->messages['success'] = 'Changes has been saved';
                }
                else{
                    $this->messages['error'] = 'An error occurs. Please Try again later.';
                }
            }
        }
        else
            $this->messages['error'] = 'Could not save changes.';

        $this->dispatcher->forward(['action' => 'show']);       
    }

    public function save_passwordAction(){
        if(!$this->request->isPost())
        {
            return $this->response->redirect('profile');
        }

        $username = $this->session->get('auth')['username'];
        $user = Users::findFirst("username='$username'");
        $form = new SignupForm($user);

        if(!$form->isValid($this->request->getPost())){
            //print_r ($form);
            foreach($form->getMessages() as $msg){
                if(in_array ($msg->getField(), ['password', 'confirmp']))
                    $this->messages[$msg->getField()] = $msg;
            }
        }

        
        if($this->messages['password']=='' & $this->messages['confirmp']==''){
           
            $tobeUsername = $this->request->getPost('username');
            
            if($tobeUsername!=$username & Users::findFirst("username='$tobeUsername'")!=null){
                $this->messages['error'] = 'Could not save changes'; 
            }
            else{
                $user->password = $this->security->hash($this->request->getPost('password'));
                
                if($user->update()){
                    $this->messages['success'] = 'Changes has been saved';
                }
                else{
                    $this->messages['error'] = 'An error occurs. Please Try again later.';
                }
            }
        }
        else{
            $this->messages['error'] = 'Could not save changes.';
        }
        $this->dispatcher->forward(['action' => 'show']); 
    }


    public function save_photoAction(){
        if(!$this->request->isPost())
        {
            return $this->response->redirect('profile');
        }

        $username = $this->session->get('auth')['username'];
        $user = Users::findFirst("username='$username'");
        $form = new UploadForm();
        
        if(!$form->isValid($_FILES)){
            foreach($form->getMessages() as $msg){
                $this->messages['photo'] = $msg;
            }
        }

        if($this->messages['photo']===''){
            $file = null;
            
            $file = file_get_contents($_FILES['photo']['tmp_name']);
            $enc_file = base64_encode($file);
            $user->photo = $enc_file;

            if($user->update()){
                    $this->messages['success'] = 'Changes has been saved';
                }
            else{
                $this->messages['error'] = 'An error occurs. Please Try again later.';
            }
        }
        else{
            $this->messages['error'] = 'Could not save changes.';
        }
        $this->dispatcher->forward(['action' => 'show']); 
    }


    public function seeAction(){
        if(!$this->request->hasQuery('id_notif') || !$this->session->has('auth')){
            $this->dispatcher->forward(['controller'=>'home', 'action'=>'forbidden']);
        }

        $id_notif = $this->request->getQuery('id_notif');
        $user_notif = Notification::findFirst("id_notif='$id_notif'");

        // if notif doesn't belong to user, forbidden
        if($this->session->get('auth')['username']!==$user_notif->user)
            $this->dispatcher->forward(['controller'=>'home', 'action'=>'forbidden']);
        
        $cat = Cats::findFirst("id_cat = '$user_notif->cat'");

        $this->view->cat = $cat;
    }
}