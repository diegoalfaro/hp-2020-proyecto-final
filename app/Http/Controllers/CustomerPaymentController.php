<?php

namespace App\Http\Controllers;

use App\Models\CustomerPayment;
use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
{
    public function index() {
        return CustomerPayment::with('customer')->get();
    }

    public function show(CustomerPayment $customerPayment)
    {
        return $customerPayment;
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
