<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view("home");
})->name('home');

Route::get('/ventas', function () {
    return view("home");
})->name('orders');

Route::get('/productos', function () {
    return view("home");
})->name('products');

Route::get('/clientes', function () {
    return view("home");
})->name('customers');