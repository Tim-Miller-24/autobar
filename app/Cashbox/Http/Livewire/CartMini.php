<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart;

class CartMini extends Component
{
    protected $listeners = [
        'itemAdded' => 'render',
        'itemRemoved' => 'render'
    ];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        //
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.cart-mini', [
            'total_price' => Cart::getTotalPrice() ? Cart::getTotalPrice() : 0,
            'items_count' => Cart::getItemsCount() ? Cart::getItemsCount() : 0
        ]);
    }
}
