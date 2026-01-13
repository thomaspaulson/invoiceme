<?php
declare(strict_types=1);
namespace App\UseCases\Vendor\ListVendors;

interface VendorListRepository
{
    public function listVendors(): array;
}
