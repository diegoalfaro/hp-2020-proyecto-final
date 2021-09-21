<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierReturn;
use App\Models\Product;
use Dompdf\Dompdf;

class SupplierReturnController extends Controller
{
    public function index() {
        return SupplierReturn::with(['supplier', 'products'])->get();
    }

    public function show(SupplierReturn $supplierReturn)
    {
        return $supplierReturn;
    }

    public function document(SupplierReturn $supplierReturn)
    {
        $dompdf = new Dompdf();
        $data = [
            'supplierReturn' => $supplierReturn,
            'supplier' => $supplierReturn->supplier,
            'products' => $supplierReturn->products()->get(),
        ];
        $html = view('documents/supplier_return', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("devolucion_a_proveedor_$supplierReturn->id.pdf");
    }


    public function store(Request $request)
    {
        $supplierReturn = SupplierReturn::create($request->all());
        return response()->json($supplierReturn, 201);
    }

    public function update(Request $request, SupplierReturn $supplierReturn)
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
        
        $supplierReturn->update($params);
        $supplierReturn->products()->sync($products);

        return response()->json($supplierReturn, 200);
    }

    public function destroy(SupplierReturn $supplierReturn)
    {
        $supplierReturn->delete();

        return response()->json(null, 204);
    }
}