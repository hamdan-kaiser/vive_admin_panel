<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicProfile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'address',
        'ielts_score',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'ielts_score' => 'float',
    ];
}
