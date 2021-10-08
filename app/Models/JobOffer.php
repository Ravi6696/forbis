<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOffer extends BaseModel
{
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    public function getFullAddressAttribute()
    {
        $address = $this->company->address;
        return $address->address_line_1 . ", " . $address->address_line_2 . ", " . $address->city  . ", " . $address->postalcode;
    }
    public function scopeAuth($q)
    {
        return $q->where('user_id', auth()->user()->id);
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }
}