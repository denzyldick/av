<?php

namespace Av;

use Av\Exception\NotHandelingError;


class Promise
{
    private bool $ran = false;

    public static function exec(Promisable $promisiable): Promise
    {
        $promisiable = self();
        $promisiable->setPromise($promisiable);
        return $promisiable;
    }

    public function setPromise(Promisable $promisable)
    {
        $this->promisiable = $promisable;
    }

    public function then(callable $ok, callable $fail): Entity
    {
        if (is_callable($fail) === false) {
            throw new NotHandlingError();
        }
        if (is_callable($ok) && is_callable($fail)) {
            try {
                $result = $this->wait();
                $ok($result);
                $this->ran = true;
            } catch (\Throwable $e) {
                $fail($e);
                if (get_class() === 'Exception') {
                    throw new $e;
                }
            }
        }
    }

    public function wait()
    {
        if ($this->ran) {
            throw new \Av\Exception\PromiseAlreadySuccessfullyRan();
        }
        return $this->then(
            function ($result) {
                return $result;
            },
            function (Throwable $e) {

                echo $e->getMessage();
            }
        );
    }
}
