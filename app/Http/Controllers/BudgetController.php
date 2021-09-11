<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index() {
        return Budget::with('customer')->get();
    }

    public function show(Budget $budget)
    {
        return $budget;
    }

    public function store(Request $request)
    {
        $budget = Budget::create($request->all());
        return response()->json($budget, 201);
    }

    public function update(Request $request, Budget $budget)
    {
        $budget->update($request->all());

        return response()->json($budget, 200);
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return response()->json(null, 204);
    }
}
