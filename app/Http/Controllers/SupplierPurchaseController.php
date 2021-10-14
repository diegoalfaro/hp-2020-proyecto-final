<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierPurchase;
use App\Models\Product;
use Dompdf\Dompdf;

class SupplierPurchaseController extends Controller
{
    public function index() {
        return SupplierPurchase::all();
    }

    public function show(SupplierPurchase $supplierPurchase)
    {
        return $supplierPurchase;
    }

    public function document(SupplierPurchase $supplierPurchase)
    {
        $dompdf = new Dompdf();
        $data = [
            'supplierPurchase' => $supplierPurchase,
            'supplier' => $supplierPurchase->supplier,
            'products' => $supplierPurchase->products()->get(),
        ];
        $html = view('documents/supplier_purchase', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("compra_a_proveedor_$supplierPurchase->id.pdf");
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $products = [];
        
        if (isset($params['products']) && !empty($params['products'])) {
            foreach ($params['products'] as $item) {
                $product = Product::find($item['id']);
                $products[$product->id] = [
                    'quantity' => $item['detail']['quantity'],
                    'cost_price' => $product->cost_price,
                ];
            }
        }

        $supplierPurchase = SupplierPurchase::create($params);
        $supplierPurchase->products()->sync($products);
        
        return response()->json($supplierPurchase, 201);
    }

    public function update(Request $request, SupplierPurchase $supplierPurchase)
    {
        $params = $request->all();
        $products = [];
        
        if (isset($params['products']) && !empty($params['products'])) {
            foreach ($params['products'] as $item) {
                $product = Product::find($item['id']);
                $products[$product->id] = [
                    'quantity' => $item['detail']['quantity'],
                    'cost_price' => $product->cost_price,
                ];
            }
        }
        
        $supplierPurchase->update($params);
        $supplierPurchase->products()->sync($products);

        return response()->json($supplierPurchase, 200);
    }

    public function destroy(SupplierPurchase $supplierPurchase)
    {
        $supplierPurchase->delete();

        return response()->json(null, 204);
    }
}
