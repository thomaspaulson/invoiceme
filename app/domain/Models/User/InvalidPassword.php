<?php

namespace Domain\Models\User;

use Exception;

class InvalidPassword extends Exception
{
    private function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public static function incorrectPassword()
    {
        $message = "Invalid password";
        return new self($message);
    }
}
