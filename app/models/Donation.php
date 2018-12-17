<?php

use Phalcon\Mvc\Model;

class Donation extends Model
{
    public $id_donation;
    public $id_cat;
    public $donator;
    public $nominal;
    public $date_donation;
}