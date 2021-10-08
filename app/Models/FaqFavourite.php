<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqFavourite extends BaseModel
{
    use HasFactory;
    public function scopeAuth($q)
    {
        return $q->where('user_id', auth()->user()->id);
    }
    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
