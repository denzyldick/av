<?php

declare(strict=1);

namespace Av\Model;


use Av\Library\Model;

/**
 * User model
 * @package Av\Model
 */
class User extends Model {
  private $email;
  private $lastname;
  private $firstname;

  public function getFullname(): String {
    return "$this->firstname $this->lastname";
  }
  public function getEmail(): String {
    return $this->email;
  }
  public function getLastname(): String {
    return $this->lastname;
  }
  public function getFirstname(): String {
    return $this->firstname;
  }
}

