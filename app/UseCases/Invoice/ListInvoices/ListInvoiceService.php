<?php

namespace App\UseCases\Invoice\ListInvoices;

use App\UseCases\Invoice\ListInvoices\InvoiceListRepository;

class ListInvoiceService
{
    private InvoiceListRepository $invoices;

    public function __construct(InvoiceListRepository $repo)
    {
        $this->invoices = $repo;
    }

    function list(): array
    {
        return $this->invoices->listInvoices();
    }
}
