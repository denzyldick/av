<?php

namespace Framework\Controller;

use Framework\Library\Controller;
use Framework\Model\User;

class Index extends Controller
{

    public function indexAction()
    {
        /**
         * Not going to work!
         */
       $name = User::find([
           "firstname = 'test'",
           "limit"=>0,
           "order"=>"firstname",
           "group"=>"firstname DESC",
           "having"=>null
       ])[0];
        /**
         * This is how it should be:
         * $name = User::find->where("email=>'test@test.nl'")->andWhere("firstname='denzyl'")->orWhere("lastname='d'")->orderBy('email',ORDER::DESC)->groupBy();
         */
       $this->render("index",array("name" => $name));
    }
}
