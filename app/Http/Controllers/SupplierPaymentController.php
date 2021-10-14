<?php

namespace App\Http\Controllers;

use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class SupplierPaymentController extends Controller
{
    public function index() {
        return SupplierPayment::all();
    }

    public function show(SupplierPayment $supplierPayment)
    {
        return $supplierPayment;
    }

    public function document(SupplierPayment $supplierPayment)
    {
        $dompdf = new Dompdf();
        $data = [
            'supplierPayment' => $supplierPayment,
            'supplier' => $supplierPayment->supplier,
        ];
        $html = view('documents/supplier_payment', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("pago_a_proveedor_$supplierPayment->id.pdf");
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
