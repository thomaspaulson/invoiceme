<?php
declare(strict_types=1);
namespace App\UseCases\Invoice\ListInvoices;

use App\UseCases\Invoice\ListInvoices\InvoiceListRepository;

class ListInvoiceService
{
    public function __construct(private  InvoiceListRepository $invoices) {
    }

    function list(): array {
        return $this->invoices->listInvoices();
    }
}
