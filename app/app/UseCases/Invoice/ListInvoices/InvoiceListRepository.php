<?php
declare(strict_types=1);
namespace App\UseCases\Invoice\ListInvoices;

interface InvoiceListRepository
{
    public function listInvoices(): array;
}
