<?php

namespace App\Cashbox\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Cashbox\Models\Order;
use Illuminate\Support\Facades\Cache;

class PrepareController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        if(!Cache::has(Order::CACHE_KEY)) {
            return redirect()->route('cash.show');
        }

        $order = Order::with('items', 'items.item')->find(Cache::get(Order::CACHE_KEY));

        return view('cash.prepare', [
            'order' => $order
        ]);
    }

    public function ready()
    {
        return view('cash.ready');
    }

}
