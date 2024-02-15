<?php

namespace Av\Library;

/**
 * Class Container
 * @package Av\Library
 */
class Container
{
  private static $container;


  public static function DI(): array
  {
    return self::$container;
  }

  public static function set($key, $function)
  {
    self::$container[$key] = $function;
  }

  public static function get($key): callable
  {
    return self::$container[$key];
  }
}
