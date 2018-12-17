<?php
Namespace App\Forms;

use App\Forms\BaseForm;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Number;
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



class EditcatForm extends BaseForm {
    public function initialize(){
        // ------------ cat's id --------------------
        $id = new Hidden('id_cat');


        // ------------- cat's name -----------------
        $cat_name = new Text( 'name_cat',
        [
            'placeholder' => 'Cat\'s Name',
            'class' => 'form-control'
        ]);
        $cat_name->setLabel('Cat\'s name');
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
        ]);
        $male->setLabel("Male");
        

        // ------------- cat's condition -----------------

        $cat_condition = new TextArea('condition_cat',
        [
            'placeholder' => 'Cat\'s Condition',
            'class' => 'form-control'
        ]);

        $cat_condition->setLabel('Cat\'s conditiion');


        $submit = new Submit('Update',
        [
            'class' => 'btn btn-info'
        ]);

        $this->setUserOptions([
            'action' => 'edit',
            'method' => 'post',
        ]);

        $this->add($cat_name);
        
        $this->add($male);
        $this->add($female);

        $this->add($cat_condition);
        $this->add($submit);

        // ------------- admin only ---------------
        $age = new Text('age',
        [
            'placeholder' => 'Estimated Cat\'s age',
            'class' => 'form-control'
        ]);
        $age->setLabel('Cat\'s age');


        $penyakit = new Text('penyakit',
        [
            'placeholder' => 'Suffers',
            'class' => 'form-control'
        ]);
        $penyakit->setLabel('Cat\'s suffers');

        // -------------- Type Cat ---------------
        $t1 = new Radio('t1',
        [
            'name'=>'type_cat',
            'value'=>'Polydactyl'
        ]);
        $t1->setLabel("Polydactyl");

        
        $t2 = new Radio('t2',
        [
            'name'=>'type_cat',
            'value'=>'Snowshoe'
        ]);

        $t2->setLabel("Snowshoe");

        $t3 = new Radio('t3',
        [
            'name'=>'type_cat',
            'value'=>'Calico'
        ]);
        $t3->setLabel("Calico");
        
        
        $t4 = new Radio('t4',
        [
            'name'=>'type_cat',
            'value'=>'British Shorthair'
        ]);
        $t4->setLabel("British Shorthair");
        

        $t5 = new Radio('t5',
        [
            'name'=>'type_cat',
            'value'=>'Siamese'
        ]);
        $t5->setLabel("Siamese");

        $t6 = new Radio('t6',
        [
            'name'=>'type_cat',
            'value'=>'Norwegian Forest Cat'
        ]);
        $t6->setLabel("Norwegian Forest Cat");
        
        $t7 = new Radio('t7',
        [
            'name'=>'type_cat',
            'value'=>'Persian'
        ]);
        $t7->setLabel("Persian");

        $t8 = new Radio('t8',
        [
            'name'=>'type_cat',
            'value'=>'Javanese'
        ]);
        $t8->setLabel("Javanese");

        $this->add($t1);
        $this->add($t2);
        $this->add($t3);
        $this->add($t4);
        $this->add($t5);
        $this->add($t6);
        $this->add($t7);
        $this->add($t8);
        


        $this->add($id);
        $this->add($age);
        $this->add($penyakit);
    }
}