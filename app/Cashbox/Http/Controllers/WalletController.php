<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Item;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Cashbox\Models\Wallet;
use Illuminate\Http\Request;
use App\Cashbox\Models\Cart;
use Illuminate\Support\Facades\Cache;
use App\Cashbox\Models\Order;
use App\Cashbox\Models\OrderItem;
use Illuminate\Support\Facades\Http;
use App\Cashbox\Models\Category;
use App\Cashbox\Models\Option;


class WalletController extends Controller
{
    const SECRET_KEY = 'VALIDATOR_SECRET';

    public function test()
    {
//        return Category::where('name->ru', 'Сладости')->first();
        $response = Http::get('http://easy.local/wallet/test');
        $items = json_decode($response);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Item::truncate();
        Option::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($items as $item) {
            $category_id = NULL;

            if(!empty($item->category)) {
                $category = Category::where('name->ru', $item->category->name)->first();

                if(!$category) {
                    $category = Category::create([
                        'name' => $item->category->name,
                        'position' => $item->category->position,
                        'is_active' => $item->category->is_active
                    ]);
                }

                $category_id = $category->id;
            }

            $entity = Item::create([
                'name' => $item->name,
                'category_id' => $category_id,
                'position' => $item->position,
                'price' => $item->price,
                'is_active' => $item->is_active,
                'image' => $item->image
            ]);
            if(count($item->options)) {
                foreach ($item->options as $option) {
                    Option::create([
                        'name' => $option->name,
                        'image' => $option->image,
                        'is_active' => $option->is_active,
                        'price' => $option->price,
                        'note' => $option->note,
                        'position' => $option->position,
                        'item_id' => $entity->id
                    ]);
                }
            }
        }
    }

    public function reset()
    {
        Wallet::reset();
    }

    public function send()
    {
        \App\Cashbox\Models\Manager::send([
            'event' => 'orderFinished'
        ]);
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
                    $items[] = new OrderItem([
                        'item_id' => $item['data']->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['data']->price
                    ]);
                }

                $order->items()->saveMany($items);

                Cache::set(Order::CACHE_KEY, $order->id);

                \App\Cashbox\Models\Manager::send([
                    'event' => 'orderCreated',
                    'url' => route('manager.show')
                ]);
            }

            $order = Order::find(Cache::get(Order::CACHE_KEY));
            $order->paid = Wallet::getCurrentSum();
            $order->save();
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
