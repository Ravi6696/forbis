<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Blog extends BaseModel
{
    use SoftDeletes;
    protected $appends = ['attachment_path'];
    public function scopeActive()
    {
        return $this->where('status', '1');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getAttachmentPathAttribute()
    {
        return $this->attachment ? Storage::disk('uploads')->url($this->attachment) : asset('images/blank.jpg');
    }
    public function blogComments()
    {
        return $this->hasMany(BlogComment::class);
    }
}