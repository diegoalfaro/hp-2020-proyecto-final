<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::resources([
    'customers' => CustomerController::class
], [
    'except' => ['create', 'edit']
]);