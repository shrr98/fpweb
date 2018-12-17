<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;



use App\Forms\DonateForm;

class DonateController extends Controller
{
    private $notif;
    private $error;
    private $messages;

    public function initialize(){
        $this->notif = "";
        $this->error = "";
        $this->messages = "";
    }

    public function createAction()
    {
        if($this->session->get('auth')['role']==1)
            $this->dispatcher->forward(['action' => 'list']);

        $this->view->messages = $this->messages;
        $this->view->notif = $this->notif;
        $this->view->error = $this->error;
        $this->view->form = new DonateForm();
        
    }

    public function storeAction()
    {
        if(!$this->request->isPost()){
            $this->response->redirect();
        }

        $form = new DonateForm();
        if(!$this->session->has('auth')) $this->error = 'You must be logged in.';
        else if(!$form->isValid($this->request->getPost())){
            foreach ($form->getMessages() as $msg)
            $this->messages = $msg;
        }
        else {
            $donate = new Donation();

            $donate->donator = $this->session->get('auth')['username'];
            $donate->nominal = $this->request->getPost('nominal');
            $donate->date_donation = date ('Y-m-d');
            if($donate->save()){
                $this->notif = 'Thank you for your donation';
            }
            
            else $this->error = 'An Error has occured. Please try again.';
        }

        $this->dispatcher->forward(['action'=>'create']);
    }

    public function listAction()
    {
        $cat;
        $i=0;
        $donations = Donation::find();
        $this->view->donations = $donations;
    }
}