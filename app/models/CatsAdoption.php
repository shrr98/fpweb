<?php

use Phalcon\Mvc\Model;

class CatsAdoption extends Model
{
    public $id_adopt;
    public $id_cat;
    public $adopter;
    public $date_adopt;
}