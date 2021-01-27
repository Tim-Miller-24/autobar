<?php

namespace App\Cashbox\Http\Livewire;

use App\Cashbox\Models\Item;
use App\Cashbox\Models\Option;
use Livewire\Component;

class ControlItem extends Component
{
    protected $listeners = [
        'creditAdded' => 'render'
    ];

    public $item;
    public $option = null;

    public function mount($item, $option = null)
    {
        $this->item = $item;
        $this->option = $option;
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
                $items = Item::with('incomes', 'orders')
                    ->active()
                    ->whereIn('category_id', $category->children->pluck('id'))
                    ->inRandomOrder()
                    ->get()
                    ->where('stock', '>', 0)
                    ->take(12);
            }
        }

        return view('cash.components.item-list', [
            'cart_items' => Cart::getItems(),
            'category' => $category,
            'items' => $items
        ]);
    }
}
