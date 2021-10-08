<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends BaseModel
{
    use SoftDeletes;
    protected $appends = ['images_path', 'company_logo_path', 'featured_image', 'categories','category_name', 'ad_amount', 'full_address'];

    public function companyImages()
    {
        return $this->hasMany(CompanyGallery::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getCategoryNameAttribute()
    {
        $parentCategory = $this->category && $this->category->parent ? $this->category->parent->title : null;
        $subcategory = $this->category ? $this->category->title : null;
        $category_name = $subcategory .= $parentCategory ? '-' . $parentCategory : null;
        return $category_name; 
    }
    public function getImagesPathAttribute()
    {
        $images = [];
        if ($this->companyImages != null) {
            foreach ($this->companyImages as $key => $value) {
                $images[$value->id] = file_exists('uploads/' . $value->image) ? asset('uploads/' . $value->image) : asset('images/no-image.png');
            }
        }
        return $images;
    }

    public function getFeaturedImageAttribute()
    {
        $data = $this->companyImages()->where('is_featured', 1)->first();
        $image  =  $data->image ?? ($this->companyImages()->first()->image ?? null);
        return $image && file_exists('uploads/' . $image) ? asset('uploads/' . $image) : asset('images/blank.jpg');
    }

    public function getCompanyLogoPathAttribute()
    {
        return $this->company_logo && file_exists('uploads/' . $this->company_logo) ? asset('uploads/' . $this->company_logo) : asset('images/sqare-img.png');
    }

    public function companyTime()
    {
        return $this->hasMany(CompanyTime::class, 'company_id', 'id');
    }

    public function companyComments()
    {
        return $this->hasMany(CompanyComment::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function companyAdvertisement()
    {
        return $this->hasMany(CompanyAdvertisement::class, 'company_id', 'id');
    }

    public function companyCategory()
    {
        return $this->hasMany(CompanyCategory::class);
    }
    public function getCategoriesAttribute()
    {
        return $this->companyCategory->pluck('category_id')->toArray();
    }
    public function getAdAmountAttribute()
    {
        return Setting::first()->ad_amount ?? 0;
    }
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    public function getFullAddressAttribute()
    {
        $address = $this->address;
        if (!$address) {
            return null;
        }
        return $address->address_line_1 . ", " . $address->address_line_2 . ", " . $address->city  . ", " . $address->postalcode;
    }
    public function followers()
    {
        return $this->hasOne(CompanyFollowers::class);
    }
    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class, 'company_id', 'id');
    }
}