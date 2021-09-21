<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductBrand;

class ProductBrandController extends Controller
{
    public function index() {
        return ProductBrand::all();
    }

    public function show(ProductBrand $productBrand)
    {
        return $productBrand;
    }

    public function store(Request $request)
    {
        $productBrand = ProductBrand::create($request->all());
        return response()->json($productBrand, 201);
    }

    public function update(Request $request, ProductBrand $productBrand)
    {
        $productBrand->update($request->all());

        return response()->json($productBrand, 200);
    }

    public function destroy(ProductBrand $productBrand)
    {
        $productBrand->delete();

        return response()->json(null, 204);
    }
}
