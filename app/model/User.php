<?php
/**
 * Created by PhpStorm.
 * User: denzyl
 * Date: 19-7-15
 * Time: 18:52
 */

namespace Framework\Model;


use Framework\Library\Model;

class User extends Model
{
    private $email;
    private $lastname;
    private $firstname;

    public function getFullname() : String
    {
        return "$this->firstname $this->lastname";
    }
}