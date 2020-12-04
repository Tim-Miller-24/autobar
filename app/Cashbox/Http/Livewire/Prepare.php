<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Order;

class Prepare extends Component
{
    /**
     * Mount the component.
     * @param Order
     * @return void
     */
    public $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.prepare', [
            'order' => $this->order,
        ]);
    }

}
