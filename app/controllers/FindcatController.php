<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

// for file uploading
use Phalcon\Http\Request\File;

use App\Forms\FindCatForm;
use App\Forms\EditcatForm;


class FindcatController extends Controller
{
    public $notif;
    public $error;
    public $messages;

    public function initialize(){
        $this->messages = [
            'location' => '',
            'cat_photo' => '',
            'gender' => ''
        ];
        $this->notif = "";
        $this->error = "";
    }
    public function createAction()
    {
        // authorization
        if($this->session->get('auth')['role']==1)
            $this->dispatcher->forward(['controller'=>'editcat', 'action' => 'show']);


        $this->view->notif = $this->notif;
        $this->view->error = $this->error;
        $this->view->messages = $this->messages;
        $this->view->form = new FindCatForm();
        
    }

    public function storeAction()
    {
        if(!$this->request->isPost()){
            $this->response->redirect();
        }

        $form = new FindCatForm();
        if (!$this->session->has('auth')) {
            $this->error = 'You must be logged in.';
            $this->dispatcher->forward(['action' => 'report']);
        }
       if(!$form->isValid($this->request->getPost())){
            foreach ($form->getMessages() as $msg){
                if($msg->getField()!='cat_photo'){
                    $this->messages[$msg->getField()] = $msg;                   
                }
            }
        }

        if( $this->request->hasFiles('cat_photo') && $this->messages['location']==null && $this->messages['gender'] == null)
        {            
            $cat = new Cats();
           // echo $cat->lastInsertId(); return;
            if ($this->request->hasFiles() == true) {
                $cat->name_cat = $this->request->getPost('cat_name');
                $cat->condition_cat = $this->request->getPost('cat_condition');
                $cat->loc_found = $this->request->getPost('location');
                $cat->date_found = date('Y-m-d');
                $cat->gender = $this->request->getPost('gender');
                $cat->founder = $this->session->get('auth')['username'];

                if($cat->save()){
                    $this->notif = 'Cat successfully reported';
                    foreach ($this->request->getUploadedFiles() as $file) {
                        $file_toDB = "img\\img_cats\\" . $cat->id_cat . '.' .$file->getExtension();
                        $target_file = BASE_PATH .  '\\public\\' . $file_toDB;
                        $file->moveTo($target_file);
                        $cat->photo = $file_toDB;

                        $cat->update();
                    }
                }
                else $this->error = 'An error occured. Please try again.';
                    
            }
                else $this->error = 'Could not report the cat. Please upload a photo of the cat.';
        }
        
       $this->dispatcher->forward(['action'=>'create']);
    }

}