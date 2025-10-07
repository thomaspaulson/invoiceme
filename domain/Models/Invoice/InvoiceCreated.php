<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

class InvoiceCreated
{
    public function __construct(
        public string $id
    ) {}
}
