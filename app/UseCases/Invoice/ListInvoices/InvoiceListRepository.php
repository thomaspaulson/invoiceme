<?php

namespace App\UseCases\Invoice\ListInvoices;

interface InvoiceListRepository
{
    public function listInvoices(): array;
}
