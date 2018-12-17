<?php
Namespace App\Forms;

use App\Forms\BaseForm;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;

use Phalcon\Tag;

// validation
use Phalcon\Validation;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;


class DonateForm extends BaseForm {
    public function initialize(){
        $cat = new Hidden('id_cat',
            [
                'value' => 0
            ]
        );
        $nominal = new Text('nominal',
            [
                'placeholder' => '0',
                'class' => 'form-control'
            ]
        );
        $nominal->setLabel('Enter nominal');
        $nominal->addValidators([
            new PresenceOf([ 'message'=> 'You should fill this field']),
            new Numericality(['message' => 'Nominal is invalid'])
        ]);

        $submit = new Submit('donate',[
            'value' => 'Donate!',
            'class' => 'btn btn-info'
        ]);
        
        $this->add($cat);
        $this->add($nominal);
        $this->add($submit);
    }
}