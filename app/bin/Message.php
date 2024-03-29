<?php

namespace Av\Library;


class Message
{
  private $type;
  private $message;

  /**
   * @param $type |error,success,danger,notify,etc
   * @param $message
   */
  public function __construct($type, $message)
  {
    $this->message = $message;
    $this->type = $type;
  }

  /**
   * Output the message;
   * @return mixed
   */
  public function __toString(): string
  {
    return $this->message;
  }
}

