<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart;
use App\Cashbox\Models\Category;

class ItemList extends Component
{
    protected $listeners = [
        'creditAdded' => 'render'
    ];

    public $category_id;

    public function mount($id)
    {
        $this->category_id = $id;
    }

    public function remove($id, $quantity = 0)
    {
        Cart::remove($id, $quantity);

        session()->flash('message', 'Товар удалён из корзины');

        $this->emit('itemRemoved');
    }

    public function add($id)
    {
        Cart::add($id);

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
        $category = Category::with('items', 'items.orders', 'items.incomes')->active()->findOrFail($this->category_id);

        return view('cash.components.item-list', [
            'cart_items' => Cart::getItems(),
            'items' => $category->items
        ]);
    }
}
