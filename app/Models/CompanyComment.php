<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyComment extends BaseModel
{
    use SoftDeletes;
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function childComment()
    {
        return $this->hasMany(CompanyComment::class, 'parent_comment_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}