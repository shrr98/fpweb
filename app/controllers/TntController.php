<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;

use App\Forms\CommentForm;

class TntController extends Controller
{
    private $error, $success;

    public function createAction()
    {
        // Comments
        $query1 = $this->modelsManager->createQuery('SELECT * FROM Comments WHERE id_article = "1" ORDER BY id_comment DESC');
        $query2 = $this->modelsManager->createQuery('SELECT * FROM Comments WHERE id_article = "2" ORDER BY id_comment DESC');
        
        $comments1 = $query1->execute();
        $comments2 = $query2->execute();

        $this->view->comments1 = $comments1;
        $this->view->comments2 = $comments2;
        $this->view->error = $this->error;
        $this->view->success = $this->success;
    }

    public function storeAction()
    {
        if(!$this->request->isPost())
            return $this->response->redirect('tipsntrick');
        
        $form = new CommentForm();

        if(!$form->isValid($this->request->getPost())){
            $this->error = "Comment could not be sent.";
        }
        else{
            $komen = new Comments();
            $komen->id_article = $this->request->getPost('id_article');
            $komen->alias = $this->request->getPost('alias');
            $komen->content = $this->request->getPost('content');
            $komen->time_submit = date("Y-m-d h:i:sa");

            if($komen->save()){
                $this->success = "Comment has been posted.";
            }
            else
                $this->error = " Could not post the comment.";

        }

        $this->dispatcher->forward(['action' => 'create']);

    }
}