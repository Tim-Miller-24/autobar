<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Cashbox\Models\Workday;
use App\Cashbox\Models\Wallet;

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

    public function open()
    {
        $workday = Workday::create([
            'started_at' => date('Y-m-d H:i:s'),
            'user_id' => auth()->user()->id
        ]);

        Cache::forever(Workday::WORKDAY_ID_KEY, $workday->id);

        $this->emit('workDay');

        \App\Cashbox\Models\Manager::send([
            'event' => 'workDay',
            'url' => route('cash.show')
        ]);
    }

    public function close()
    {
        $id = Cache::get(Workday::WORKDAY_ID_KEY, false);

        if($id) {
            $workday = Workday::find($id);

            if($workday) {
                $workday->update([
                    'ended_at' => date('Y-m-d H:i:s')
                ]);
            }

            Cache::forget(Workday::WORKDAY_ID_KEY);
        }

        $this->emit('workDay');

        \App\Cashbox\Models\Manager::send([
            'event' => 'workDay',
            'url' => route('cash.show')
        ]);
    }

    public function fixErrors()
    {
        Cache::clear();

        Wallet::reset();

        Wallet::send([
            'action' => 'STOP'
        ]);

        return redirect()->route('manager.show');
    }
}
