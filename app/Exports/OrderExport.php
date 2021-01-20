<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Cashbox\Models\Item;

class OrderExport implements FromView
{
    protected $sales;
    protected $summary;

    public function __construct($sales, $summary)
    {
        $this->sales = $sales;
        $this->summary = $summary;
    }

    public function view(): View
    {
        return view('cash.manager.export.sales', [
            'sales' => $this->sales,
            'summary' => $this->summary
        ]);
    }
}
