<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart as CartModel;


class Cart extends Component
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

    public function remove($id, $quantity = 0)
    {
        CartModel::remove($id, $quantity);

        session()->flash('message', 'Товар удалён из корзины');

        $this->emit('itemRemoved');
    }

    public function add($id)
    {
        CartModel::add($id);

        session()->flash('message', 'Товар добавлен в корзину.');

        $this->emit('itemAdded');
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
