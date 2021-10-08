<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCategory extends BaseModel
{
    use SoftDeletes;
    use HasFactory;
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}