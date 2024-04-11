<?php

namespace Av;

use Av\Exception\NotHandelingError;

class Promise {

  public static function exec(Promisable $promisiable): Promise {
    $promisiable = self();
    $promisiable->setPromise($promisiable);
    return $promisiable;
  }
  public function setPromise(Promisable $promisable) {
    $this->promisiable = $promisable;
  }
  public function then(callable $ok, callable $fail) {
    if(is_callable($fail) === false){
       throw new NotHandlingError();
    }
    if (is_callable($ok) && is_callable($fail)) {
      try {
        $result = $this->wait();
        $ok($result);
      } catch (\Throwable $e) {
        $fail($e);
      }
    }
  }

  public function wait($wait = false) {
    if ($wait === false) {
      return $this->run();
    }
  }
}
