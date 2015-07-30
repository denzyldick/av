<?php

namespace Framework\Controller;

use Framework\Library\Controller;
use Framework\Model\User;

class Index extends Controller
{

    public function indexAction()
    {
       User::find(array(),null);
       $this->render("index");
    }
}
