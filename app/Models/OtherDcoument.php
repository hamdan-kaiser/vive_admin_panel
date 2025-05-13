<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherDcoument extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    protected $fillable = [
        'type',
        'letter',
    ];

    protected $dates = ['deleted_at'];

    public function getLetterAttribute($value)
    {
        if ($value) {
            return asset('storage/'.$value) ;
        }else{
            return $value;
        }
    }
}
