<?php

namespace App\Cashbox\Http\Controllers;

use Illuminate\Routing\Controller;

class ManagerController extends Controller
{
    /**
     * Show the user profile screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('cash.manager');
    }
}
