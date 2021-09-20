<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VehicleBrandController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\CustomerReturnController;
use App\Http\Controllers\SupplierPaymentController;
use App\Http\Controllers\VehicleController;

Route::resources([
    'customers' => CustomerController::class,
    'suppliers' => SupplierController::class,
    'products'  => ProductController::class,
    'vehicle_brands' => VehicleBrandController::class,
    'budgets'  => BudgetController::class,
    'vehicles' => VehicleController::class,
    'supplier_payments' => SupplierPaymentController::class,
    'customer_payments' => CustomerPaymentController::class,
    'customer_returns' => CustomerReturnController::class,
], [
    'except' => ['create', 'edit']
]);