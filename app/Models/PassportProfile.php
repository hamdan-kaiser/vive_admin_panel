<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportProfile extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'given_name',
        'surname',
        'passport_no',
        'date_of_birth',
        'address',
        'ielts_score',
        'passport_expire',
        'passport_image',
    ];

    public function getPassportImageAttribute($value)
    {
        if ($value) {
            return asset('storage/'.$value) ;
        }else{
            return $value;
        }
    }
}
