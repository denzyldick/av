<?php

namespace Framework\Library;


class AV
{
    private $router;
    public function __construct()
    {
        include_once __DIR__.'/../conf/services.php';
        $this->router = new Router(Container::DI());
    }

    public function run(){
        $this->router->listen();
    }
}