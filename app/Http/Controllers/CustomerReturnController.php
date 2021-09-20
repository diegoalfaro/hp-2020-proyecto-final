<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerReturn;
use App\Models\Product;

class CustomerReturnController extends Controller
{
    public function index() {
        return CustomerReturn::with(['customer', 'products'])->get();
    }

    public function show(CustomerReturn $customerReturn)
    {
        return $customerReturn;
    }

    public function store(Request $request)
    {
        $customerReturn = CustomerReturn::create($request->all());
        return response()->json($customerReturn, 201);
    }

    public function update(Request $request, CustomerReturn $customerReturn)
    {
        $params = $request->all();
        $products = [];
        
        foreach ($params['products'] as $item) {
            $product = Product::find($item['id']);
            $products[$product->id] = [
                'quantity' => $item['detail']['quantity'],
                'list_price' => $product->list_price,
            ];
        }
        
        $customerReturn->update($params);
        $customerReturn->products()->sync($products);

        return response()->json($customerReturn, 200);
    }

    public function destroy(CustomerReturn $customerReturn)
    {
        $customerReturn->delete();

        return response()->json(null, 204);
    }
}
