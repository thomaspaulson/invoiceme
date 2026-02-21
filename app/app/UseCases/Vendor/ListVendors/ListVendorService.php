<?php
declare(strict_types=1);
namespace App\UseCases\Vendor\ListVendors;

use App\UseCases\Vendor\ListVendors\VendorListRepository;

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
