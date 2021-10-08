<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasRoles;
    use Notifiable;
    use Billable;
    protected $appends = ['full_name', 'profile_path', 'user_type'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function getProfilePathAttribute()
    {
        return $this->profile_pic ? Storage::disk('uploads')->url($this->profile_pic) : asset('images/avatar.png');
    }
    public function getUserTypeAttribute()
    {
        if (Auth::user()->hasRole('admin')) {
            return 'admin';
        } else if (Auth::user()->hasRole('pro-user')) {
            return 'pro-user';
        } else {
            return 'user';
        }

        return;
    }
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    public function cardDetails()
    {
        return $this->hasMany(CardDetail::class);
    }
    public function favourites()
    {
        return $this->hasMany(FavouriteCompany::class);
    }
    public function companyComments()
    {
        return $this->hasMany(CompanyComment::class);
    }
    public function conversations()
    {
        $data = Conversation::where('sender_id', auth()->user()->id)
            ->orWhere('receiver_id', auth()->user()->id)
            ->get();
        return $data;
    }
}