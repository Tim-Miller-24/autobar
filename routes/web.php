<?php

use Illuminate\Support\Facades\Route;
use App\Cashbox\Http\Controllers\CategoryController;
use App\Cashbox\Http\Controllers\CartController;
use App\Cashbox\Http\Controllers\WalletController;
use App\Cashbox\Http\Controllers\ManagerController;
use App\Cashbox\Http\Controllers\PrepareController;
use App\Http\Middleware\CheckIfCheckout;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckIfManager;
use App\Http\Middleware\MaintenanceMode;
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
//Route::get('/set_income_id', function () {
//    $items = \App\Cashbox\Models\OrderItem::all();
//
//    foreach($items as $item) {
//        $item->income_id = $item->getIncomeId();
//        $item->save();
//    }
//});

//Route::get('/income_socks', function () {
//    $items = \App\Cashbox\Models\Item::whereIn('category_id', [41, 42, 43, 44, 45, 46])->get();
//
//    foreach($items as $item) {
//        \App\Cashbox\Models\Income::create([
//            'item_id' => $item->id,
//            'quantity' => 3,
//            'price' => $item->price - 3000
//        ]);
//    }
//});

Route::middleware([MaintenanceMode::class])->group(function () {
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

    Route::get('/cart/checkout', [CartController::class, 'checkout'])
        ->name('cart.checkout');

    Route::post('/wallet/add', [WalletController::class, 'add']);
});

Route::middleware([CheckIfManager::class])->group(function () {
    Route::get('/manager', [ManagerController::class, 'show'])
        ->name('manager.show');

    Route::get('/manager/orders', [ManagerController::class, 'orders'])
        ->name('manager.orders');

    Route::get('/manager/order/{id}', [ManagerController::class, 'order'])
        ->name('manager.order.show')
        ->where('id', '[0-9]+');

    Route::get('/manager/print/{id}', [ManagerController::class, 'printer'])
        ->where('id', '[0-9]+');
});

Route::middleware([CheckIfAdmin::class])->group(function () {
    Route::get('/manager/sales', [ManagerController::class, 'sales'])
        ->name('manager.sales');

    Route::get('/manager/stats', [ManagerController::class, 'stats'])
        ->name('manager.stats');

    Route::get('/manager/control', [ManagerController::class, 'control'])
        ->name('manager.control');

    Route::post('/manager/control', [ManagerController::class, 'controlHandle'])
        ->name('manager.control.handle');

    Route::get('api/option', 'App\Cashbox\Http\Controllers\Api\OptionController@index');
    Route::get('api/option/{id}', 'App\Cashbox\Http\Controllers\Api\OptionController@show');

});

Route::get('/maintenance', function () {
    return view('cash.maintenance');
})->name('show.maintenance');

Route::get('/manager/sales/socks', [ManagerController::class, 'salesSocks'])
    ->name('manager.sales.socks');

Route::get('/manager/stats/socks', [ManagerController::class, 'statsSocks'])
    ->name('manager.stats.socks');


Route::get('login', 'App\Cashbox\Http\Controllers\LoginController@showLoginForm')->name('backpack.auth.login');
Route::post('login', 'App\Cashbox\Http\Controllers\LoginController@login');
Route::get('logout', 'App\Cashbox\Http\Controllers\LoginController@logout')->name('backpack.auth.logout');
Route::post('logout', 'App\Cashbox\Http\Controllers\LoginController@logout');

// Registration Routes...
Route::get('register', 'Backpack\CRUD\app\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('backpack.auth.register');
Route::post('register', 'Backpack\CRUD\app\Http\Controllers\Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Backpack\CRUD\app\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('backpack.auth.password.reset');
Route::post('password/reset', 'Backpack\CRUD\app\Http\Controllers\Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Backpack\CRUD\app\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('backpack.auth.password.reset.token');
Route::post('password/email', 'Backpack\CRUD\app\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('backpack.auth.password.email');