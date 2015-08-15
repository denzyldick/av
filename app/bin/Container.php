<?php

namespace Framework\Library;


use Pimple\Container as Pimple;

class Container
{
    private static $pimple;
    public function __construct(Pimple $container)
    {
        self::$pimple = $container;
    }
    public static function DI() : Pimple
    {
        return self::$pimple;
    }
}