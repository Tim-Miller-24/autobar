<?php

namespace App\Cashbox\Http\Livewire;

use App\Cashbox\Models\Item;
use Livewire\Component;
use App\Cashbox\Models\Cart;

class ItemList extends Component
{
    protected $listeners = [
        'creditAdded' => 'render'
    ];

    public $category;

    public function mount($category)
    {
        $this->category = $category;
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
        $category = $this->category;

        $items = $category->items;

        if(!$category->items->count()) {
            if($category->children->count()) {
                $items = Item::with([
                    'activeOptions' => function ($query) {
                        $query->whereRaw('(SELECT IFNULL(sum(incomes.quantity), 0) FROM incomes WHERE incomes.option_id = options.id)
                                - (SELECT IFNULL(sum(order_items.quantity), 0) FROM order_items WHERE order_items.option_id = options.id)
                        > 0');
                    },
                ])
                    ->active()
                    ->whereIn('category_id', $category->children->pluck('id'))
                    ->whereRaw('(SELECT IFNULL(sum(incomes.quantity), 0) FROM incomes WHERE incomes.item_id = items.id)
                        - (SELECT IFNULL(sum(order_items.quantity), 0) FROM order_items WHERE order_items.item_id = items.id)
                    > 0')
                    ->inRandomOrder()
                    ->take(12)
                    ->get();
            }
        }

        return view('cash.components.item-list', [
            'cart_items' => Cart::getItems(),
            'category' => $category,
            'items' => $items
        ]);
    }
}
