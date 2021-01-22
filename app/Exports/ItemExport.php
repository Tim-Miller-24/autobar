<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Cashbox\Models\Item;

class ItemExport implements FromView
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function view(): View
    {
        return view('cash.manager.export.stats', [
            'items' => $this->items,
        ]);
    }
}
