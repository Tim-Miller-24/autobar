<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Cart;
use Illuminate\Routing\Controller;
use App\Cashbox\Models\Wallet;

class CartController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('cash.cart-show');
    }

    public function checkout()
    {
        if(!Cart::getItems()) {
            return redirect()->route('cash.show');
        }

        if(Cart::getTotalPrice() > Wallet::getCurrentSum()) {
            Wallet::send([
                'action' => 'START'
            ]);
        }

        if(Cart::getTotalPrice() <= Wallet::getCurrentSum()) {
            return redirect()->route('prepare.show');
        }

        return view('cash.checkout-show');
    }

}
