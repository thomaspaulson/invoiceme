<?php

namespace App\UseCases\Vendor\UpdateVendor;

use Domain\Models\Vendor\Vendor;
use Domain\Models\Vendor\VendorRepository;
use Domain\Shared\Clock;
use Domain\Shared\Date;

class UpdateVendorService
{
    private VendorRepository $vendorRepo;

    private Clock $clock;

    public function __construct(
        VendorRepository $repo,
        Clock $clock
    ) {
        $this->vendorRepo = $repo;
        $this->clock = $clock;
    }

    function update(UpdateVendor $updateVendor, string $id): string
    {
        $updated = Date::fromCurrentTime($this->clock->currentTime());
        $vendor = $this->vendorRepo->getById($id);
        $vendor->update(
            $updateVendor->firstName(),
            $updateVendor->lastName(),
            $updateVendor->email(),
            $updateVendor->contact(),
            $updateVendor->address(),
            $updated,
            $vendor
        );
        // update vendor
        $this->vendorRepo->update($vendor, $id);
        return $id;
    }
}
