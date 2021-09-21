<?php

namespace App\Http\Controllers;

use App\Models\SupplierPayment;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    public function index() {
        return SupplierPayment::with('supplier')->get();
    }

    public function show(SupplierPayment $supplierPayment)
    {
        return $supplierPayment;
    }

    public function store(Request $request)
    {
        $supplierPayment = SupplierPayment::create($request->all());
        return response()->json($supplierPayment, 201);
    }

    public function update(Request $request, SupplierPayment $supplierPayment)
    {
        $supplierPayment->update($request->all());

        return response()->json($supplierPayment, 200);
    }

    public function destroy(SupplierPayment $supplierPayment)
    {
        $supplierPayment->delete();

        return response()->json(null, 204);
    }
}
