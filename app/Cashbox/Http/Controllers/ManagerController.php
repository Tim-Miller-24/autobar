<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Item;
use App\Cashbox\Models\Order;
use App\Cashbox\Models\OrderItem;
use App\Exports\ItemExport;
use App\Exports\OrderExport;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\ValidationException;
use App\Cashbox\Http\Filters\OrderFilter;
use Illuminate\Validation\Rule;

class ManagerController extends Controller
{
    use ValidatesRequests;

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

    public function stats(Request $request)
    {
        try {
            //TODO: Sort by columns
            $this->validate($request, [
                'order_by' => [
                    'nullable',
                    Rule::in(Item::SORT_BY),
                ]
            ]);

            $items = Item::with('options',
                'options.incomes',
                'options.orders',
                'incomes',
                'orders')
                ->get();

            $products = collect();

            foreach($items as $item) {
                if(count($item->options)) {
                    foreach($item->options as $option) {
                        $products->push([
                            'name' => $item->name,
                            'option' => $option->name,
                            'income_price' => $option->purchase_price,
                            'price' => $option->price ?? $item->price,
                            'stock' => $option->stock,
                            'sold' => $option->sold,
                            'incomes' => $option->incomes->sum('quantity'),
                            'profit' => (($option->price ?? $item->price) * $option->sold) - ($option->purchase_price * $option->sold),
                        ]);
                    }
                } else {
                    $products->push([
                        'name' => $item->name,
                        'option' => false,
                        'income_price' => $item->purchase_price,
                        'price' => $item->price,
                        'stock' => $item->stock,
                        'sold' => $item->sold,
                        'incomes' => $item->incomes->sum('quantity'),
                        'profit' => ($item->price * $item->sold) - ($item->purchase_price * $item->sold)
                    ]);
                }
            }

            if($request->has('order_by')) {
                $products = $products->sortByDesc($request->get('order_by'));
            } else {
                $products = $products->sortByDesc('sold');
            }

            return view('cash.manager.stats', [
                'items' => $products,
                'request' => $request
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            trigger_error($e->getMessage());
        }

    }

    public function sales(OrderFilter $filter, Request $request)
    {
        try {
            $this->validate($request, [
                'date_from' => 'nullable|date_format:Y-m-d',
                'date_to' => 'nullable|date_format:Y-m-d'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }

        $items = OrderItem::filter($filter)
            ->with('order', 'item', 'option')
            ->join('items', 'items.id', '=', 'order_items.item_id')
            ->orderBy('items.name')
            ->select('order_items.*')
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

        if($request->has('download')) {
            try {
                $date_from = $request->get('date_from') ? '_from-' . $request->get('date_from') : '';
                $date_to = $request->get('date_to') ? '_to-' . $request->get('date_to') : '';
                $filename = 'sales' . $date_from . $date_to . '.xlsx';

                return \Excel::download(new OrderExport($sales, $summary), $filename);
            } catch (\Exception $e) {
                trigger_error($e->getMessage());
            }
        }

        return view('cash.manager.sales', [
            'request' => $request,
            'sales' => $sales,
            'summary' => $summary
        ]);
    }

    public function orders(Request $request)
    {
        $orders = Order::finish()->with('items', 'items.item', 'items.option')->orderBy('created_at', 'DESC')->paginate(10);

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

    public function export()
    {
        return \Excel::download(new ItemExport, 'items.xlsx');
    }

}
