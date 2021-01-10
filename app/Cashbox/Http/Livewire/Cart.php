<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart as CartModel;


class Cart extends Component
{
    protected $listeners = [
        'itemAdded' => 'render',
        'itemRemoved' => 'render',
        'clearCart' => 'render'
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
        CartModel::remove($id, $quantity, $option_id);

        session()->flash('message', 'Товар удалён из корзины');

        $this->emit('itemRemoved', [
            'id' => $id,
            'option_id' => $option_id
        ]);
    }

    public function add($id, $quantity = 1, $option_id = false)
    {
        CartModel::add($id, $quantity, $option_id);

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
        return view('cash.components.cart', [
            'items' => CartModel::getItems(),
            'total_price' => CartModel::getTotalPrice(),
        ]);
    }
}
