<?php

namespace Domain\Models\Item;

use Exception;

class ItemNotFound extends Exception
{
    private function __construct($message)
    {
        parent::__construct($message);
    }

    public static function withId($id)
    {
        $message = "Item with id: $id not found";
        return new self($message);
    }
}
