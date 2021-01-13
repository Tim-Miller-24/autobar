<?php

namespace App\Cashbox\Providers;

use App\Cashbox\Http\Livewire\CategoryList;
use App\Cashbox\Http\Livewire\Checkout;
use App\Cashbox\Http\Livewire\ItemList;
use App\Cashbox\Http\Livewire\Cart;
use App\Cashbox\Http\Livewire\CartMini;
use App\Cashbox\Http\Livewire\CartClear;
use App\Cashbox\Http\Livewire\ItemOptions;
use App\Cashbox\Http\Livewire\ItemOption;
use App\Cashbox\Http\Livewire\Item;
use App\Cashbox\Http\Livewire\MenuButton;
use App\Cashbox\Http\Livewire\Manager;
use App\Cashbox\Http\Livewire\Prepare;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;


class CashboxServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *components.
     * @return void
     */
    public function register()
    {
        // ...
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('cash.category-list', CategoryList::class);
            Livewire::component('cash.item-list', ItemList::class);
            Livewire::component('cash.cart-mini', CartMini::class);
            Livewire::component('cash.cart-clear', CartClear::class);
            Livewire::component('cash.menu-button', MenuButton::class);
            Livewire::component('cash.cart', Cart::class);
            Livewire::component('cash.checkout', Checkout::class);
            Livewire::component('cash.prepare', Prepare::class);
            Livewire::component('cash.manager', Manager::class);
            Livewire::component('cash.item-options', ItemOptions::class);
            Livewire::component('cash.item', Item::class);
            Livewire::component('cash.item-option', ItemOption::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::componentNamespace('App\\Cashbox\\View\\Components', 'cash');
    }
}
