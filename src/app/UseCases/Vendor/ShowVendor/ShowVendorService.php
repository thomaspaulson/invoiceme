<?php
declare(strict_types=1);
namespace App\UseCases\Vendor\ShowVendor;

class ShowVendorService
{
    private ShowVendorRepository $showVendorRepo;

    public function __construct(
        ShowVendorRepository $repo
    ) {
        $this->showVendorRepo = $repo;
    }

    function show(string $id): Vendor
    {
        $vendor = $this->showVendorRepo->viewVendor($id);
        return $vendor;
    }
}
