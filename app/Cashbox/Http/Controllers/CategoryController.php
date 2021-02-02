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
            'activeItems',
            'activeItems.activeOptions',
            'children',
            'children.activeItems',
//            'parent',
//            'parent.activeItems',
//            'parent.children'
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
