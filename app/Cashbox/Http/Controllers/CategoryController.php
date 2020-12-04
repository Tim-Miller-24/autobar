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
        return view('cash.index');
    }

    public function category($id)
    {
        return view('cash.category', [
            'id' => $id,
        ]);
    }
}
