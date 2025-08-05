<?php

namespace App\UseCases\Vendor\CreateVendor;

use Domain\Models\Vendor\Vendor;
use Domain\Models\Vendor\VendorRepository;
use Domain\Shared\Clock;
use Domain\Shared\Date;

class CreateVendorService
{
    private VendorRepository $vendorRepo;

    private Clock $clock;

    public function __construct(VendorRepository $repo, Clock $clock)
    {
        $this->vendorRepo = $repo;
        $this->clock = $clock;
    }

    function create(CreateVendor $createVendor): string
    {
        $id = $this->vendorRepo->uuid();
        $created = $updated = Date::fromCurrentTime($this->clock->currentTime());
        $vendor = Vendor::create(
            $id,
            $createVendor->firstName(),
            $createVendor->lastName(),
            $createVendor->email(),
            $createVendor->contact(),
            $createVendor->address(),
            $created,
            $updated
        );
        // insert vendor into db
        $this->vendorRepo->create($vendor);

        return $id;
    }
}
