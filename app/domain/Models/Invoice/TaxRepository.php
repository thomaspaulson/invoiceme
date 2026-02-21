<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;


interface TaxRepository
{
    public function get(): array;

}
