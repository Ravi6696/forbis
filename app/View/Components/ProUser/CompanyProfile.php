<?php

namespace App\View\Components\ProUser;

use Illuminate\View\Component;
use Auth;

class CompanyProfile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user,$company,$address;
    public function __construct()
    {
        $this->user = Auth::user();
        $this->company = $this->user->company ?? [];
        $this->address = $this->company->address ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pro-user.company-profile');
    }
}
