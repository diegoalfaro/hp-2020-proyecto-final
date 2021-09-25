<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Dompdf\Dompdf;

class SaleController extends Controller
{
    public function index() {
        return Sale::with(['customer', 'products'])->get();
    }

    public function show(Sale $sale)
    {
        return $sale;
    }

    public function document(Sale $sale)
    {
        $dompdf = new Dompdf();
        $data = [
            'sale' => $sale,
            'customer' => $sale->customer,
            'products' => $sale->products()->get(),
        ];
        $html = view('documents/sale', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("ventas_$sale->id.pdf");
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

        $sale = Sale::create($params);
        $sale->products()->sync($products);
        
        return response()->json($sale, 201);
    }

    public function update(Request $request, Sale $sale)
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
        
        $sale->update($params);
        $sale->products()->sync($products);

        return response()->json($sale, 200);
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->json(null, 204);
    }
}