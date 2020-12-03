<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Cashbox\Models\Order;

class CheckIfCheckout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Cache::has(Order::CACHE_KEY)) {
            return redirect()->route('cart.checkout');
        }

        return $next($request);
    }
}
