<?php

namespace Domain\Models\Vendor;

use Exception;

class VendorNotFound extends Exception
{
    private function __construct($message)
    {
        parent::__construct($message);
    }

    public static function withId($id)
    {
        $message = "Vendor with id: $id not found";
        return new self($message);
    }
}
