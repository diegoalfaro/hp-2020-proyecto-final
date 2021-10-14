<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index() {
        return Supplier::all();
    }

    public function show(Supplier $supplier)
    {
        return $supplier;
    }

    public function store(Request $request)
    {
        $supplier = Supplier::create($request->all());
        return response()->json($supplier, 201);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());

        return response()->json($supplier, 200);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json(null, 204);
    }

    public function balanceReport(Supplier $supplier)
    {
        return $supplier->balanceReport();
    }
}
