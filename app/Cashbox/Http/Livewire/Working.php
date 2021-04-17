<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Cashbox\Models\Workday;

class Working extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $status = Cache::get(Workday::WORKDAY_ID_KEY, false);

        return view('cash.components.workday', [
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
