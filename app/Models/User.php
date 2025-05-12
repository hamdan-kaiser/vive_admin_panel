<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
 protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function basicProfile (){
        return $this->hasOne(BasicProfile::class);
    }

    public function passportProfile (){
        return $this->hasOne(PassportProfile::class);
    }

    public function educationProfile (){
        return $this->hasMany(Education::class);
    }
    public function professionalProfile (){
        return $this->hasMany(Professional::class);
    }
    public function otherProfile (){
        return $this->hasMany(OtherDcoument::class);
    }
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('storage/'.$value) ;
        }else{
            return $value;
        }
    }
}
