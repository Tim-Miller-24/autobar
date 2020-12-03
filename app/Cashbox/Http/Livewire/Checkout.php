<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use App\Cashbox\Models\Cart;
use App\Cashbox\Models\Wallet;
//use Redis;

class Checkout extends Component
{
    protected $listeners = [
        'creditAdded' => 'render',
        'orderPaid' => 'prepare',
        'clearCart' => 'cancel'
    ];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        //
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
        return view('cash.components.checkout', [
            'items' => Cart::getItems(),
            'total_price' => Cart::getTotalPrice(),
            'current_sum' => Wallet::getCurrentSum(),
            'left_sum' => Wallet::getCurrentSum() < Cart::getTotalPrice() ? Cart::getTotalPrice() - Wallet::getCurrentSum() : 0,
            'payout' => Wallet::getCurrentSum() > Cart::getTotalPrice() ? Wallet::getCurrentSum() - Cart::getTotalPrice() : 0
        ]);
    }

    public function prepare()
    {
        return redirect()->route('prepare.show');
    }
}
