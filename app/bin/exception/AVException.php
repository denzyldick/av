<?php
/**
 * Created by PhpStorm.
 * User: denzyl
 * Date: 7/11/15
 * Time: 6:25 PM
 */

class AVException extends Exception{
        public function __construct(Exception $e)
        {
            /**
             * @todo implement logger
             */
        }
}