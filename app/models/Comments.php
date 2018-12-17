<?php

use Phalcon\Mvc\Model;

class Comments extends Model
{
    public $id_comment;
    public $id_article;
    public $alias;
    public $content;
    public $time_submit;
}