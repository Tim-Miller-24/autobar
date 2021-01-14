<?php

namespace App\Cashbox\Http\Livewire;

//use App\Cashbox\Models\Item;
use Livewire\Component;
use App\Cashbox\Models\Cart;

class Item extends Component
{
    protected $listeners = [
        'creditAdded' => 'render'
    ];

    public $item;

    public function mount($item)
    {
        $this->item = $item;
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
        return view('cash.components.item-single', [
            'cart_items' => Cart::getItems(),
            'item' => $this->item
        ]);
    }
}
