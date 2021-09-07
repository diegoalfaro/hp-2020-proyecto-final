<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

Route::resources([
    'customers' => CustomerController::class,
    'suppliers' => SupplierController::class,
], [
    'except' => ['create', 'edit']
]);