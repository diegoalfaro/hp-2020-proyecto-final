<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/ventas', 'sales')->name('sales');
Route::view('/clientes', 'customers')->name('customers');
Route::view('/proveedores', 'suppliers')->name('suppliers');
Route::view('/productos', 'products')->name('products');