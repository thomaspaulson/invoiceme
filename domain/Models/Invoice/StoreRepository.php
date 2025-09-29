<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;


interface StoreRepository
{
    public function get(): array;

}
