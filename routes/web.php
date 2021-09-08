<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/ventas', 'home', ["title" => "Ventas"])->name('orders');
Route::view('/clientes', 'customers')->name('customers');
Route::view('/proveedores', 'suppliers')->name('suppliers');
Route::view('/productos', 'products')->name('products');