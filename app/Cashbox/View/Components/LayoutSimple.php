<?php

namespace App\Cashbox\View\Components;

use Illuminate\View\Component;

class LayoutSimple extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.layout-simple');
    }
}
