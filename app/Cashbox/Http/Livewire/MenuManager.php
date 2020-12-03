<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;

class MenuManager extends Component
{
    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        //
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.menu-manager');
    }
}
