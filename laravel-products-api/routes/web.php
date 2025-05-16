<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImportController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/api/products', ProductController::class .'@index');
// returns the form for adding a product
Route::get('/api/products/create', ProductController::class . '@create');
// adds a product to the database
Route::post('/api/products', ProductController::class .'@store');
// returns a page that shows a full post
Route::get('/api/products/{product}', ProductController::class .'@show');
// returns the form for editing a product
Route::get('/api/products/{product}/edit', ProductController::class .'@edit');
// updates a product
Route::put('/api/products/{product}', ProductController::class .'@update');
// deletes a product
Route::delete('/api/products/{product}', ProductController::class .'@destroy');

Route::post('/api/products/import', ProductImportController::class .'@import');