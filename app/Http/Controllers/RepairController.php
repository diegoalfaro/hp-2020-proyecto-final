<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Product;
use Dompdf\Dompdf;

class RepairController extends Controller
{
    public function index() {
        return Repair::all();
    }

    public function show(Repair $repair)
    {
        return $repair;
    }

    public function document(Repair $repair)
    {
        $dompdf = new Dompdf();
        $data = [
            'repair' => $repair,
            'customer' => $repair->customer,
            'products' => $repair->products()->get(),
        ];
        $html = view('documents/repair', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("reparacion_$repair->id.pdf");
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
                    'list_price' => $product->list_price,
                ];
            }
        }

        $repair = Repair::create($params);
        $repair->products()->sync($products);
        
        return response()->json($repair, 201);
    }

    public function update(Request $request, Repair $repair)
    {
        $params = $request->all();
        $products = [];
        
        if (isset($params['products']) && !empty($params['products'])) {
            foreach ($params['products'] as $item) {
                $product = Product::find($item['id']);
                $products[$product->id] = [
                    'quantity' => $item['detail']['quantity'],
                    'list_price' => $product->list_price,
                ];
            }
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
