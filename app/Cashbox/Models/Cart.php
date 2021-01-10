<?php

namespace App\Cashbox\Models;

use Illuminate\Support\Facades\Cache;

class Cart
{
    const KEY = 'cart.items';

    public static function getItems()
    {
        if(!Cache::has(self::KEY)) {
            return false;
        }

        return Cache::get(self::KEY);
    }

    public static function deleteItems()
    {
        if(!Cache::has(self::KEY)) {
            return false;
        }

        return Cache::forget(self::KEY);
    }

    public static function getItemsCount()
    {
        $items = self::getItems();

        if($items) {
            $count = 0;
            foreach($items as $item) {
                if(isset($item['options'])) {
                    foreach($item['options'] as $option) {
                        $count += $option['quantity'];
                    }
                } else {
                    $count += $item['quantity'];
                }
            }

            return $count;
        }

        return false;
    }

    public static function getTotalPrice()
    {
        $items = self::getItems();

        if($items) {
            $price = 0;
            foreach ($items as $item) {
                if(isset($item['options'])) {
                    foreach($item['options'] as $option) {
                        $price += ($option['data']->price ?? $item['data']->price) * $option['quantity'];
                    }
                } else {
                    $price += $item['data']->price * $item['quantity'];
                }
            }

            return $price;
        }

        return false;
    }

    public static function remove($id, $quantity = 0, $option_id = false)
    {
        $items = self::getItems();

        if(!isset($items[$id])) {
            return;
        }

        if($option_id) {
            $current = $items[$id]['options'][$option_id]['quantity'];

            if(!$quantity OR $current <= $quantity) {
                unset($items[$id]['options'][$option_id]);
            } else {
                $items[$id]['options'][$option_id]['quantity'] = $current - $quantity;
            }
        } else {
            $current = $items[$id]['quantity'];

            if(!$quantity OR $current <= $quantity) {
                unset($items[$id]);
            } else {
                $items[$id]['quantity'] = $current - $quantity;
            }
        }

        Cache::forever(self::KEY, $items);
    }

    public static function add($id, $quantity = 1, $option_id = false)
    {
        $item = self::getItem($id);

        if(!$item) {
            return;
        }

        $items = self::getItems();

        if(!isset($items[$item->id])) {
            if($option_id) {
                $items[$item->id] = [
                    'data' => $item,
                    'options' => [
                        $option_id => [
                            'quantity' => $item->getStockOption($option_id) >= $quantity ? $quantity : $item->getStockOption($option_id),
                            'data' => $item->getOption($option_id)
                        ]
                    ]
                ];
            } else {
                $items[$item->id] = [
                    'quantity' => $item->stock >= $quantity ? $quantity : $item->stock,
                    'data' => $item
                ];
            }
            Cache::forever(self::KEY, $items);
        } else {
            if($option_id) {
                $current = 0;
                if(isset($items[$item->id]['options'][$option_id]['quantity'])) {
                    $current = $items[$item->id]['options'][$option_id]['quantity'];
                }

                $items[$item->id]['options'][$option_id] = [
                    'quantity' => $item->getStockOption($option_id) >= ($current + $quantity) ? $current + $quantity : $item->getStockOption($option_id),
                    'data' => $item->getOption($option_id)
                ];
            } else {
                $current = $items[$item->id]['quantity'];
                $items[$item->id] = [
                    'quantity' => $item->stock >= ($current + $quantity) ? $current + $quantity : $item->stock,
                    'data' => $item
                ];
            }
            Cache::forever(self::KEY, $items);
        }
    }

    private static function getItem($id)
    {
        $item = Item::with('orders', 'incomes', 'options')->active()->findOrFail($id);

        return $item;
    }

    public function getItemWithOption($item_id, $option_id)
    {
        $items = self::getItems();

        if($items) {

        }
    }
}
