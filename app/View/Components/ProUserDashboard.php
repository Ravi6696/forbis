<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Company;
use Illuminate\View\Component;

class ProUserDashboard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $companyData, $categories;
    public function __construct($id = null)
    {
        $this->categories = Category::where('status', 'active')->get();
        $this->companyData = Company::when($id != null, function ($q) use ($id) {
            $q->where('id', $id);
        })->when($id == null, function ($q) use ($id) {
            $q->where('user_id', auth()->user()->id);
        })->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pro-user-dashboard');
    }
}