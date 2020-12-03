<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Order;
use Illuminate\Support\Facades\Cache;

class Prepare extends Component
{
    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        //
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $order = Order::with('items', 'items.item')->find(Cache::get(Order::CACHE_KEY));

        return view('cash.components.prepare', [
            'order' => $order,
        ]);
    }

}
