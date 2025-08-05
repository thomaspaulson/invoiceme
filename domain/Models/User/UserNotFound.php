<?php

namespace Domain\Models\User;

use Exception;

class UserNotFound extends Exception
{
    // public function __construct($message, $code)
    // {
    //     parent::__construct($message, $code);
    // }

    public static function withEmail($email)
    {
        $message = "User not found";
        return new self($message);
    }
}
