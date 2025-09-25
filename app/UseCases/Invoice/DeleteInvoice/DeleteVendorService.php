<?php

namespace App\UseCases\Vendor\DeleteVendor;

use Domain\Models\Vendor\Vendor;
use Domain\Models\Vendor\VendorRepository;

class DeleteVendorService
{
    private VendorRepository $vendorRepo;

    public function __construct(
        VendorRepository $repo
    ) {
        $this->vendorRepo = $repo;
    }

    function delete(string $id): string
    {
        $vendor = $this->vendorRepo->getById($id);
        $this->vendorRepo->delete($id);
        return $id;
    }
}
