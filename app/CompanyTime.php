<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTime extends BaseModel
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}