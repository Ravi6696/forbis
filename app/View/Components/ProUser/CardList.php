<?php

namespace App\View\Components\ProUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user, $cardDetails;
    public function __construct()
    {
        $this->user = Auth::user();
        $this->cardDetails = $this->user->cardDetails ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pro-user.card-list');
    }
}