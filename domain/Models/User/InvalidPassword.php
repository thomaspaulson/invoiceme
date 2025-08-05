<?php

namespace Domain\Models\User;

use Exception;

class InvalidPassword extends Exception
{
    // public function __construct($message, $code)
    // {
    //     parent::__construct($message, $code);
    // }

    public static function incorrectPassword()
    {
        $message = "Invalid password";
        return new self($message);
    }
}
