<?php

namespace App\Http\Controllers;

use App\UseCases\Vendor\ShowVendor\ShowVendorService;
use App\UseCases\Vendor\CreateVendor\CreateVendor;
use App\UseCases\Vendor\CreateVendor\CreateVendorService;
use App\UseCases\Vendor\DeleteVendor\DeleteVendorService;
use App\UseCases\Vendor\UpdateVendor\UpdateVendor;
use App\UseCases\Vendor\UpdateVendor\UpdateVendorService;
use App\UseCases\Vendor\ListVendors\ListVendorService;
use App\UseCases\Vendor\ListVendors\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\Vendor\CreateVendorRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;

class VendorController extends Controller
{

    public function index(Request $request, ListVendorService $listVendorService)
    {

        $result = $listVendorService->list();
        $result['data'] = array_map(
            fn (Vendor $vendor) => $vendor->asArray(),
            $result['data']
        );
        return $result;
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

    public function update(UpdateVendorRequest $request, $id, UpdateVendorService $updateVendorService)
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
