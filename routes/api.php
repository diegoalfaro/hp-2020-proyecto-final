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
use App\Http\Controllers\SupplierReturnController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductBrandController;

Route::get('/customer_returns/{customer_return}/document', [CustomerReturnController::class, 'document']);

Route::resources([
    'customers' => CustomerController::class,
    'suppliers' => SupplierController::class,
    'products'  => ProductController::class,
    'vehicle_brands' => VehicleBrandController::class,
    'budgets'  => BudgetController::class,
    'vehicles' => VehicleController::class,
    'repairs' => RepairController::class,
    'sales' => SaleController::class,
    'product_brands' => ProductBrandController::class,
    'supplier_payments' => SupplierPaymentController::class,
    'customer_payments' => CustomerPaymentController::class,
    'customer_returns' => CustomerReturnController::class,
    'supplier_returns' => SupplierReturnController::class,
], [
    'except' => ['create', 'edit']
]);