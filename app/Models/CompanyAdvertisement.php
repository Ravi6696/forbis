<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAdvertisement extends BaseModel
{
    use SoftDeletes;
    protected $appends = ['attachment_path', 'ad_amount'];

    public function getAttachmentPathAttribute()
    {
        return $this->attachment ? asset('uploads/' . $this->attachment) : asset('images/blank.jpg');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getAdAmountAttribute()
    {
        return Setting::first()->ad_amount ?? 0;
    }

    public static function generateInvoiceNumber()
    {
        $invoice = CompanyAdvertisement::latest()->first();
        return $invoice ? str_pad($invoice->invoice_number + 1, 6, '0', STR_PAD_LEFT)   : '000001';
    }

    public function favourites()
    {
        return $this->hasOne(AnnounceFavourite::class);
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
}