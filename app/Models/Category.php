<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use SoftDeletes;
    public function scopeActive()
    {
        return $this->where('status', 'active');
    }
    public function faqCategory()
    {
        return $this->hasMany(FaqCategory::class);
    }
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }
}