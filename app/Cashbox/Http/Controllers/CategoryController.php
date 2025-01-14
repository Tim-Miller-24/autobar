<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Item;
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
        $items = Item::with('activeOptions', 'additions', 'additions.values')
            ->withCount('orders')
            ->active()
            ->orderByOrders()
            ->take(16)
            ->get();

        return view('cash.index', [
            'items' => $items
        ]);
    }

    public function category($id)
    {
        $category = Category::with([
            'activeItems',
            'activeItems.activeOptions',
            'activeItems.additions',
            'activeItems.additions.values',
            'children',
            'children.activeItems',
//            'parent',
//            'parent.activeItems',
//            'parent.children'
        ])
//        ->whereHas('activeItems.additions', function ($query) {
//            $query->where('additions.is_active', true);
//        })
        ->orderBy('lft')
        ->active()
        ->findOrFail($id);

        return view('cash.category', [
            'id' => $id,
            'category' => $category
        ]);
    }
}
