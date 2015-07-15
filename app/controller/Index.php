<?php

namespace Framework\Controller;

use Framework\Library\Controller;


class Index extends Controller
{

    public function indexAction()
    {echo $this->get("ff");
        $this->render("index");
    }
}
