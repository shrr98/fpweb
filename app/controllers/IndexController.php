<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class IndexController extends Controller
{
    public function show404Action()
    {
        echo "Maaf url tidak valid";
        die();
    }
}