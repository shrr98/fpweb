<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;

class AdoptController extends Controller
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

    public function createAction()
    {
        if($this->session->get('auth')['role']==1)
            $this->dispatcher->forward(['action' => 'list']);
        $cat;
        $i=0;
        $cats = Cats::find("penyakit != '' and isadopt is null");
        foreach($cats as $c){
            $cat[$i++] = $c;
        }
        $this->view->cats = $cat;
        $this->view->countcat = $i;
        $this->view->error = $this->error;
        $this->view->success = $this->success;
    }

    public function storeAction()
    {
        if(!$this->request->isPost()){
            return $this->request->redirect('adopt');
        }

        $id_cat=$this->request->getPost('id_cat');
        if(!$this->session->has('auth')){
            $this->error = 'You must log in first before adopting.';
        }
        else if ($id_cat==null){
            $this->error = 'Could not process adoption request. Please try again.';
        }
        else{
            $cat = Cats::findFirst("id_cat='$id_cat'");
            $cat->isadopt = true;

            $adopt = new CatsAdoption();
            $adopt->id_cat = $id_cat;
            $adopt->adopter = $this->session->get('auth')['username'];
            $adopt->date_adopt = date('Y-m-d');

            if($adopt->save() & $cat->update()){
                $this->setUserNotif($cat, ": Has been adopted.\nThank you for the help :)");
                $this->success = 'Success! Thank you for adopting our cat :)';
            }
            else{
                $this->error = 'An error occurs. Please try again.';
            }
        }

        $this->dispatcher->forward(['action' => 'create']);

    }

    public function listAction()
    {
        $cat;
        $i=0;
        $adopt = CatsAdoption::find();
        $this->view->adopts = $adopt;
    }
}

