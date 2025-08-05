<?php

namespace Domain\Models\Vendor;

use Exception;

class VendorNotFound extends Exception
{
    // public function __construct($message, $code)
    // {
    //     parent::__construct($message, $code);
    // }

    public static function withId($id)
    {
        $message = "Vendor with id:$id not found";
        return new self($message);
    }
}
