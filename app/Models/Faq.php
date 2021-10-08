<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Faq extends BaseModel
{
    use SoftDeletes;
    protected $appends = ['attachment_url'];
    public function getAttachmentUrlAttribute()
    {
        return $this->attachment ? Storage::disk('uploads')->url($this->attachment) : asset('images/blank.jpg');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->hasMany(FaqCategory::class);
    }
    public function faqFavourite()
    {
        return $this->hasMany(FaqFavourite::class);
    }
    
    public function faqAnswer()
    {
        return $this->hasMany(FaqAnswer::class);
    }
}
