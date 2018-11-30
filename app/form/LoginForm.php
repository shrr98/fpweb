<?php
Namespace App\Forms;

use App\Forms\BaseForm;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

use Phalcon\Tag;

class LoginForm extends BaseForm {
    public function initialize(){
        $username = new Text ('username',
        [
            "placeholder" => "Enter Username",
            "class" => "form-control"
        ]);

        $password = new Password ('password',
        [
            "placeholder" => "Enter password",
            "class" => "form-control"

        ]);

        $submit = new Submit ('Login',[
            'name' => 'login',
            "class" => "btn btn-primary"

        ]);
        
        $this->setUserOptions([
            'method'=> 'POST',
            'class' => 'loginForm'
        ]);

        $this->add($username);
        $this->add($password);
        $this->add($submit);
    }
}