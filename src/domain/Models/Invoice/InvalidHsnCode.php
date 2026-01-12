<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

use \Exception;

class InvalidHsnCode extends Exception
{
    public function __construct(string $message) {
        parent::__construct(($message));
    }
}
