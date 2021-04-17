<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Income;
use App\Cashbox\Models\Option;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use App\Cashbox\Models\Wallet;
use Illuminate\Http\Request;
use App\Cashbox\Models\Cart;
use Illuminate\Support\Facades\Cache;
use App\Cashbox\Models\Order;
use App\Cashbox\Models\OrderItem;

class WalletController extends Controller
{
    const SECRET_KEY = 'VALIDATOR_SECRET';

    public function add(Request $request)
    {
        try {
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
                                    'income_id' => $this->getIncomeId($item['data']->id, $option['data']->id),
                                    'price' => $option['data']->price ?? $item['data']->price,
                                ]);
                            }
                        } else {
                            $items[] = new OrderItem([
                                'item_id' => $item['data']->id,
                                'quantity' => $item['quantity'],
                                'price' => $item['data']->price,
                                'income_id' => $this->getIncomeId($item['data']->id),
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
        } catch (\Exception $e) {
            trigger_error($e->getMessage());
        } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
            trigger_error($e->getMessage());
        }
    }

    public function getIncomeId($item_id, $option_id = false)
    {
        $incomes = $option_id ?
            Income::where('option_id', $option_id)->get() :
            Income::where('item_id', $item_id)->get();

        $count = $option_id  ?
            OrderItem::where('option_id', $option_id)->where('created_at', '<', date('Y-m-d H:i:s'))->sum('quantity') :
            OrderItem::where('item_id', $item_id)->where('created_at', '<', date('Y-m-d H:i:s'))->sum('quantity');

        $income_qty = 0;

        foreach($incomes as $income) {
            if(($income_qty += $income->quantity) >= $count) {
                return $income->id;
            }
        }
    }

}
