<?php

namespace App\Http\Controllers;

use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use App\Models\Product;
use Dompdf\Dompdf;

class CustomerPaymentController extends Controller
{
    public function index() {
        return CustomerPayment::all();
    }

    public function show(CustomerPayment $customerPayment)
    {
        return $customerPayment;
    }

    public function document(CustomerPayment $customerPayment)
    {
        $dompdf = new Dompdf();
        $data = [
            'customerPayment' => $customerPayment,
            'customer' => $customerPayment->customer,
        ];
        $html = view('documents/customer_payment', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("pago_de_cliente_$customerPayment->id.pdf");
    }

    public function store(Request $request)
    {
        $customerPayment = CustomerPayment::create($request->all());
        return response()->json($customerPayment, 201);
    }

    public function update(Request $request, CustomerPayment $customerPayment)
    {
        $customerPayment->update($request->all());

        return response()->json($customerPayment, 200);
    }

    public function destroy(CustomerPayment $customerPayment)
    {
        $customerPayment->delete();

        return response()->json(null, 204);
    }
}
