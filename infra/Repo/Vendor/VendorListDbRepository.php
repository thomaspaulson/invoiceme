<?php

namespace Infra\Repo\Vendor;

use App\UseCases\Vendor\ListVendors\VendorListRepository;
use App\UseCases\Vendor\ListVendors\Vendor;
use Illuminate\Support\Facades\DB;

class VendorListDbRepository implements VendorListRepository
{
    public function listVendors(): array
    {
        $records = array_map(
            function ($r) {
                return new Vendor(
                    $r->id,
                    $r->firstName,
                    $r->lastName,
                    $r->email,
                    $r->contact,
                    $r->address,
                );
            },
            DB::table('vendors')->get()->toArray()
        );

        return $records;
    }
}
