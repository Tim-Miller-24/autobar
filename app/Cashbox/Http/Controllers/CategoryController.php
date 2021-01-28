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
        $category = Category::with(
            'items',
            'items.orders',
            'items.incomes',
            'items.options',
            'items.options.incomes',
            'items.options.orders',
            'children',
            'children.items',
            'parent',
            'parent.items',
            'parent.children'
        )
            ->orderBy('lft')
            ->active()
            ->findOrFail($id);

        return view('cash.category', [
            'id' => $id,
            'category' => $category
        ]);
    }
}
