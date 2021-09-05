<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index() {
        return Customer::all();
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function store(Customer $request)
    {
        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return response()->json($customer, 200);
    }

    public function delete(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }

    public function example(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|unique:customers|max:8',
            'firstName' => 'required',
            'lastName' => 'required',
            'identity' => 'required|unique:customers|max:10',
            'address' => 'required',
            'phone' => 'required'
        ]);

        if ($validated) {
            $validatedData = $request->validated();
            $customer = Customer::create($validatedData);
            $customer->save();
        }
    }
}
