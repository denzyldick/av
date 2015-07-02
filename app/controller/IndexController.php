<?php

namespace Framework\Controller;

use Framework\Library\ControllerBase;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->render("index");
    }
}
