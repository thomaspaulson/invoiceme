<?php

namespace Infra\Controllers;

use App\Http\Controllers\Controller;
use App\UseCases\Vendor\ShowVendor\ShowVendorService;
// use App\UseCases\Vendor\ShowVendor\Vendor as ShowVendor;
use App\UseCases\Vendor\CreateVendor\CreateVendor;
use App\UseCases\Vendor\CreateVendor\CreateVendorService;
use App\UseCases\Vendor\DeleteVendor\DeleteVendorService;
use App\UseCases\Vendor\UpdateVendor\UpdateVendor;
use App\UseCases\Vendor\UpdateVendor\UpdateVendorService;
use App\UseCases\Vendor\ListVendors\ListVendorService;
use App\UseCases\Vendor\ListVendors\Vendor;
use Infra\Lib\ClockUsingSystemClock;
use Illuminate\Http\Request;
use Infra\Requests\Vendor\CreateVendorRequest;

class VendorController extends Controller
{

    public function index(Request $request, ListVendorService $listVendorService)
    {

        $vendors = $listVendorService->list();
        return array_map(
            fn (Vendor $vendor) => $vendor->asArray(),
            $vendors
        );

    }

    public function show(Request $request, $id, ShowVendorService $showVendorService)
    {
        $vendor = $showVendorService->show($id);

        return response()->json($vendor->asArray());
    }

    public function store(CreateVendorRequest $request, CreateVendorService $createVendorService)
    {

        $createVendor = CreateVendor::fromRequestData($request->all());
        $vendorID = $createVendorService->create($createVendor);

        return response()->json(['vendorID' => $vendorID]);
    }

    public function update(Request $request, $id, UpdateVendorService $updateVendorService)
    {

        $updateVendor = UpdateVendor::fromRequestData($request->all());
        $vendorID = $updateVendorService->update($updateVendor, $id);

        return  response()->json(['vendorID' => $vendorID]);

    }

    public function destroy(Request $request, $id, DeleteVendorService $deleteVendorService)
    {

        $vendorID = $deleteVendorService->delete($id);
        return response()->json(['vendorID' => $vendorID]);
    }

}
