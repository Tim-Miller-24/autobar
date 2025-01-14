<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Order;
use Illuminate\Support\Facades\Cache;
use App\Cashbox\Models\Cart;
use App\Cashbox\Models\Wallet;
use App\Cashbox\Models\Workday;

class Manager extends Component
{
    protected $listeners = [
        'creditAdded' => 'render',
        'orderFinished' => 'render',
        'orderCreated' => 'orderCreated'
    ];

    public $orders;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {

    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $workday_id = Cache::get(Workday::WORKDAY_ID_KEY);
        $workday = false;

        if($workday_id) {
            $workday = Workday::with('orders')->find($workday_id);
        }
        
        $this->orders = Order::pending()->with('items', 'items.item', 'items.option', 'items.item.category')->get();

        return view('cash.components.manager', [
            'workday' => $workday,
            'orders' => $this->orders,
            'order_current_sum' => Wallet::getCurrentSum(),
            'left_sum' => Wallet::getCurrentSum() < Cart::getTotalPrice() ? Cart::getTotalPrice() - Wallet::getCurrentSum() : 0,
            'payout' => Wallet::getCurrentSum() > Cart::getTotalPrice() ? Wallet::getCurrentSum() - Cart::getTotalPrice() : 0,
        ]);
    }

    public function orderCreated()
    {
        $this->orders = Order::pending()->with('items', 'items.item')->get();
    }

    public function cancelOrder($id)
    {
        Order::destroy($id);

        Cache::forget(Order::CACHE_KEY);

        Cache::forget(Cart::KEY);

        Wallet::reset();

        Wallet::send([
            'action' => 'STOP'
        ]);

        $this->emit('orderFinished');

        \App\Cashbox\Models\Manager::send([
            'event' => 'orderFinished',
            'url' => route('cash.show')
        ]);

        return redirect()->route('manager.show');
    }

    public function orderFinished($id)
    {
        $order = Order::find($id);
        $order->status = Order::STATUS_FINISH;
        $order->user_id = auth()->user()->id;
        $order->price = Cart::getTotalPrice();
        $order->workday_id = Cache::get(Workday::WORKDAY_ID_KEY);
        $order->save();
        $order->printReceipt();

        Cache::forget(Order::CACHE_KEY);

        Cache::forget(Cart::KEY);

        Wallet::reset();

        Wallet::send([
            'action' => 'STOP'
        ]);

        $this->emit('orderFinished');

        \App\Cashbox\Models\Manager::send([
            'event' => 'orderFinished',
            'url' => route('ready.show')
        ]);

        return redirect()->route('manager.show');
    }
}
