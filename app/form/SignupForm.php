<?php
Namespace App\Forms;
use App\Forms\BaseForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

// VALIDATION
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\StringLength;

use Phalcon\Tag;

class SignupForm extends BaseForm {
    public function initialize(){

        // --------- username --------------
        $username = new Text ('username',
        [
            "placeholder" => "Enter Username",
            "class" => "form-control"
        ]);

        $username->addValidators([
            new PresenceOf(["message" => "Username required"]),
            new StringLength([
                'max' => 3,
                'min' => 20,
                'message' => "Username must be 3-20 in length"
            ])
        ]
        );


        // ---------- email --------------
        $email = new Email ('email',
        [
            "placeholder" => "Enter Your Email Address",
            "class" => "form-control"

        ]);

        $email->addValidator(
            new PresenceOf(["message" => "Email required"])
        );

        // --------- password --------------

        $password = new Password ('password',
        [
            "placeholder" => "Enter password",
            "class" => "form-control"

        ]);

        $password->addValidator(
            new PresenceOf(["message" => "Password required"])
        );

        // --------- confirm password --------------

        $confirmPassword = new Password ('confirmp',
        [
            "placeholder" => "Enter Confirmation Password",
            "class" => "form-control"

        ]);

        $confirmPassword->addValidator(
            new PresenceOf(["message" => "Password Confirmation required"])
        );


        // --------- phone --------------

        $phone = new Text ('phone',
        [
            "placeholder" => "Enter Your Phone Number",
            "class" => "form-control"
        ]);

        $phone->addValidator(
            new PresenceOf(["message" => "Phone required"])
        );


        // --------- submit button --------------

        $submit = new Submit ('Signup',[
            'name' => 'signup',
            "class" => "btn btn-success"

        ]);
        
        $this->setUserOptions([
            'method'=> 'POST',
            'action' => 'register',
            'class' => 'signupForm'
        ]);

        $this->add($username);
        $this->add($email);
        $this->add($password);
        $this->add($confirmPassword);
        $this->add($phone);
        $this->add($submit);
    }
}
