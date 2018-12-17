<?php
Namespace App\Forms;
use App\Forms\BaseForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

// VALIDATION
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Alnum;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;


use Phalcon\Tag;

class SignupForm extends BaseForm {
    public function initialize(){
        // --------- name ---------------
        $name = new Text('name',
        [
            "placeholder" => "Your Name",
            'class' => 'form-control',
            'value' => 'Anonymous'
        ]);

        $name->addValidator(new StringLength(
            [
                'min' => 3, 
                'max' => 50,
                'messageMinimum' => 'Name must be at least 3 characters',
                'messageMaximum' => 'Name must be less than 50 characters'
            ]));

        $name->setLabel('What is your name?');

        // --------- username --------------
        $username = new Text ('username',
        [
            "placeholder" => "Enter Username",
            "class" => "form-control"
        ]);

        $username->setLabel('How do you want us to recognize you?');
        $username->addValidators([
            new PresenceOf(["message" => "Username required"]),
            new StringLength([
                'max' => 20,
                'min' => 3,
                'messageMinimum' => "Username must be at least 3 characters",
                'messageMaximum' => "Username must be less than 20 characters"
            ]),
            new Alnum([ 'message' => 'Username must consist of alphanumeric characters only'])
        ]
        );


        // ----------- gender ------------

        $female = new Radio('Female',
        [
            'name'=>'gender',
            'value'=>'Female'
        ]);
        $female->setLabel("Female");

        $male = new Radio('Male',
        [
            'name' => 'gender',
            'value'=>'Male',
            'checked' => 'checked'
        ]);
        $male->setLabel("Male");

        $other = new Radio('Other',
        [
            'name' => 'gender',
            'value'=>'Other'        
        ]);
        $other->setLabel("Other");


        // ---------- email --------------
        $email = new Email ('email',
        [
            "placeholder" => "Enter Your Email Address",
            "class" => "form-control"

        ]);

        $email->setLabel('Please enter your email address');

        $email->addValidator(
            new PresenceOf(["message" => "Email required"])
        );

        // --------- password --------------

        $password = new Password ('password',
        [
            "placeholder" => "Enter password",
            "class" => "form-control"

        ]);
        $password->setLabel('Please enter your password');

        $password->addValidators(
            [
                new PresenceOf(["message" => "Password required"]),
                new Regex(
                    [
                        'pattern'=>"/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
                        'message'=>'Password minimum consists of eight characters, at least one letter and one number' 
                    ]
                ),
            ]
        );

        // --------- confirm password --------------

        $confirmPassword = new Password ('confirmp',
        [
            "placeholder" => "Enter Password Confirmation",
            "class" => "form-control"

        ]);

        $confirmPassword->setLabel('Re-type your password for confirmation.');
        $confirmPassword->addValidator(
            new PresenceOf(["message" => "Password Confirmation required"])
        );


        $confirmPassword->addValidator(
            new Confirmation(
                [
                    'with' => 'password',
                    'message' => 'Password Confirmation doesn\'t match the password'
                ]
            )
        );
        // --------- phone --------------

        $phone = new Text ('phone',
        [
            "placeholder" => "Enter Your Phone Number",
            "class" => "form-control"
        ]);

        $phone->setLabel('Please mind to let us know your phone number.');
        $phone->addValidators(
            [
            new PresenceOf(["message" => "Phone required"]),
            new Regex([
                'pattern' => '/^0[0-9]{11}$/',
                'message' => 'Invalid phone number'
            ])
            ]
        );


        // --------- submit button --------------

        $submit = new Submit ('Signup',[
            'name' => 'signup',
            "class" => "btn btn-info"

        ]);
        
        $this->setUserOptions([
            'method'=> 'POST',
            'action' => 'register',
            'class' => 'signupForm'
        ]);

        $this->add($name);
        $this->add($username);

        $this->add($male);
        $this->add($female);
        $this->add($other);
  
        $this->add($email);
        $this->add($password);
        $this->add($confirmPassword);
        $this->add($phone);
        $this->add($submit);
    }
}
