<?php

namespace Framework\Library;


class Container
{
    private $pimple;
    public function __construct(\Pimple\Container $container)
    {
        $this->pimple = $container;
    }
    public static function DI()
    {
        return self::$pimple;
    }
}