<?php

namespace App\UseCases\Vendor\ListVendors;

interface VendorListRepository
{
    public function listVendors(): array;
}
