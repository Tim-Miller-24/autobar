<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart;

class ItemOption extends Component
{
    public $item;
    public $option;

    public function mount($item, $option)
    {
        $this->item = $item;
        $this->option = $option;
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
        return view('cash.components.option-modal-item', [
            'cart_items' => Cart::getItems(),
            'item' => $this->item,
            'option' => $this->option
        ]);
    }
}
