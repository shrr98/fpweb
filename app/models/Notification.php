<?php

use Phalcon\Mvc\Model;

class Notification extends Model
{
    public $id_notif;
    public $user;
    public $msg;
    public $isread;
    public $date_notif;
}