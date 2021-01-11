<?php

namespace App\Cashbox\Http\Livewire;

use App\Cashbox\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    private function getCategoryList()
    {
        return Category::active()
            ->firstLevelItems()
            ->get();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.category-list', [
            'categories' => $this->getCategoryList()
        ]);
    }
}
