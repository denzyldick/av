<?php

namespace Av\Controller;

use Av\Library\Controller;

class Example extends Controller
{
    public function indexAction()
    {
        $this->render("index", array("hello" => "Welcome message"));
    }
}
