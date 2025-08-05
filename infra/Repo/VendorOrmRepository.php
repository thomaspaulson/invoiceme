<?php

namespace Infra\Repo;

use Domain\Models\Vendor\Vendor;
use Domain\Models\Vendor\VendorNotFound;
use Domain\Models\Vendor\VendorRepository;
use Domain\Shared\Date;
use Illuminate\Support\Facades\DB;
use Infra\Lib\UuidGenerator;

class VendorOrmRepository implements VendorRepository
{
    use UuidGenerator;

    function create(Vendor $vendor): void
    {
        try {
            DB::table('vendors')->insert(
                $vendor->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function update(Vendor $vendor, string $id): void
    {
        try {
            DB::table('vendors')
            ->where('id', $id)
            ->update(
                $vendor->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function getById(string $id): Vendor
    {
        // return

        $vendor = DB::table('vendors')
        ->where('id', $id)->first();

        if (!$vendor) {
            throw VendorNotFound::withId($id);
        }

        return Vendor::fromDatabase(
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

    function delete(string $id): void
    {
        try {
            DB::table('vendors')->delete($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // function uuid(): string
    // {
    //     return Str::uuid();
    // }
}
