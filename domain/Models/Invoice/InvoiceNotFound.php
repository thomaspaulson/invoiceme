<?php

namespace Domain\Models\Invoice;

use Exception;

class InvoiceNotFound extends Exception
{
    private function __construct($message)
    {
        parent::__construct($message);
    }

    public static function withId($id)
    {
        $message = "Invoice with id:$id not found";
        return new self($message);
    }
}
