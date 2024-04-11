<?php

namespace Av\Controller;

use Av\Library\Controller;

class Example extends Controller
{
    public function index():void
    {
        $this->render("index", array("hello" => "Welcome message"));
    }
}
