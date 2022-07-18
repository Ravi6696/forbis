<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends BaseModel
{
    protected $appends = ['images_path'];

    public function companyImages()
    {
        return $this->hasMany(CompanyGallery::class);
    }
    public function getImagesPathAttribute()
    {
        $images = [];
        if ($this->companyImages != null) {
            foreach ($this->companyImages as $key => $value) {
                $images[] = asset('uploads/' . $value->image);
            }
        }
        return $images;
    }

    public function companyTime()
    {
        return $this->hasMany(CompanyTime::class, 'company_id', 'id');
    }
}