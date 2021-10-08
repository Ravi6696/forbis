<?php

namespace App\View\Components\ProUser;

use App\Models\Category;
use App\Models\FaqFavourite;
use Illuminate\View\Component;

class FilterFaq extends Component
{
    public $categories, $myFavourites, $category_id, $search_filter;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Category::active()->pluck('title', 'id');
        $this->myFavourites = FaqFavourite::auth()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pro-user.filter-faq');
    }
}
