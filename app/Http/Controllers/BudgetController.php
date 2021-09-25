<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Product;
use Dompdf\Dompdf;

class BudgetController extends Controller
{
    public function index() {
        return Budget::with(['customer', 'products'])->get();
    }

    public function show(Budget $budget)
    {
        return $budget;
    }

    public function document(Budget $budget)
    {
        $dompdf = new Dompdf();
        $data = [
            'budget' => $budget,
            'customer' => $budget->customer,
            'products' => $budget->products()->get(),
        ];
        $html = view('documents/budget', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("presupuesto_$budget->id.pdf");
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

        $budget = Budget::create($params);
        $budget->products()->sync($products);
        
        return response()->json($budget, 201);
    }

    public function update(Request $request, Budget $budget)
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
        
        $budget->update($params);
        $budget->products()->sync($products);

        return response()->json($budget, 200);
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return response()->json(null, 204);
    }
}
