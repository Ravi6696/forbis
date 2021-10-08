<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Company;
use Illuminate\View\Component;

class CreateCompany extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $companyData, $categories, $is_toggle_apropos = true,
        $is_toggle_horaire = true,
        $is_toggle_avis = true,
        $is_toggle_coordonnees = true;
    public function __construct($id = null)
    {
        $this->categories = Category::where('status', 'active')->get();
        $this->companyData = Company::when($id != null, function ($q) use ($id) {
            $q->where('id', $id);
        })->when($id == null, function ($q) use ($id) {
            $q->where('user_id', auth()->user()->id);
        })->first();
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $timestamp = strtotime('next Sunday');
        for ($i = 0; $i < 7; $i++) {
            $companyTime[$days[$i]] = $this->companyData->companyTime()->where('day', $days[$i])->get();
        }
        $this->companyData->setAttribute('time', $companyTime);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.create-company');
    }
}
