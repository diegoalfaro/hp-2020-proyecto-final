<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BudgetController;

Route::resources([
    'customers' => CustomerController::class,
    'suppliers' => SupplierController::class,
    'products'  => ProductController::class,
    'budgets'  => BudgetController::class,
], [
    'except' => ['create', 'edit']
]);