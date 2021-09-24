<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerReturn;
use App\Models\Product;
use Dompdf\Dompdf;

class CustomerReturnController extends Controller
{
    public function index() {
        return CustomerReturn::with(['customer', 'products'])->get();
    }

    public function show(CustomerReturn $customerReturn)
    {
        return $customerReturn;
    }

    public function document(CustomerReturn $customerReturn)
    {
        $dompdf = new Dompdf();
        $data = [
            'customerReturn' => $customerReturn,
            'customer' => $customerReturn->customer,
            'products' => $customerReturn->products()->get(),
        ];
        $html = view('documents/customer_return', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("devolucion_de_cliente_$customerReturn->id.pdf");
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

        $customerReturn = CustomerReturn::create($params);
        $customerReturn->products()->sync($products);
        
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
