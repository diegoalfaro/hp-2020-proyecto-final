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
use App\Http\Controllers\SupplierPurchaseController;

Route::get('/customer_returns/{customer_return}/document', [CustomerReturnController::class, 'document']);
Route::get('/customer_payments/{customer_payment}/document', [CustomerPaymentController::class, 'document']);
Route::get('/supplier_returns/{supplier_return}/document', [SupplierReturnController::class, 'document']);
Route::get('/supplier_payments/{supplier_payment}/document', [SupplierPaymentController::class, 'document']);
Route::get('/supplier_purchases/{supplier_purchase}/document', [SupplierPurchaseController::class, 'document']);
Route::get('/sales/{sale}/document', [SaleController::class, 'document']);
Route::get('/budgets/{budget}/document', [BudgetController::class, 'document']);
Route::get('/repairs/{repair}/document', [RepairController::class, 'document']);
Route::post('/products/price_update', [ProductController::class, 'priceUpdate']);
Route::get('/customers/{customer}/balance_report', [CustomerController::class, 'balanceReport']);
Route::get('/suppliers/{supplier}/balance_report', [SupplierController::class, 'balanceReport']);


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
    'supplier_purchases' => SupplierPurchaseController::class,
], [
    'except' => ['create', 'edit']
]);