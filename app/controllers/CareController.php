<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;



use App\Forms\DonateForm;

class CareController extends Controller
{
    private $error;
    private $success;
    private $messages = ['nominal'=>''];

    private function createInvoice($donate){
        $file = fopen(APP_PATH . "\\Invoice_Of_Donation.txt", "w");
        fwrite($file, "Donation Invoice at IT'S Catty Peri\r\n");
        $text = "Donator: " . $donate->donator . "\r\n";
        fwrite($file, $text);
        $text = "Id cat: " . $donate->id_cat . "\r\n";
        fwrite($file, $text);$text = $text;
        $text = "Nominal: " . $donate->nominal . "\r\n";
        fwrite($file, $text);
        $text = "Date: " . $donate->date_donation . "\r\n";
        fwrite($file, $text);
        fclose($file);
        return APP_PATH . "\\Invoice_Of_Donation.txt";
    }

    public function createAction()
    {
        if($this->session->get('auth')['role']==1)
            $this->dispatcher->forward(['controller'=>'donate','action' => 'list']);


        $cat;
        $i=0;
        $cats = Cats::find("last_up is not null and isadopt is null");
        foreach($cats as $c){
            $cat[$i++] = $c;
        }
        $this->view->cats = $cat;
        $this->view->countcat = $i;
        $this->view->form = new DonateForm();
        $this->view->error = $this->error;
        $this->view->success = $this->success;
        $this->view->messages = $this->messages;
    }

    public function storeAction()
    {
        if(!$this->request->isPost()){
            return $this->request->redirect('care');
        }

        $id_cat=$this->request->getPost('id_cat');
        $form = new DonateForm();
        
        if(!$this->session->has('auth')){
            $this->error = 'You must log in first before donating.';
        }
        
        else if ($id_cat==null){
            $this->error = 'Could not process donation request. Please try again.';
        }
        
        else if(!$form->isValid($this->request->getPost())){
            foreach ($form->getMessages() as $msg)
                $this->messages[$msg->getField()] = $msg;
        }

        else{
            $cat = Cats::findFirst("id_cat='$id_cat'");

            if($cat!=null){
                $donate = new Donation();
                $donate->id_cat = $id_cat;
                $donate->donator = $this->session->get('auth')['username'];
                $donate->nominal = $this->request->getPost('nominal');
                $donate->date_donation = date('Y-m-d');
                if($donate->save()){
                    $this->success = 'Success! Thank you for your donation :)';
                    $invoice = $this->createInvoice($donate);
                    header("Content-Disposition: attachment; filename=\"" . basename($invoice) . "\"");
                    header("Content-Type: application/force-download");
                    header("Content-Length: " . filesize($invoice));
                    readfile($invoice);
                }
                else
                    $this->error = 'An error occurs. Please try again.';
            }
            
            else{
                $this->error = 'An error occurs. Please try again.';
            }
        }
        if($this->success == '') $this->dispatcher->forward(['action' => 'create']);

    }
}