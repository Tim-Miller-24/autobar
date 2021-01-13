<?php

namespace App\Cashbox\Http\Livewire;

//use App\Cashbox\Models\Item;
use Livewire\Component;
use App\Cashbox\Models\Cart;
use App\Cashbox\Models\Category;

class Item extends Component
{
    public $item;

    protected $listeners = [
        'creditAdded' => 'render'
    ];

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
        $category = Category::with('items', 'items.orders', 'items.options', 'items.incomes', 'children', 'children.items', 'parent', 'parent.items', 'parent.children')
            ->orderBy('lft')
            ->active()
            ->findOrFail($this->category_id);

        $items = $category->items;

        if(!$category->items->count()) {
            if($category->children->count()) {
                $items = Item::with('incomes', 'orders')
                    ->active()
                    ->whereIn('category_id', $category->children->pluck('id'))
                    ->inRandomOrder()
                    ->get()
                    ->where('stock', '>', 0)
                    ->take(10);
            }
        }

        return view('cash.components.item-single', [
            'cart_items' => Cart::getItems(),
            'item' => $this->item
        ]);
    }
}
