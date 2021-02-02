<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Income;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use App\Cashbox\Models\Wallet;
use Illuminate\Http\Request;
use App\Cashbox\Models\Cart;
use Illuminate\Support\Facades\Cache;
use App\Cashbox\Models\Order;
use App\Cashbox\Models\OrderItem;
use App\Cashbox\Models\Item;
use App\Cashbox\Models\Category;

class WalletController extends Controller
{
    const SECRET_KEY = 'VALIDATOR_SECRET';

    public function test()
    {
        $category = Category::with('items',
            'items.options',
            'items.orders',
            'items.incomes',
            'items.options.orders',
            'items.options.incomes')
            ->orderBy('lft')
            ->findOrFail(10);

        foreach($category->items as $record) {
            foreach($record->options as $option) {
                $cat = Category::where('name->ru', $record->name)->first();

                if(!$cat) {
                    $cat = Category::create([
                        'name' => $record->name,
                        'parent_id' => $category->id,
                        'is_active' => true
                    ]);
                }

                $item = Item::create([
                    'name' => $option->name,
                    'position' => $option->position,
                    'category_id' => $cat->id,
                    'image' => $option->image ?? $record->image,
                    'price' => $option->price ?? $record->price,
                    'is_active' => true
                ]);

//                dd($item);
                foreach($option->incomes as $income) {
                    $income->update([
                        'item_id' => $item->id,
                        'option_id' => NULL
                    ]);
                }

                foreach($option->orders as $order) {
                    $order->update([
                        'item_id' => $item->id,
                        'option_id' => NULL
                    ]);
                }
                $option->delete();
            }
        }
//        return $items;
    }

    public function add(Request $request)
    {
        $request->validate([
            'secret' => [
                'required',
                Rule::in([self::SECRET_KEY]),
            ],
            'value' => [
                'required',
                Rule::in(Wallet::getChannels()),
            ],
        ]);

        if(Cart::getTotalPrice() > Wallet::getCurrentSum()) {
            Wallet::addSum($request->get('value'));

            \App\Cashbox\Models\Manager::send([
                'event' => 'creditAdded',
            ]);

            if(!Cache::has(Order::CACHE_KEY)) {
                $order = Order::create([
                    'status' => Order::STATUS_PENDING,
                ]);

                $items = [];
                foreach (Cart::getItems() as $item) {
                    if(isset($item['options'])) {
                        foreach ($item['options'] as $option) {
                            $items[] = new OrderItem([
                                'item_id' => $item['data']->id,
                                'quantity' => $option['quantity'],
                                'option_id' => $option['data']->id,
                                'price' => $option['data']->price ?? $item['data']->price
                            ]);
                        }
                    } else {
                        $items[] = new OrderItem([
                            'item_id' => $item['data']->id,
                            'quantity' => $item['quantity'],
                            'price' => $item['data']->price
                        ]);
                    }
                }

                $order->items()->saveMany($items);

                Cache::set(Order::CACHE_KEY, $order->id);

                \App\Cashbox\Models\Manager::send([
                    'event' => 'orderCreated',
                    'url' => route('manager.show')
                ]);
            }

//            $order = Order::find(Cache::get(Order::CACHE_KEY));
//            $order->paid = Wallet::getCurrentSum();
//            $order->save();
        }

        if(Cart::getTotalPrice() <= Wallet::getCurrentSum()) {
            \App\Cashbox\Models\Manager::send([
                'event' => 'orderPaid'
            ]);

            Wallet::send([
                'action' => 'STOP'
            ]);
        }

        return response()->json([
            'value' => $request->get('value'),
            'current_sum' => Wallet::getCurrentSum(),
            'total_price' => Cart::getTotalPrice(),
        ]);
    }
}
