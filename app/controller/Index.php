<?php

namespace Av\Controller;

use Av\Library\Controller;
use Av\Model\User;

class Index extends Controller
{

    public function indexAction()
    {

        /**
         * This is how it should be:
         * $name = User::find->where("email=>'test@test.nl'")->andWhere("firstname='denzyl'")->orWhere("lastname='d'")->orderBy('email',ORDER::DESC)->groupBy();
         */
       $this->render("index",array("name" => "hello world"));
    }
}
