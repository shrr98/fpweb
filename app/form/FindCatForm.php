<?php
Namespace App\Forms;

use App\Forms\BaseForm;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Submit;

use Phalcon\Tag;

// validation
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Alpha;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\InclusionIn;



class FindCatForm extends BaseForm {
    public function initialize(){
        // ------------- cat's name -----------------
        $cat_name = new Text( 'cat_name',
        [
            'placeholder' => 'Enter Cat\'s Name',
            'class' => 'form-control'
        ]);
        $cat_name->setLabel('How do you want to call the cat?');
        // ------------- gender's radio button -----------------

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

        $uncertain = new Radio('Uncertain',
        [
            'name' => 'gender',
            'value'=>'Uncertain'        
        ]);
        $uncertain->setLabel("Uncertain");
        

        // ------------- cat's condition -----------------

        $cat_condition = new TextArea('cat_condition',
        [
            'placeholder' => 'Describe Cat\'s Condition',
            'class' => 'form-control'
        ]);

        $cat_condition->setLabel('How does the cat look like?');

        // ------------- cat's photo -----------------

        $cat_photo = new File('cat_photo',
        [
            'placeholder' => 'Browse Picture',
            'class' => 'form-control'
        ]);
        
        $cat_photo->setLabel('Insert a photo of the cat.');

        $cat_photo->addValidator(new PresenceOf(['message'=>'Cat\'s photo required']));
        // ------------- location -----------------

        $location = new TextArea('location',
        [
            'placeholder' => 'Enter Your Location',
            'class' => 'form-control'
        ]);

        $location->setLabel('Where do you find the cat?');

        $location->addValidator(new PresenceOf([
            'message' => 'Location must be specified'
        ]));

        $submit = new Submit('Report',
        [
            'class' => 'btn btn-primary'
        ]);

        $this->setUserOptions([
            'action' => 'report',
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ]);

        $this->add($cat_name);
        
        $this->add($male);
        $this->add($female);
        $this->add($uncertain);

        $this->add($cat_condition);
        $this->add($cat_photo);
        $this->add($location);
        $this->add($submit);

        // ------------- admin only ---------------
        $age = new Text('age',
        [
            'placeholder' => 'Enter estimated age',
            'class' => 'form-control'
        ]);

        $penyakit = new Text('penyakit',
        [
            'placeholder' => 'Suffers',
            'class' => 'form-control'
        ]);

        $this->add($age);
        $this->add($penyakit);
    }
}