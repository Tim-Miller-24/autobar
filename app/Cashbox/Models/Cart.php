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

    public static function getItemsCount()
    {
        $items = self::getItems();

        if($items) {
            $count = 0;
            foreach($items as $item) {
                $count += $item['quantity'];
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
                $price += $item['data']->price * $item['quantity'];
            }

            return $price;
        }

        return false;
    }

    public static function remove($id, $quantity = 0)
    {
        $items = self::getItems();

        if(!isset($items[$id])) {
            return;
        }

        $current = $items[$id]['quantity'];

        if(!$quantity OR $current <= $quantity) {
            unset($items[$id]);
            Cache::forever(self::KEY, $items);
        } else {
            $items[$id]['quantity'] = $current - $quantity;
            Cache::forever(self::KEY, $items);
        }
    }

    public static function add($id, $quantity = 1)
    {
        $item = self::getItem($id);

        if(!$item) {
            return;
        }

        $items = self::getItems();

        if(!isset($items[$item->id])) {
            $items[$item->id] = [
                'quantity' => $item->stock >= $quantity ? $quantity : $item->stock,
                'data' => $item
            ];
            Cache::forever(self::KEY, $items);
        } else {
            $current = $items[$item->id]['quantity'];
            $items[$item->id] = [
                'quantity' => $item->stock >= ($current + $quantity) ? $current + $quantity : $item->stock,
                'data' => $item
            ];
            Cache::forever(self::KEY, $items);
        }
    }

    private static function getItem($id)
    {
        $item = Item::with('orders', 'incomes')->active()->findOrFail($id);

        return $item;
    }
}
