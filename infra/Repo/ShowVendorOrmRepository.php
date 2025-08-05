<?php

namespace App\Infra\Repo;

use App\UseCases\Vendor\ShowVendor\ShowVendorRepository;
use App\UseCases\Vendor\ShowVendor\Vendor;
use Illuminate\Support\Facades\DB;
use Domain\Shared\Date;

class ShowVendorOrmRepository implements ShowVendorRepository
{
    public function viewVendor(): Vendor
    {

        if (!$vendor) {
            throw VendorNotFound::withId($id);
        }

        return new Vendor(
            $vendor->id,
            $vendor->firstName,
            $vendor->lastName,
            $vendor->email,
            $vendor->contact,
            $vendor->address,
            Date::fromString($vendor->created_at),
            Date::fromString($vendor->updated_at),
        );

    }
}
