<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        return Product::all();
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

    public function priceUpdate(Request $request)
    {
        $products = $request->input('products');
        $percentage = $request->input('percentage');
        $multiplier = 1 + floatval($percentage) / 100;
        foreach ($products as $product) {
            $product = Product::find($product['id']);
            $data = [
                "cost_price" => round(floatval($product->cost_price) * floatval($multiplier)),
                "list_price" => round(floatval($product->list_price) * floatval($multiplier)),
            ];
            $product->update($data);
        }
    }
}
