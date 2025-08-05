<?php

namespace App\UseCases\Vendor\ListVendors;

use App\Application\UseCases\Vendor\ListVendors\VendorListRepository;

class ListVendorService
{
    private VendorListRepository $vendors;

    public function __construct(VendorListRepository $repo)
    {
        $this->vendors = $repo;
    }

    function list(): array
    {
        return $this->vendors->listVendors();
    }
}
