<?php

namespace App\UseCases\Vendor\ShowVendor;

interface ShowVendorRepository
{
    public function viewVendor(string $id): Vendor;
}
