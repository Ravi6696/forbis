<?php

namespace App\View\Components\ProUser;

use App\Models\Category;
use Illuminate\View\Component;

class CreateAnnounce extends Component
{
    public $companyAdvertisement, $categories, $updateData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($companyAdvertisement = null)
    {
        $this->companyAdvertisement = $companyAdvertisement;
        $this->categories = Category::where('status', 'active')->pluck('title', 'id');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pro-user.create-announce');
    }
}