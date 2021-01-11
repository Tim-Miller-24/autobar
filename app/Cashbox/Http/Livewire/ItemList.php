<?php

namespace App\Cashbox\Http\Livewire;

use App\Cashbox\Models\Item;
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
        $category = Category::with('items', 'items.orders', 'items.options', 'items.incomes', 'children', 'children.items', 'parent', 'parent.items')
            ->orderBy('lft')
            ->active()
            ->findOrFail($this->category_id);

        $items = $category->items;

        if(!$category->items->count()) {
            if($category->children->count()) {
                $items = Item::active()->whereIn('category_id', $category->children->pluck('id'))->inRandomOrder()->limit(10)->get();
            }
        }

        return view('cash.components.item-list', [
            'cart_items' => Cart::getItems(),
            'category' => $category,
            'items' => $items
        ]);
    }
}
