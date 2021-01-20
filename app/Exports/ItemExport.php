<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Cashbox\Models\Item;

class ItemExport implements FromView
{
    public function view(): View
    {
        $items = Item::with('options',
            'options.incomes',
            'options.orders',
            'incomes',
            'orders')
            ->get();

        $products = collect();

        foreach($items as $item) {
            if($item->options) {
                foreach($item->options as $option) {
                    $products->push([
                        'name' => $item->name,
                        'option' => $option->name,
                        'income_price' => $option->purchase_price,
                        'price' => $option->price ?? $item->price,
                        'stock' => $option->stock,
                        'sold' => $option->sold,
                        'incomes' => $option->incomes->sum('quantity')
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
                    'incomes' => $item->incomes->sum('quantity')
                ]);
            }
        }

        return view('cash.manager.export.stats', [
            'items' => $products->sortByDesc('sold'),
        ]);
    }
}
