<?php


namespace App;


use Throwable;

class MonException extends \Exception
{
/**
 * mon exception constructeur
 */
public function __construct($message = "", $code = 0)
{
    parent::__construct($message, $code);
}

public function __toString()
{
    return $this->message;
}
}