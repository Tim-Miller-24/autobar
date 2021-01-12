<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Category;
use App\Cashbox\Models\Item;
use App\Cashbox\Models\Order;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('cash.manager.index');
    }

    public function stats()
    {
//        $orders = Order::with('items', 'items.item')->finish()->get();
        $categories = Category::with('items', 'items.orders', 'items.incomes', 'items.options')->active()->get();

        return view('cash.manager.stats', [
            'categories' => $categories
        ]);
    }

    public function orders(Request $request)
    {
        $orders = Order::finish()->with('items', 'items.item', 'items.option')->orderBy('created_at')->paginate(10);

        return view('cash.manager.orders', [
            'orders' => $orders
        ]);
    }

    public function order($id)
    {
        $order = Order::with('items', 'items.item', 'items.option', 'items.item.incomes', 'items.option.incomes')->finish()->find($id);

        return view('cash.manager.order', [
            'order' => $order
        ]);
    }

    public function item($id)
    {
        $item = Item::with('incomes', 'options', 'orders')->find($id);

        return view('cash.manager.item', [
            'item' => $item
        ]);
    }
}
