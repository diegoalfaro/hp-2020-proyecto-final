<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Product;

class RepairController extends Controller
{
    public function index() {
        return Repair::with(['customer', 'products'])->get();
    }

    public function show(Repair $repair)
    {
        return $repair;
    }

    public function store(Request $request)
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

        $repair = Repair::create($params);
        $repair->products()->sync($products);
        
        return response()->json($repair, 201);
    }

    public function update(Request $request, Repair $repair)
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
        
        $repair->update($params);
        $repair->products()->sync($products);

        return response()->json($repair, 200);
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();

        return response()->json(null, 204);
    }
}
