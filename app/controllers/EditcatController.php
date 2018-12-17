<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

// for file uploading
use Phalcon\Http\Request\File;

use App\Forms\FindCatForm;
use App\Forms\EditcatForm;

class EditcatController extends Controller
{
    private $error;
    private $success;

    private function setUserNotif($cat, $msg){
        $user_notif = new Notification();

        $user_notif->user = $cat->founder;
        $user_notif->cat = $cat->id_cat;
        $user_notif->msg = $cat->name_cat . $msg;
        $user_notif->isread = 0;
        $user_notif->date_notif = date('Y-m-d');
        $user_notif->save();

        // from donation
        $query = $this->modelsManager->createQuery('SELECT DISTINCT(c.founder) as username FROM Cats c, Donation d  WHERE d.id_cat = :id_cat: and c.id_cat = d.id_cat');
        $users  = $query->execute(
            [
                'id_cat' => $cat->id_cat,
            ]
        );

        $donator_notif = new Notification();        

        foreach ($users as $u) {
            if ($u['username']===$cat->founder) continue;

            $donator_notif->user = $u['username'];
            $donator_notif->cat = $cat->id_cat;
            $donator_notif->msg = $cat->name_cat . $msg;
            $donator_notif->isread = 0;
            $donator_notif->date_notif = date('Y-m-d');
            $donator_notif->save();
        }
    }

    public function showAction(){
        if( !$this->session->has('auth') || $this->session->get('auth')['role']!=1)
            $this->dispatcher->forward(['controller'=>'error', 'action' => 'forbidden']);

        $cat;
        $i=0;
        $cats = Cats::find();
        foreach($cats as $c){
            $cat[$i++] = $c;
        }
        $this->view->cats = $cat;
        $this->view->countcat = $i;
        $this->view->error = $this->error;
        $this->view->success = $this->success;
    }

    public function deleteAction(){
        if(!$this->request->isPost()){
            
            return $this->response->redirect('editcat');
        }

        $id_cat = $this->request->getPost('id_cat');

        if($id_cat==null){
            $this->error = "Could not find cat's data. Please try again.";
        }
        else{
            $cat = Cats::findFirst("id_cat='$id_cat'");

            if($cat!=null){
                $fileLoc = BASE_PATH . '//public//' . $cat->photo;
                $this->setUserNotif($cat, ": Sorry, the cat has passed away :(");
                if($cat->delete()){
                    if(!unlink($fileLoc)) $this->error = 'Photo related to the cat could not be deleted';
                    $this->success = "Cat has been deleted.";
                }
                else $this->error = "An error occurs. Please try again.";
            }
            else{
                $this->error = "Could not find cat's data. Please try again.";                
            }
        }
        $this->dispatcher->forward(['action'=>'show']);
    }

    public function editAction(){
        if(!$this->request->hasQuery('id_cat') && !$this->dispatcher ){
            return $this->response->redirect('editcat');
        }

        $this->view->notif = $this->notif;
        $this->view->error = $this->error;
        $this->view->messages = $this->messages;
        if($this->request->hasQuery('id_cat'))
            $id_cat = $this->request->getQuery('id_cat');
       
        else if($this->dispatcher)
            $id_cat = $this->dispatcher->getParams()['id_cat'];
       
        $cat = Cats::findFirst("id_cat=$id_cat");

        $form = new EditcatForm($cat);
        $this->view->form = $form;
        $this->view->cat = $cat;
    }

    public function updateAction(){
        if(!$this->request->isPost()){
            $this->response->redirect('edit');
        }
        $form = new EditcatForm();
        if (!$this->session->has('auth')) 
            $this->error = 'You must be logged in.';

        else if(!$form->isValid($this->request->getPost())){
            foreach ($form->getMessages() as $msg){
                $this->messages[$msg->getField()] = $msg;
            }
            $this->error = 'Could not update cat\'s information';
        }

        else{ 
            $id_cat = $this->request->getPost('id_cat');          
            $cat = Cats::findFirst("id_cat=$id_cat");
           
            if($cat==null){
                $this->error = 'Error finding cat\'s data.';
            }

            else{
                $postData = $this->request->getPost(); echo $postData['gender'];
                $cat->name_cat = $postData['name_cat'];
                $cat->condition_cat = $postData['condition_cat'];
                $cat->age = $postData['age'];
                $cat->type_cat = $postData['type_cat'];                
                $cat->gender = $postData['gender'];
                $cat->penyakit = $postData['penyakit'];
                $cat->last_up = date('Y-m-d');
               
                if($cat->update()){
                    $this->notif = 'Cat\'s information has been updated';
                    $this->setUserNotif($cat, ": New condition updates!");
                }
                else{
                    $this->error = 'An error occured. Please try again.';
                }
            }
        }        
       $this->dispatcher->forward(['action'=>'edit', 'params'=>['id_cat'=> $id_cat]]);
    }

}