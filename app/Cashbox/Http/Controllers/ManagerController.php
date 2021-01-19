<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Category;
use App\Cashbox\Models\Item;
use App\Cashbox\Models\Order;
use App\Cashbox\Models\OrderItem;
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

    public function printer($id)
    {
        $order = Order::findOrFail($id);
        return $order->printReceipt();
    }


    public function sales(Request $request)
    {
        $items = OrderItem::with('order', 'item', 'option')
            ->join('items', 'items.id', '=', 'order_items.item_id')
            ->orderBy('items.name')
            ->select('order_items.*') //see PS:
            ->get();

        $sales = [];
        $summary = [
            'purchase' => 0,
            'sold' => 0
        ];

        foreach($items as $item) {
            $key = $item->item_id.$item->option_id.$item->price.$item->purchase_price;
            $summary['purchase'] += $item->purchase_price * $item->quantity;
            $summary['sold'] += $item->price * $item->quantity;

            if(array_key_exists($key, $sales)) {
                $sales[$key]->quantity += $item->quantity;
            } else {
                $sales[$key] = $item;
            }

        }

        return view('cash.manager.sales', [
            'sales' => $sales,
            'summary' => $summary
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
