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
        $price = trans('custom.price_sum', ['sum' => $this->item->price, 'currency' => config('settings.currency')]);

        if(count($this->item->activeOptions)) {
            $min = $this->item->activeOptions->min('price') ? $this->item->activeOptions->min('price') : $this->item->price;
            $max = $this->item->activeOptions->max('price') ? $this->item->activeOptions->max('price') : $this->item->price;

            if($min < $max) {
                $price = trans('custom.price_sum_from', [
                    'min' => $min,
                    'currency' => config('settings.currency')
                ]);
            } else {
                $price = trans('custom.price_sum', ['sum' => $min, 'currency' => config('settings.currency')]);
            }

        }

        return view('cash.components.item-single', [
            'price' => $price,
            'cart_items' => Cart::getItems(),
            'item' => $this->item
        ]);
    }
}
