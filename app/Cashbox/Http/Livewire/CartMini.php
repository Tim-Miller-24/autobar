<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart;
use App\Cashbox\Models\Wallet;

class CartMini extends Component
{
    protected $listeners = [
        'itemAdded' => 'render',
        'itemRemoved' => 'render',
        'creditAdded' => 'render'
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

    public function remove($id, $quantity = 0, $option_id = false)
    {
        Cart::remove($id, $quantity, $option_id);

        session()->flash('message', 'Товар удалён из корзины');

        $this->emit('itemRemoved', [
            'id' => $id,
            'option_id' => $option_id
        ]);
    }

    public function add($id, $quantity = 1, $option_id = false)
    {
        Cart::add($id, $quantity, $option_id);

        session()->flash('message', 'Товар добавлен в корзину.');

        $this->emit('itemAdded', [
            'id' => $id,
            'option_id' => $option_id
        ]);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.cart-mini', [
            'items' => Cart::getItems(),
            'current_sum' => Wallet::getCurrentSum(),
            'total_price' => Cart::getTotalPrice() ? Cart::getTotalPrice() : 0,
            'items_count' => Cart::getItemsCount() ? Cart::getItemsCount() : 0
        ]);
    }
}
