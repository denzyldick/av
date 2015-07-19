<?php

namespace Framework\Library;


class Container
{
    private static $pimple;
    public function __construct(\Pimple\Container $container)
    {
        self::$pimple = $container;
    }
    public static function DI()
    {
        return self::$pimple;
    }
}