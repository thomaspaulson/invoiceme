<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;


interface InvoiceRepository
{
    function create(Invoice $Invoice): void;

    function update(Invoice $user, string $id): void;

    function getById(string $id): Invoice;

    function delete(string $id): void;

    function uuid(): string;

}
