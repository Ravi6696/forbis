<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends BaseModel
{
    use SoftDeletes;
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    public function getFullAddressAttribute()
    {
        $address = $this->address;
        return $address->address_line_1 . ", " . $address->address_line_2 . ", " . $address->city  . ", " . $address->postalcode;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}