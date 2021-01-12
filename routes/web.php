<?php

use Illuminate\Support\Facades\Route;
use App\Cashbox\Http\Controllers\CategoryController;
use App\Cashbox\Http\Controllers\CartController;
use App\Cashbox\Http\Controllers\WalletController;
use App\Cashbox\Http\Controllers\ManagerController;
use App\Cashbox\Http\Controllers\PrepareController;
use App\Http\Middleware\CheckIfCheckout;
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

Route::middleware([CheckIfCheckout::class])->group(function () {
    Route::get('/', [CategoryController::class, 'show'])
        ->name('cash.show');

    Route::get('/cart', [CartController::class, 'show'])
        ->name('cart.show');

    Route::get('/category/{id}', [CategoryController::class, 'category'])
        ->name('cash.category.show')
        ->where('id', '[0-9]+');

    Route::get('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');
});
Route::get('/prepare', [PrepareController::class, 'show'])
    ->name('prepare.show');
Route::get('/ready', [PrepareController::class, 'ready'])
    ->name('ready.show');
Route::get('/manager', [ManagerController::class, 'show'])
    ->name('manager.show');
Route::get('/manager/stats', [ManagerController::class, 'stats'])
    ->name('manager.stats');
Route::get('/cart/checkout', [CartController::class, 'checkout'])
    ->name('cart.checkout');

Route::post('/wallet/add', [WalletController::class, 'add']);
Route::get('/print', [WalletController::class, 'printer']);
Route::get('/wallet/send', [WalletController::class, 'send']);
Route::get('api/option', 'App\Cashbox\Http\Controllers\Api\OptionController@index');
Route::get('api/option/{id}', 'App\Cashbox\Http\Controllers\Api\OptionController@show');