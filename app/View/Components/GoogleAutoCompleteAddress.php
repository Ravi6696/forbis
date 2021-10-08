<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GoogleAutoCompleteAddress extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $companyData;
    public function __construct($companyData)
    {
        $this->companyData = $companyData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.google-auto-complete-address');
    }
}
