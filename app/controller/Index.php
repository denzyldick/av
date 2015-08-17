<?php

namespace Framework\Controller;

use Framework\Library\Controller;
use Framework\Model\User;

class Index extends Controller
{

    public function indexAction()
    {
       $name = User::find(array(),null)[0];;
       $this->render("index",array("name" => $name));
    }
}
