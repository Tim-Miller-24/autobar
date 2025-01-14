<?php

namespace App\Cashbox\Http\Livewire;

use App\Cashbox\Models\Wallet;
use Livewire\Component;
use App\Cashbox\Models\Cart;

class CartClear extends Component
{
    public $text = 'custom.clear_cart';

    protected $listeners = [
        'itemAdded' => 'render',
        'creditAdded' => 'render',
        'itemRemoved' => 'render',
    ];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {

    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.cart-clear', [
            'items' => Cart::getItems(),
            'current_sum' => Wallet::getCurrentSum()
        ]);
    }
}
