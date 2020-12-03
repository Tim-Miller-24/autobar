<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart;

class CartClear extends Component
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

    public function clear()
    {
        Cart::deleteItems();

        $this->emit('clearCart');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.cart-clear', [
            'items' => Cart::getItems()
        ]);
    }
}
