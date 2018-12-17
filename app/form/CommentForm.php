<?php
Namespace App\Forms;

use App\Forms\BaseForm;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

use Phalcon\Tag;

class CommentForm extends BaseForm {
    public function initialize(){
       
        // alias input
        $name = new Text('alias',[
        ]);
        $name->addValidator( new PresenceOf(['message' => 'You should fill this field.']));
        
        // id article
        $id_article = new Hidden('id_article');
        $id_article->addValidator( new PresenceOf(['message' => 'Article is invalid']));
       
        // content of comment
        $comment = new TextArea('content');
        $comment->addValidator( new PresenceOf(['message' => 'You should fill this field.']));


        $this->add($name);
        $this->add($id_article);
        $this->add($comment);  

    }
}