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

    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return response()->json($customer, 200);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }

    public function balanceReport(Customer $customer)
    {
        $sales = array_map(function($item){
            return [
                'type' => __('document_types.sale'),
                'date' => $item['date'],
                'amount' => -floatval($item['total']),
            ];
        }, $customer->sales()->get()->toArray());

        $repairs = array_map(function($item){
            return [
                'type' => __('document_types.repair'),
                'date' => $item['date'],
                'amount' => -floatval($item['total']),
            ];
        }, $customer->repairs()->get()->toArray());

        $payments = array_map(function($item){
            return [
                'type' => __('document_types.payment'),
                'date' => $item['date'],
                'amount' => floatval($item['amount']),
            ];
        }, $customer->customerPayments()->get()->toArray());

        $items = array_merge($sales, $repairs, /*$returns,*/ $payments);

        usort($items, function($a, $b) {
            return $a['date'] < $b['date'];
        });

        $total = array_reduce($items, function($carry, $item){
            return $carry + $item['amount'];
        }, 0);

        return [
            'items' => $items,
            'total' => $total
        ];
    }

}
