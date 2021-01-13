<?php

namespace App\Cashbox\Http\Livewire;

use Livewire\Component;

class Link extends Component
{
    public $url;
    public $css;
    public $icon;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        //
    }

    public function go()
    {
        $this->redirect($this->url);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cash.components.link', [
            'url' => $this->url,
            'css' => $this->css,
            'icon' => $this->icon
        ]);
    }
}
