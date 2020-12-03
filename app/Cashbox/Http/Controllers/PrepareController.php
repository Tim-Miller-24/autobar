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

        return view('cash.prepare');
    }

}
