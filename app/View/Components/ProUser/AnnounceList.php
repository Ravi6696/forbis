<?php

namespace App\View\Components\ProUser;

use App\Models\CardDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AnnounceList extends Component
{
    public $companyAdvertisement, $company, $paymentDetail,$is_create;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($companyAdvertisement = null,$is_create = true)
    {
        $this->company = Auth::user()->company;
        $this->is_create = $is_create;
        $this->companyAdvertisement = $companyAdvertisement;
        $this->paymentDetail = CardDetail::where('user_id', auth()->user()->id)->latest()->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pro-user.announce-list');
    }
}