<?php

namespace App\Cashbox\Http\Controllers;

use App\Cashbox\Models\Item;
use Illuminate\Routing\Controller;
use App\Cashbox\Models\Category;

class SlidesController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $item = Item::with('activeOptions')
            ->active()
            ->inRandomOrder()
            ->first();

        return view('cash.slideshow', [
            'item' => $item
        ]);
    }

    public function fetch()
    {
        $item = Item::with('activeOptions')
            ->active()
            ->inRandomOrder()
            ->first();

        return response()->json($item);
    }
}
