<?php

namespace App\Cashbox\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Cashbox\Models\Category;

class CategoryController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('cash.index');
    }

    public function category($id)
    {
        $category = Category::with([
            'items' => function ($query) {
                $query->whereRaw('(SELECT IFNULL(sum(incomes.quantity), 0) FROM incomes WHERE incomes.item_id = items.id)
                        - (SELECT IFNULL(sum(order_items.quantity), 0) FROM order_items WHERE order_items.item_id = items.id)
                > 0');
            },
            'items.activeOptions' => function ($query) {
                $query->whereRaw('(SELECT IFNULL(sum(incomes.quantity), 0) FROM incomes WHERE incomes.option_id = options.id)
                        - (SELECT IFNULL(sum(order_items.quantity), 0) FROM order_items WHERE order_items.option_id = options.id)
                > 0');
            },
            'children',
            'children.items',
            'parent',
            'parent.items',
            'parent.children'
        ])
        ->orderBy('lft')
        ->active()
        ->findOrFail($id);

        return view('cash.category', [
            'id' => $id,
            'category' => $category
        ]);
    }
}
