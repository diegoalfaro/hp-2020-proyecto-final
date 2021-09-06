<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/ventas', 'home', ["title" => "Ventas"])->name('orders');
Route::view('/productos', 'home', ["title" => "Productos"])->name('products');
Route::view('/clientes', 'customers')->name('customers');