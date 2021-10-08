<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends BaseModel
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}