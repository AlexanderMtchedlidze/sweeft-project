<?php

use App\Http\Controllers\API\Auth\SessionController;
use App\Http\Controllers\API\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [SessionController::class, 'login'])->middleware('guest')->name('login');

Route::middleware('auth:sanctum')->controller(ProductController::class)
	->prefix('/products')
	->name('products.')
	->group(function () {
		Route::post('/create', 'store')->name('create');
		Route::patch('/{product}', 'update')->name('product');
		Route::get('/{product:code}/check-shelf-life', 'checkShelfLifeExpiration')->name('check_shelf_life');
		Route::get('/{product:code}/get-quantity-and-type', 'getQuantityAndType')->name('get_quantity–and_type');
	});
