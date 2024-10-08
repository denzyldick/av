<?php

declare(strict_types=1);

namespace Av;

enum Option {
  case Error;
  case Ok;
  case Empty;

  public function trust(): Option {
    return match ($this) {
      self::Ok => ;
    };
  }
}
