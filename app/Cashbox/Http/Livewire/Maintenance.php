<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Maintenance extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $status = Cache::get(env('BAR_ENABLED'), true);

        return view('cash.components.maintenance', [
            'status' => $status
        ]);
    }

    public function toggle()
    {
        $status = (Cache::get(env('BAR_ENABLED'), true)) ? false : true;

        Cache::forever(env('BAR_ENABLED'), $status);

        \App\Cashbox\Models\Manager::send([
            'event' => 'maintenanceMode'
        ]);

        $this->emit('maintenanceMode');
    }
}
