<?php

namespace Infra\Repo\Vendor;

use App\UseCases\Vendor\ListVendors\VendorListRepository;
use App\UseCases\Vendor\ListVendors\Vendor;
use Domain\Shared\Date;
use Illuminate\Support\Facades\DB;

class VendorListDbRepository implements VendorListRepository
{
    public function listVendors(): array
    {
        $records = array_map(
            function ($r) {
                return new Vendor(
                    $r->id,
                    $r->company,
                    $r->firstName,
                    $r->lastName,
                    $r->email,
                    $r->contact,
                    $r->address,
                    Date::fromString($r->created_at),
                    Date::fromString($r->updated_at)
                );
            },
            DB::table('vendors')->get()->toArray()
        );

        return $records;
    }
}
