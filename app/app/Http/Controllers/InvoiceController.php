<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\UseCases\Invoice\ShowInvoice\ShowInvoiceService;
use App\UseCases\Invoice\CreateInvoice\CreateInvoice;
use App\UseCases\Invoice\CreateInvoice\CreateInvoiceService;
use App\UseCases\Invoice\DeleteInvoice\DeleteInvoiceService;
use App\UseCases\Invoice\UpdateInvoice\UpdateInvoice;
use App\UseCases\Invoice\UpdateInvoice\UpdateInvoiceService;
use App\UseCases\Invoice\ListInvoices\ListInvoiceService;
use App\UseCases\Invoice\ListInvoices\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Request $request, ListInvoiceService $listInvoiceService)
    {
        $invoices = $listInvoiceService->list();
        return array_map(
            fn (Invoice $invoice) => $invoice->asArray(),
            $invoices
        );
    }

    public function show(Request $request, $id, ShowInvoiceService $showInvoiceService)
    {
        try {
            $invoice = $showInvoiceService->show($id);
            return response()->json($invoice->asArray());
        } catch(\Domain\Models\Invoice\InvoiceNotFound $e){
            return  response()->json([
                'message' => 'Invoice not found'
            ], 404);
        }
    }

    public function store(StoreInvoiceRequest $request, CreateInvoiceService $createInvoiceService)
    {
        try{
            $createInvoice = CreateInvoice::fromRequestData($request->all());
            $invoiceID = $createInvoiceService->create($createInvoice);
            return response()->json(['invoice_id' => $invoiceID]);
        }  catch(\Domain\Models\Invoice\InvalidHsnCode $e){
            return response()->json([
                'message' =>  $e->getMessage()
            ], 400);
        }
    }

    public function update(UpdateInvoiceRequest $request, $id, UpdateInvoiceService $updateInvoiceService)
    {
        try{
            $updateInvoice = UpdateInvoice::fromRequestData($request->all());
            $invoiceID = $updateInvoiceService->update($updateInvoice, $id);
            return response()->json(['invoice_id' => $invoiceID]);
        }  catch(\Domain\Models\Invoice\InvalidHsnCode $e){
            return response()->json([
                'message' =>  $e->getMessage()
            ], 400);
        } catch(\Domain\Models\Invoice\InvoiceNotFound $e){
            return  response()->json([
                'message' => 'Invoice not found'
            ], 404);
        }
    }

    public function destroy(Request $request, $id, DeleteInvoiceService $deleteInvoiceService)
    {
        try {
            $invoiceID = $deleteInvoiceService->delete($id);
            return response()->json(['invoice_id' => $invoiceID]);
        } catch(\Domain\Models\Invoice\InvoiceNotFound $e){
            return  response()->json([
                'message' => 'Invoice not found'
            ], 404);
        }
    }

}
