<?php

declare(strict=1);

namespace Av\Domain\Entity;

/**
 * User model
 * @package Av\Model
 */
class User implements Insert, Update, Select {
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

  /**
   * Save the user into the database.
   */
  public function save(Database $store): bool {

    $response = $store->query(
      "
INSERT INTO user(name, email, firstname, lastname)
VALUESE(:name, :email,:firstname, :lastname)      
      "
    )->wait(false);


    return $response->ok();
  }

  public function serialize(): array {
    return [
      'firstname' => $this->firstname,
      'lastname' => $this->lastname,
      'email' => $this->email,
    ];
  }

  public static function new(Database $database, User $user): self {


    return self();
  }
}
