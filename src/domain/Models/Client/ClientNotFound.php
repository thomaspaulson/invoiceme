<?php

namespace Domain\Models\Client;

use Exception;

class ClientNotFound extends Exception
{
    private function __construct($message)
    {
        parent::__construct($message);
    }

    public static function withId($id)
    {
        $message = "Client with id: $id not found";
        return new self($message);
    }
}
