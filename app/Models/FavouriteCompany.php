<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavouriteCompany extends BaseModel
{
    use SoftDeletes;
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}