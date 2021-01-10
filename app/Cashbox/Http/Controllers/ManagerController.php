<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Category;
use App\Cashbox\Models\Order;
use Illuminate\Routing\Controller;

class ManagerController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('cash.manager');
    }

    public function stats()
    {
//        $orders = Order::with('items', 'items.item')->finish()->get();
        $categories = Category::with('items', 'items.orders', 'items.incomes', 'items.options')->active()->get();

        return view('cash.manager-stats', [
            'categories' => $categories
        ]);
    }
}
