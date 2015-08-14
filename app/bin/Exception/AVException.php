<?php
namespace Framework\Library\Exception;

use Exception;

class AVException extends Exception{
        public function __construct(Exception $e)
        {
            /**
             * @todo implement logger
             */
            echo $e->getMessage();
        }
}