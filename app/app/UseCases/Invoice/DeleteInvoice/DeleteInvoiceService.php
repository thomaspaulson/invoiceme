<?php
declare(strict_types=1);
namespace App\UseCases\Invoice\DeleteInvoice;

use Domain\Models\Invoice\InvoiceRepository;

class DeleteInvoiceService
{
    public function __construct(
        private InvoiceRepository $repo
    ) {
    }

    function delete(string $id): string
    {
        $invoice = $this->repo->getById($id);
        $this->repo->delete($id);
        return $id;
    }
}
