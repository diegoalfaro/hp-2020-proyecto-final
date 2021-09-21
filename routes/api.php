<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VehicleBrandController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductBrandController;

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
], [
    'except' => ['create', 'edit']
]);