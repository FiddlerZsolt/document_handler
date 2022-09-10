<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;

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
    return view('welcome');
});

Route::controller(CategoryController::class)->group(function ()
{
    Route::get('/categories/{id}', 'show')->where('id', '[0-9]+');
    Route::get('/categories/create', 'create');
    Route::get('/categories', 'index');

    Route::post('/categories/store', 'store');
    Route::post('/categories/{id}', 'update')->where('id', '[0-9]+');

    Route::delete('/categories/{id}', 'destroy');
});
