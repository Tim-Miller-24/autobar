<?php

namespace App\Cashbox\Http\Controllers;

use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('cash.show');
    }

    public function category($id)
    {
        return view('cash.category-show', [
            'id' => $id,
        ]);
    }
}
