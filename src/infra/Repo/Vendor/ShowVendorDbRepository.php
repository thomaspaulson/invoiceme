<?php

namespace Infra\Repo\Vendor;

use App\UseCases\Vendor\ShowVendor\ShowVendorRepository;
use App\UseCases\Vendor\ShowVendor\Vendor;
use Domain\Models\Vendor\VendorNotFound;
use Illuminate\Support\Facades\DB;
use Domain\Shared\Date;

class ShowVendorDbRepository implements ShowVendorRepository
{
    public function viewVendor(string $id): Vendor
    {

        $vendor = DB::table('vendors')
        ->where('id', $id)->first();

        if (!$vendor) {
            throw VendorNotFound::withId($id);
        }

        return new Vendor(
            $vendor->id,
            $vendor->company,
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
